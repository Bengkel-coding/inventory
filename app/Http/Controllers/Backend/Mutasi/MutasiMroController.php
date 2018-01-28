<?php namespace App\Http\Controllers\Backend\Mutasi;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\MaterialMro;
use App\Models\Mutation;
use App\Models\Warehouse;
use Table;
use Image;
use trinata;

class MutasiMroController extends TrinataController
{
  
    public function __construct(Material $model, Mutation $mutation)
    {
        parent::__construct();
        $this->middleware('auth');
        $this->model = $model;
        $this->mutation = $mutation;
        
        $this->resource = "backend.mutasi.mro.";
    }

    public function getData(Request $request)
    {
        $model = $this->model
                        ->select('id','name','komag','description','category', 'year_acquisition',\DB::raw('sum(amount - total_proposed_amount) as amount'),'unit_price','unit','warehouse_id')
                        ->groupBy('komag')
                        ->orderBy('created_at','desc')
                        ->whereType('mro');

        // dd($model);
        
        $data = Table::of($model)
            ->addColumn('warehouse_id',function($model){
                // dd(
                return $model->warehouse()->first()->name;
            })
            ->addColumn('action',function($model){
                $status = $model->status == 'y' ? true : false;
                return trinata::buttons($model->id , [] , $status);
            })
            ->make(true);

        return $data;
    }

    public function getIndex(Request $request)
    {
        // $warehouse = \App\Models\Warehouse::lists('name','id')->toArray();
        // $warehouse = array_merge([0=>'Pilih Gudang'], $warehouse);

        // $urlAjax = 'data?warehouse='.(int) $request->warehouse.'&category='.(string) $request->category;

        $model = $this->model;
        $data = ['ware'=> Warehouse::lists('name','id')];

        return view($this->resource.'index', compact('model', 'request','warehouse','urlAjax'));
    }

    public function getCreate()
    {
        $model = $this->model;
        $data = ['ware'=> Warehouse::lists('name','id')];

        return view($this->resource.'_form',compact('model', 'data'));
    }

   public function postCreate(Requests\Backend\CrudRequest $request)
    {
        $model = $this->model;
        $inputs = $request->all();
        $inputs['image'] = $this->handleUpload($request,$model,'image',[100,100]);
        return $this->insertOrUpdate($model,$inputs);
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);
        $data['ware'] = Warehouse::lists('name','id');
        $data['not_warehouse'] = Warehouse::whereNotIn('id', [$model->warehouse_id])->lists('name','id');
        $model['total_price'] = $model['amount'] * $model['unit_price'];
        $model['real_amount'] = $model['amount'] - $model['total_proposed_amount'];

        return view($this->resource.'_form',compact('model', 'data'));
    }

    public function postUpdate(Request $request,$id)
    {
        // dd($id);

        //check proposed_amout <= amount

        //update total_proposed_amount material = total_proposed_amount + proposed_amount

        //insert data mutation

        //check data mutation berhasil, replicate data material ganti amount & warehouse_id
        //jika tidak berhasil, rollback data amount = amount + proposed_amount 

        
        if ((($request->proposed_amount) <= ($request->real_amount)) && (($request->proposed_amount) > 0) && (($request->warehouse_id) != ($request->proposed_warehouse_id))){
            $model = $this->model->findOrFail($id);
            // $model->amount = $request->amount - $request->proposed_amount;
            $model->total_proposed_amount = $model->total_proposed_amount + $request->proposed_amount;
            $model->status = '1';

            // dd($model);

            if($model->save()){
                $mutation = new \App\Models\Mutation;
                $mutation->material_id = $model->id;
                $mutation->amount = $model->amount;
                $mutation->proposed_amount = $request->proposed_amount;
                $mutation->warehouse_id = $request->warehouse_id;
                $mutation->proposed_warehouse_id = $request->proposed_warehouse_id;
                $mutation->user_id = \Auth::user()->id;
                $mutation->status = '1';
                // $model->save();
                $mutation->save();

            }else{
                $model->total_proposed_amount = $model->total_proposed_amount - $request->proposed_amount;
                $model->save();
                return back()->with('info','Saving failed');
            }
        }else{
            return back()->with('info','Check your mutation data');
        }

        // return $this->insertOrUpdate($model);
        return redirect(urlBackendAction('pengejuan-mutasi/index'))->with('success','Data Has Been Inserted');
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
