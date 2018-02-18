<?php namespace App\Http\Controllers\Backend\Mutasi;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\MaterialEksjar;
use App\Models\Mutation;
use App\Models\LogMutation;
use App\Models\Warehouse;
use Table;
use Image;
use trinata;

class MutasiEksJaringanController extends TrinataController
{
  
    public function __construct(Material $model, Mutation $mutation, MaterialEksjar $eksjar)
    {
        parent::__construct();
        $this->middleware('auth');
        $this->model = $model;
        $this->eksjar = $eksjar;
        $this->mutation = $mutation;

        $this->resource = "backend.mutasi.eks-jaringan.";
    }

    public function getData(Request $request)
    {
        if(\Auth::User()->warehouse_id > 0){
            $model = $this->model
                        ->select('id','name','komag','description','category',\DB::raw('sum(amount - total_proposed_amount) as amount'),'unit','warehouse_id')
                        ->groupBy('id')
                        ->whereNotIn('warehouse_id', [\Auth::User()->warehouse_id])
                        ->orderBy('created_at','desc')
                        ->whereType('eksjar');
        }else{
            $model = $this->model
                        ->select('id','name','komag','description','category',\DB::raw('sum(amount - total_proposed_amount) as amount'),'unit','warehouse_id')
                        ->groupBy('id')
                        ->orderBy('created_at','desc')
                        ->whereType('eksjar');
        }
        

        $data = Table::of($model)
            ->addColumn('warehouse_id',function($model){
                // dd(
                return $model->warehouse()->first()->name;
            })
            ->addColumn('action',function($model){
                $button = "<a href='".urlBackendAction('detail/'.$model->id)."' class='btn btn-info'>Ajukan</a>";
                return $button;
            })
            ->make(true);

        return $data;
    }

    public function getIndex(Request $request)
    {
        $model = $this->model;
        $data = ['ware'=> Warehouse::lists('name','id')];

        return view($this->resource.'index', compact('model', 'request'));
    }

    public function getCreate()
    {
        $model = $this->model;
        $data = ['ware'=> Warehouse::lists('name','id')];

        return view($this->resource.'_form',compact('model', 'data'));
    }

   public function postCreate(Requests $request)
    {
        $model = $this->model;
        $inputs = $request->all();
        $inputs['image'] = $this->handleUpload($request,$model,'image',[100,100]);
        return $this->insertOrUpdate($model,$inputs);
    }

    public function getDetail($id)
    {
        $model = $this->model
                            ->select('materials.*', 'material_eksjars.*')
                            ->join('material_eksjars', 'material_eksjars.material_id', '=', 'materials.id')
                            ->where('materials.id', $id)->first();
        // dd($model);
                            // ->findOrFail($id);
        
        $data = ['ware' => Warehouse::lists('name','id')];
        $data['not_warehouse'] = Warehouse::whereNotIn('id', [$model->warehouse_id])->lists('name','id');
        $model['real_amount'] = $model['amount'] - $model['total_proposed_amount'];


        return view($this->resource.'_form',compact('model', 'data'));
    }

    public function postDetail(Request $request,$id)
    {
        if ((($request->proposed_amount) <= ($request->real_amount)) && (($request->proposed_amount) > 0) && (($request->warehouse_id) != ($request->proposed_warehouse_id))){
            $model = $this->model->findOrFail($id);
            $model->total_proposed_amount = $model->total_proposed_amount + $request->proposed_amount;
            $model->status = 1;

            // dd($model);

            if($model->save()){
                $mutation = new \App\Models\Mutation;
                $mutation->material_id = $model->id;
                $mutation->amount = $model->amount;
                $mutation->proposed_amount = $request->proposed_amount;
                $mutation->warehouse_id = $request->warehouse_id;
                $mutation->proposed_warehouse_id = $request->proposed_warehouse_id;
                $mutation->user_id = \Auth::user()->id;
                $mutation->status = 1;

                if($mutation->save()){
                    $log_mutation = new \App\Models\LogMutation; //log
                    $log_mutation->material_id = $model->id;
                    $log_mutation->amount = $model->amount;
                    $log_mutation->proposed_amount = $request->proposed_amount;
                    $log_mutation->warehouse_id = $request->warehouse_id;
                    $log_mutation->proposed_warehouse_id = $request->proposed_warehouse_id;
                    $log_mutation->user_id = \Auth::user()->id;
                    $log_mutation->status = 1;
                    $log_mutation->save();
                    
                }

            }else{
                $model->total_proposed_amount = $model->total_proposed_amount - $request->proposed_amount;
                $model->save();
                return back()->with('info','Saving failed');
            }
        }else{
            return back()->with('info','Check your mutation data');
        }

        // return $this->insertOrUpdate($model);
        return redirect(urlBackend('pengajuan-mutasi/index'))->with('success','Data Has Been Inserted');
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);
        return $this->delete($model,[$model->image]);
    }

    public function getPublish($id)
    {
        $model = $this->model->findOrFail($id);
        return $this->publish($model);
    }
}
