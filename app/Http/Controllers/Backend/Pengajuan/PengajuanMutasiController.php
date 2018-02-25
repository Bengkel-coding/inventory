<?php namespace App\Http\Controllers\Backend\Pengajuan;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\MaterialMro;
use App\Models\MaterialMroabt;
use App\Models\MaterialInvestasi;
use App\Models\MaterialEksjar;
use App\Models\Mutation;
use App\Models\LogMutation;
use App\Models\LogMaterial;
use App\Models\LogMaterialMro;
use App\Models\LogMaterialMroabt;
use App\Models\LogMaterialInvestasi;
use App\Models\LogMaterialEksjar;
use App\Models\Warehouse;
use App\User;
use Table;
use Image;
use trinata;

class PengajuanMutasiController extends TrinataController
{
  
    public function __construct(Material $model, Mutation $mutation, User $user)
    {
        parent::__construct();
        $this->model = $model;
        $this->mutation = $mutation;
        $this->user = $user;

        $this->resource = "backend.pengajuan.mutasi.";
    }

    public function getData(Request $request)
    {
        if(\Auth::User()->head_id == 0 && \Auth::User()->warehouse_id == 0){
            $model = $this->model
                        ->select('materials.type', 'materials.id', 'materials.name', 'materials.komag', 'materials.description', 'mutations.warehouse_id', 'mutations.proposed_warehouse_id', 'mutations.status')
                        ->join('mutations', 'materials.id', '=', 'mutations.material_id')
                        ->get()
                        ;
        }else{
            $model = $this->model
                        ->select('materials.type', 'materials.id', 'materials.name', 'materials.komag', 'materials.description', 'mutations.warehouse_id', 'mutations.proposed_warehouse_id', 'mutations.status')
                        ->join('mutations', 'materials.id', '=', 'mutations.material_id')
                        ->where('mutations.proposed_warehouse_id', '=', \Auth::User()->warehouse_id)
                        ->orWhere('mutations.warehouse_id', '=', \Auth::User()->warehouse_id)
                        ->get()
                        ;
        }
        // $model = $model->get();

        foreach ($model as $key => $value) {
            $value->setStatusLabelMutation($value->status);
        }

        $data = Table::of($model)
            ->addColumn('warehouse_id',function($model){
                return $model->warehouse()->first()->name;
            })
            ->addColumn('proposed_warehouse_id',function($model){
                $proposed_warehouse = injectModel('warehouse')->whereId($model->proposed_warehouse_id)->first();
                return $proposed_warehouse->name;
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

    public function getDetail($id)
    {
        $status = [1 => 'Disetujui', 0 => 'Ditolak'];

        $model = $this->model
                            ->select('mutations.proposed_amount','mutations.amount','mutations.warehouse_id','mutations.proposed_warehouse_id', 'materials.category', 'materials.name', 'materials.komag', 'materials.cardnumber', 'materials.description', 'materials.unit', 'materials.year_acquisition', 'materials.unit_price', 'mutations.user_id', 'mutations.status')
                            ->join('mutations', 'mutations.material_id', '=', 'materials.id')
                            ->where('materials.id', $id)->first();
        
        $data = ['ware' => Warehouse::lists('name','id')];

        // dd(\Auth::User()->id);

        if($model->status == 1 && \Auth::User()->id == $model->user_id && \Auth::User()->warehouse_id == $model->proposed_warehouse_id){
            $status = [0 => 'Batalkan Usulan'];
        }

        $actionAllow = true;
        switch ($model->status) {
            case '1': //tidak diizinkan bui, user bukan dari gudang pemohon
                if((\Auth::User()->head_id == 0 && \Auth::User()->warehouse_id == 0) || \Auth::User()->warehouse_id != $model->proposed_warehouse_id || (\Auth::User()->head_id > 0 && \Auth::User()->id != $model->user_id)) $actionAllow = false;
                break;
            case '2': //tidak diizinkan admin gudang, kepala gudang (pemohon/pemberi)
                if(\Auth::User()->head_id != 0 || \Auth::User()->warehouse_id > 0) $actionAllow = false;
                break;
            case '3': //tidak diizinkan bui, kepala gudang pemberi, user pemohon
                if(\Auth::User()->head_id == 0 || \Auth::User()->warehouse_id != $model->warehouse_id) $actionAllow = false;
                break;
            case '4': //tidak diizinkan bui, admin gudang pemberi, user pemohon
                if((\Auth::User()->head_id == 0 && \Auth::user()->warehouse_id == 0) || \Auth::User()->head_id > 0 || \Auth::User()->warehouse_id != $model->warehouse_id) $actionAllow = false;
                break;
            default:
                $actionAllow = false;
                break;
        }

        return view($this->resource.'_detail',compact('model', 'data', 'status', 'actionAllow'));
        
    }       

    public function postDetail(Request $request,$id)
    {
        $model = $this->model->findOrFail($id);

        if($request->status == 1){
            $mutation = \App\Models\Mutation::whereMaterialId($model->id)->first();

            switch ($mutation->status) {
                case '1': //disetujui kepala gudang pemohon
                    $mutation->status = 2;

                    if($mutation->save()){
                        $log_mutation = new \App\Models\LogMutation; //udah
                        $log_mutation->material_id = $mutation->material_id;
                        $log_mutation->amount = $mutation->amount;
                        $log_mutation->proposed_amount = $mutation->proposed_amount;
                        $log_mutation->warehouse_id = $mutation->warehouse_id;
                        $log_mutation->proposed_warehouse_id = $mutation->proposed_warehouse_id;
                        $log_mutation->user_id = \Auth::User()->id;
                        $log_mutation->status = 2;
                        $log_mutation->save(); 
                    }
                    break;

                case '2': //disetujui bui
                    $mutation->status = 3;
                    if($mutation->save()){
                        $log_mutation = new \App\Models\LogMutation;
                        $log_mutation->material_id = $mutation->material_id;
                        $log_mutation->amount = $mutation->amount;
                        $log_mutation->proposed_amount = $mutation->proposed_amount;
                        $log_mutation->warehouse_id = $mutation->warehouse_id;
                        $log_mutation->proposed_warehouse_id = $mutation->proposed_warehouse_id;
                        $log_mutation->user_id = \Auth::User()->id;
                        $log_mutation->status = 3;
                        $log_mutation->save(); 
                    }
                    break;

                case '3': //disetujui admin gudang pemberi
                    $mutation->status = 4;
                    if($mutation->save()){
                        $log_mutation = new \App\Models\LogMutation;
                        $log_mutation->material_id = $mutation->material_id;
                        $log_mutation->amount = $mutation->amount;
                        $log_mutation->proposed_amount = $mutation->proposed_amount;
                        $log_mutation->warehouse_id = $mutation->warehouse_id;
                        $log_mutation->proposed_warehouse_id = $mutation->proposed_warehouse_id;
                        $log_mutation->user_id = \Auth::User()->id;
                        $log_mutation->status = 4;
                        $log_mutation->save(); 
                    }
                    break;

                case '4': //disetujui kepala gudang pemberi
                    $mutation->status = 5;
                    if($mutation->save()){

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

                        $new_material = Material::find($id);
                        $new = $new_material->replicate();
                        $new->amount = $mutation->proposed_amount;
                        $new->total_proposed_amount = 0;
                        $new->warehouse_id = $mutation->proposed_warehouse_id;
                        $new->save();

                        if($new->type == 'mro'){
                            $new_typematerial = MaterialMro::whereMaterialId($id)->first();
                            $new_data = $new_typematerial->replicate();
                            $new_data->material_id = $new->id;
                            $new_data->save();
                        }elseif($new->type == 'mroabt'){
                            $new_typematerial = MaterialMroabt::whereMaterialId($id)->first();
                            $new_data = $new_typematerial->replicate();
                            $new_data->material_id = $new->id;
                            $new_data->save();
                        }elseif($new->type == 'investasi'){
                            $new_typematerial = MaterialInvestasi::whereMaterialId($id)->first();
                            $new_data = $new_typematerial->replicate();
                            $new_data->material_id = $new->id;
                            $new_data->save();
                        }elseif($new->type == 'eksjar'){
                            $new_typematerial = MaterialEksjar::whereMaterialId($id)->first();
                            $new_data = $new_typematerial->replicate();
                            $new_data->material_id = $new->id;
                            $new_data->save();
                        }

                        $log_mutation = new \App\Models\LogMutation;
                        $log_mutation->material_id = $mutation->material_id;
                        $log_mutation->amount = $mutation->amount;
                        $log_mutation->proposed_amount = $mutation->proposed_amount;
                        $log_mutation->warehouse_id = $mutation->warehouse_id;
                        $log_mutation->proposed_warehouse_id = $mutation->proposed_warehouse_id;
                        $log_mutation->user_id = \Auth::User()->id;
                        $log_mutation->status = 5;
                        $log_mutation->save(); 
                    }

                    $model->total_proposed_amount = $model->total_proposed_amount - $request->proposed_amount;
                    $model->amount = $model->amount - $request->proposed_amount;
                    $model->save();
                    $log_material->amount_current = $model->amount;
                    $log_material->action = 'mutasi';
                    $log_material->save();
                    break;                
                default:
                    return redirect(urlBackend('pengajuan-mutasi/index'))->with('info','Anda tidak memiliki otorisasi');
                    break;
            }

            return redirect(urlBackend('pengajuan-mutasi/index'))->with('success','Pengajuan Telah Disetujui');

        }else{
            $mutation = \App\Models\Mutation::whereMaterialId($model->id)->first();
            $mutation->status = 0;
            if($mutation->save()){
                $model = $this->model->findOrFail($id);
                $model->total_proposed_amount = $model->total_proposed_amount - $request->proposed_amount;
                $model->save();

                $log_mutation = new \App\Models\LogMutation;
                        $log_mutation->material_id = $mutation->material_id;
                        $log_mutation->amount = $mutation->amount;
                        $log_mutation->proposed_amount = $mutation->proposed_amount;
                        $log_mutation->warehouse_id = $mutation->warehouse_id;
                        $log_mutation->proposed_warehouse_id = $mutation->proposed_warehouse_id;
                        $log_mutation->user_id = \Auth::User()->id;
                        $log_mutation->status = 0;
                        $log_mutation->save();
            }

            return redirect(urlBackend('pengajuan-mutasi/index'))->with('success','Pengajuan Berhasil Ditolak');
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
