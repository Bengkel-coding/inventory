<?php namespace App\Http\Controllers\Backend\Pengajuan;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\Assessment;
use App\Models\LogMaterial;
use App\Models\LogAssessment;
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
        $this->role_id = \App\Models\Role::whereRole('bui')->first();

        $this->resource = "backend.pengajuan.inventarisasi.";
    }

    public function getData(Request $request)
    {
        if(\Auth::User()->warehouse_id != 0){
            $model = $this->model
                    ->select('materials.type', 'materials.id', 'materials.name', 'materials.komag', 'materials.description', 'assessments.warehouse_id', 'assessments.status')
                    ->join('assessments', 'materials.id', '=', 'assessments.material_id')
                    // ->where('assessment.status', '=', 1)
                    // ->where('user_id', '=', [\Auth::User()->id])
                    ->where('assessments.warehouse_id', '=', [\Auth::User()->warehouse_id])
                    ->orderBy('assessments.created_at','desc')
                    ->get()
                    ;
        }else{

            $model = $this->model
                    ->select('materials.type', 'materials.id', 'materials.name', 'materials.komag', 'materials.description', 'assessments.warehouse_id', 'assessments.status')
                    ->join('assessments', 'materials.id', '=', 'assessments.material_id')
                    // ->where('assessments.status',2)
                    ->orderBy('assessments.created_at','desc')
                    ->get()
                    ;
        }

        foreach ($model as $key => $value) {
            $value->setStatusLabelAssessment($value->status);
        }       

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
        $status = [1 => 'Disetujui', 0 => 'Ditolak'];

        $model = $this->model
                            ->select('materials.id','materials.name','materials.komag','materials.description','materials.unit','materials.year_acquisition','materials.unit_price', 'assessments.amount', 'assessments.proposed_amount', 'assessments.status','assessments.user_id')
                            ->join('assessments', 'assessments.material_id', '=', 'materials.id')
                            ->where('materials.id', $id)->first();
        $model['total_price'] = $model['unit_price'] * $model['amount'];

        $data = ['ware' => Warehouse::lists('name','id')];

        if ($model->status == 1 && \Auth::user()->id == $model->user_id && \Auth::user()->head_id > 0){
            $status = [0 => 'Batalkan Usulan'];
        }

        $actionAllow = true;
        switch ($model->status) {
            case '1': // jangan ijinkan bui jika data belum di validasi kepala gudang
                if (\Auth::user()->head_id == 0 && \Auth::user()->warehouse_id == 0) $actionAllow = false;
                break;
            case '2': // jangan ijinkan admin jika data sudah divalidasi kepala gudang
                if (\Auth::user()->head_id > 0 && \Auth::user()->warehouse_id != 0) $actionAllow = false;
                break;
            case '3': // jangan ijinkan aksi apapun jika data sudah berhasil inventarisasi
                $actionAllow = false;
                break;
            default: // jangan ijinkan aksi apapun termasuk ditolak
                $actionAllow = false;
                break;
        }

        return view($this->resource.'_form',compact('model','data', 'status', 'actionAllow'));
    }


    public function postDetail(Request $request,$id)
    {
        $model = $this->model->findOrFail($id);

        if ($request->status == 1) {
            
            $assessment = \App\Models\Assessment::whereMaterialId($model->id)->first();

            switch ($assessment->status) {
                case '1': //disetuji kepala gudang
                    $assessment->status = 2;

                    if($assessment->save()){
                        $log_assessment = new \App\Models\LogAssessment; //log
                        $log_assessment->material_id = $assessment->material_id;
                        $log_assessment->amount = $assessment->amount;
                        $log_assessment->proposed_amount = $assessment->proposed_amount;
                        $log_assessment->user_id = \Auth::User()->id;
                        $log_assessment->warehouse_id = $assessment->warehouse_id; //update
                        $log_assessment->status = 2;
                        $log_assessment->save(); 
                    }
                    break;

                case '2': // disetujui admin bui
                    $assessment->status = 3;

                    if($assessment->save()){

                        $log_material = new \App\Models\LogMaterial;
                        $log_material->material_id = $model->id;
                        $log_material->category = $model->category;
                        $log_material->name = $model->name;
                        $log_material->cardnumber = $model->cardnumber;
                        $log_material->komag = $model->komag;
                        $log_material->code = $model->code;
                        $log_material->serialnumber = $model->serialnumber;
                        $log_material->description = $model->description;
                        $log_material->unit = $model->unit;
                        $log_material->year_acquisition = $model->year_acquisition;
                        $log_material->amount = $model->amount;
                        $log_material->unit_price = $model->unit_price;
                        $log_material->total_proposed_amount = $model->total_proposed_amount;
                        $log_material->details = $model->details;
                        $log_material->warehouse_id = $model->warehouse_id;
                        $log_material->status = $model->status;
                        $log_material->type = $model->type;
                        $log_material->note = $model->note;
                        $log_material->save();

                        $log_assessment = new \App\Models\LogAssessment; //log
                        $log_assessment->material_id = $assessment->material_id;
                        $log_assessment->amount = $assessment->amount;
                        $log_assessment->proposed_amount = $assessment->proposed_amount;
                        $log_assessment->user_id = \Auth::User()->id;
                        $log_assessment->warehouse_id = $assessment->warehouse_id; //update
                        $log_assessment->status = 3;
                        $log_assessment->save(); 
                    }

                    $model->total_proposed_amount = $model->total_proposed_amount - $request->proposed_amount;
                    $model->amount = $model->amount - $request->proposed_amount;
                    $model->save();
                    break;
                default:
                    return redirect(urlBackend('pengajuan-inventarisasi/index'))->with('info','Anda tidak memiliki otorisasi');
                    break;
            }
           
            return redirect(urlBackend('pengajuan-inventarisasi/index'))->with('success','Pengajuan Telah Disetujui');
            
        } else {

            $assessment = \App\Models\Assessment::whereMaterialId($model->id)->first();
            $assessment->status = 0;
            if($assessment->save()){
                $model = $this->model->findOrFail($id);
                $model->total_proposed_amount = $model->total_proposed_amount - $request->proposed_amount;
                $model->save();

                $log_assessment = new \App\Models\LogAssessment;
                $log_assessment->material_id = $assessment->material_id;
                $log_assessment->amount = $assessment->amount;
                $log_assessment->proposed_amount = $assessment->proposed_amount;
                $log_assessment->user_id = \Auth::User()->id;
                $log_assessment->warehouse_id = $assessment->warehouse_id; //update
                $log_assessment->status = 0;
                $log_assessment->save(); 
            }

            return redirect(urlBackend('pengajuan-inventarisasi/index'))->with('success','Pengajuan Berhasil Ditolak');
        }
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
