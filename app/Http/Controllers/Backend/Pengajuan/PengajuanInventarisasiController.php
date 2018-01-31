<?php namespace App\Http\Controllers\Backend\Pengajuan;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\Assessment;
use App\Models\Warehouse;
use App\User;
use Table;
use Image;
use trinata;

class PengajuanInventarisasiController extends TrinataController
{
  
    public function __construct(Material $model, Assessment $assessment)
    {
        parent::__construct();
        $this->middleware('auth');
        $this->model = $model;
        $this->assessment = $assessment;

        $this->resource = "backend.pengajuan.inventarisasi.";
    }

    public function getData(Request $request)
    {
        if((\Auth::User()->head_id != 0) && (\Auth::User()->warehouse_id != 0)){
            $model = $this->model
                    ->select('materials.type', 'materials.id', 'materials.name', 'materials.komag', 'materials.description', 'assessments.warehouse_id', 'assessments.status')
                    ->join('assessments', 'materials.id', '=', 'assessments.material_id')
                    // ->where('assessment.status', '=', 1)
                    // ->where('user_id', '=', [\Auth::User()->id])
                    ->where('assessments.warehouse_id', '=', \Auth::User()->warehouse_id)
                    ->get()
                    ;
        }else{
            $model = $this->model
                    ->select('materials.type', 'materials.id', 'materials.name', 'materials.komag', 'materials.description', 'assessments.warehouse_id', 'assessments.status')
                    ->join('assessments', 'materials.id', '=', 'assessments.material_id')
                    ->get()
                    ;
        }

        foreach ($model as $key => $value) {
            $value->setStatusLabelAssessment($value->status);
        }       

        // $model = $this->model->select('id','title','status');

        $data = Table::of($model)
            ->addColumn('warehouse_id',function($model){
                return $model->warehouse()->first()->name;
            })
            ->addColumn('action',function($model){
                $button = "<a href='".urlBackendAction('detail/'.$model->id)."' class='btn btn-info'>View Detail</a>";
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
        return view($this->resource.'_form',compact('model'));
    }

   public function postCreate(Requests\Backend\CrudRequest $request)
    {
        $model = $this->model;
        $inputs = $request->all();
        $inputs['image'] = $this->handleUpload($request,$model,'image',[100,100]);
        return $this->insertOrUpdate($model,$inputs);
    }

    public function getDetail($id)
    {
        $model = $this->model
                            ->select('materials.id','materials.name','materials.komag','materials.description','materials.unit','materials.year_acquisition','materials.unit_price', 'assessments.amount', 'assessments.proposed_amount', 'assessments.status')
                            ->join('assessments', 'assessments.material_id', '=', 'materials.id')
                            ->where('materials.id', $id)->first();
        $model['total_price'] = $model['unit_price'] * $model['amount'];

         $data = ['ware' => Warehouse::lists('name','id')];

        return view($this->resource.'_form',compact('model','data'));
    }

    public function postDetail(Request $request,$id)
    {
        $model = $this->model->findOrFail($id);
        if(($request->status = 1) && (\Auth::User()->head_id == 0) && ((\Auth::User()->warehouse_id) == ($model->warehouse_id))){
            $model = $this->model->findOrFail($id);
            // dd($model);

            if($model->save()){
                $assessment = \App\Models\Assessment::whereMaterialId($model->id)->first();
                $assessment->status = 2;
                $assessment->save();
            }

            return redirect(urlBackend('pengajuan-inventarisasi/index'))->with('success','Pengajuan Telah Disetujui');
        }elseif(($request->status = 2) && (\Auth::User()->head_id == 0) && (\Auth::User()->warehouse_id == 0)){$assessment = \App\Models\Assessment::whereMaterialId($model->id)->first();
            $assessment->status = 3;
            
            if($assessment->save()){
                $model = $this->model->findOrFail($id);
                $model->total_proposed_amount = $model->total_proposed_amount - $request->proposed_amount;
                $model->amount = $model->amount - $request->proposed_amount;
            }

            return redirect(urlBackend('pengajuan-inventarisasi/index'))->with('success','Pengajuan Telah Disetujui');
        }else{
            $assessment = \App\Models\Assessment::whereMaterialId($model->id)->first();
            $assessment->status = 0;
            if($assessment->save()){
                $model = $this->model->findOrFail($id);
                $model->total_proposed_amount = $model->total_proposed_amount - $request->proposed_amount;
            }

            return redirect(urlBackend('pengajuan-inventarisasi/index'))->with('success','Pengajuan Berhasil Ditolak');
        }
        // else(($request->status = 1) && (\Auth::User()->head_id == 0)){

        // }

        return redirect(urlBackend('pengajuan-inventarisasi/index'))->with('success','Pengajuan Telah Disetujui');
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
