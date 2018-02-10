<?php namespace App\Http\Controllers\Backend\Inventaris;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\MaterialMro;
use App\Models\Assessment;
use App\Models\LogAssessment;
use App\Models\Warehouse;
use Table;
use Image;
use trinata;

class InventarisTercatatController extends TrinataController
{
  
    public function __construct(Material $model, Assessment $assessment)
    {
        parent::__construct();
        $this->middleware('auth');
        $this->model = $model;
        $this->assessment = $assessment;

        $this->resource = "backend.inventaris.tercatat.";
    }

    public function getData()
    {
        if(\Auth::User()->warehouse_id > 0){
            $model = $this->model
                        ->select('id','name','komag','description','category',\DB::raw('sum(amount - total_proposed_amount) as amount'),'unit','warehouse_id')
                        ->groupBy('id')
                        ->where('warehouse_id', [\Auth::User()->warehouse_id])
                        ->orderBy('created_at','desc')
                        ->whereType('tercatat');
        }else{
            $model = $this->model
                        ->select('id','name','komag','description','category',\DB::raw('sum(amount - total_proposed_amount) as amount'),'unit','warehouse_id')
                        ->groupBy('id')
                        ->orderBy('created_at','desc')
                        ->whereType('tercatat')
                        ->get();
        }         

        $data = Table::of($model)
            ->addColumn('warehouse_id',function($model){
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
        return view($this->resource.'index', compact('model', 'request'));
    }

    public function getDetail($id)
    {
        $model = $this->model->findOrFail($id);
        $data['ware'] = Warehouse::lists('name','id');
        $model['real_amount'] = $model['amount'] - $model['total_proposed_amount'];

        return view($this->resource.'_form',compact('model', 'data'));
    }

    public function postDetail(Request $request,$id)
    {
        if ((($request->proposed_amount) <= ($request->real_amount)) && (($request->proposed_amount) > 0)){
            $model = $this->model->findOrFail($id);
            $model->total_proposed_amount = $model->total_proposed_amount + $request->proposed_amount;
            $model->status = 1;

            if($model->save()){
                $assessment = new \App\Models\Assessment;
                $assessment->material_id = $model->id;
                $assessment->amount = $model->amount;
                $assessment->proposed_amount = $request->proposed_amount;
                $assessment->user_id = \Auth::user()->id;
                $assessment->status = $request->status;
                $assessment->warehouse_id = $request->warehouse_id;
                $assessment->status = 1;

                if($assessment->save()){
                    $log_assessment = new \App\Models\LogAssessment;
                    $log_assessment->material_id = $model->id;
                    $log_assessment->amount = $model->amount;
                    $log_assessment->proposed_amount = $request->proposed_amount;
                    $log_assessment->user_id = \Auth::user()->id;
                    $log_assessment->status = $request->status;
                    $log_assessment->warehouse_id = $request->warehouse_id;
                    $log_assessment->status = 1;
                    $log_assessment->save();
                }

            }else{
                $model->total_proposed_amount = $model->total_proposed_amount - $request->proposed_amount;
                $model->save();
                return back()->with('info','Saving failed');
            }
        }else{
            return back()->with('info','Jumlah pengajuan anda harus lebih kecil');
        }

        return redirect(urlBackend('pengajuan-inventarisasi/index'))->with('success','Data Has Been Inserted');
    }
}
