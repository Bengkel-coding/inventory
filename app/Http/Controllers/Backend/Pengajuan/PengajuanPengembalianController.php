<?php namespace App\Http\Controllers\Backend\Pengajuan;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\Reversion;
use App\Models\ReversionDetail;
use Table;
use Image;
use trinata;

class PengajuanPengembalianController extends TrinataController
{
  
    public function __construct(Reversion $model, ReversionDetail $detail)
    {
        parent::__construct();
        $this->model = $model;
        $this->detail = $detail;

        $this->resource = "backend.pengajuan.pengembalian.";
    }

    public function getData()
    {
        $model = $this->model->select();
// dd($model->get());
        $data = Table::of($model)
            ->addColumn('action',function($model){
                $button = "<a href='".urlBackendAction('detail/'.$model->id)."' class='btn btn-info'>View Detail</a>";
                return $button;
            })
            ->make(true);

        return $data;
    }

    public function getIndex()
    {
        return view($this->resource.'index');
    }

    public function getDetail($id)
    {
        $status = [1 => 'Disetujui', 0 => 'Ditolak'];

        $model = $this->model->findOrFail($id);
        $detail = $this->detail->where('reversion_id',$model->id)->get();

        // dd($detail);


        if($model->status == 1 && \Auth::User()->id == $model->user_id && \Auth::User()->warehouse_id == $model->proposed_warehouse_id){
            $status = [0 => 'Batalkan Usulan'];
        }


        $actionAllow = true;
        switch ($model->status) {
            case '1': //tidak diizinkan bui, user bukan dari operator lapanganan
                if((\Auth::User()->head_id != 0 && \Auth::User()->warehouse_id != 0)) $actionAllow = false;
                break;
            case '2': //tidak diizinkan admin gudang, kepala gudang (pemohon/pemberi)
                if(\Auth::User()->head_id == 0 && \Auth::User()->warehouse_id == 0 && \Auth::User()->role_id > 1) $actionAllow = false;
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
        return view($this->resource.'_detail',compact('model','detail','status','actionAllow'));
    }

    
    
    public function postDetail(Request $request,$id)
    {
        $utilization = $this->model->findOrFail($id);
// dd($request->all());
        if($request->status == 1){
            // $utilization = \App\Models\Utilization::whereMaterialId($model->id)->first();

            switch ($utilization->status) {
                case '1': //disetujui kepala gudang pemohon
                    $utilization->status = 2;

                    // if($utilization->save()){
                    //     $log_utilization = new \App\Models\LogUtilization; //udah
                    //     $log_utilization->material_id = $utilization->material_id;
                    //     $log_utilization->amount = $utilization->amount;
                    //     $log_utilization->proposed_amount = $utilization->proposed_amount;
                    //     $log_utilization->warehouse_id = $utilization->warehouse_id;
                    //     $log_utilization->proposed_warehouse_id = $utilization->proposed_warehouse_id;
                    //     $log_utilization->user_id = \Auth::User()->id;
                    //     $log_utilization->status = 2;
                    //     $log_utilization->save(); 
                    // }
                    break;

                case '2': //disetujui bui
                    $utilization->status = 3;
                    // if($utilization->save()){
                    //     $log_utilization = new \App\Models\LogUtilization;
                    //     $log_utilization->material_id = $utilization->material_id;
                    //     $log_utilization->amount = $utilization->amount;
                    //     $log_utilization->proposed_amount = $utilization->proposed_amount;
                    //     $log_utilization->warehouse_id = $utilization->warehouse_id;
                    //     $log_utilization->proposed_warehouse_id = $utilization->proposed_warehouse_id;
                    //     $log_utilization->user_id = \Auth::User()->id;
                    //     $log_utilization->status = 3;
                    //     $log_utilization->save(); 
                    // }
                    break;

                case '3': //disetujui admin gudang pemberi
                    $utilization->status = 4;
                    // if($utilization->save()){
                    //     $log_utilization = new \App\Models\LogUtilization;
                    //     $log_utilization->material_id = $utilization->material_id;
                    //     $log_utilization->amount = $utilization->amount;
                    //     $log_utilization->proposed_amount = $utilization->proposed_amount;
                    //     $log_utilization->warehouse_id = $utilization->warehouse_id;
                    //     $log_utilization->proposed_warehouse_id = $utilization->proposed_warehouse_id;
                    //     $log_utilization->user_id = \Auth::User()->id;
                    //     $log_utilization->status = 4;
                    //     $log_utilization->save(); 
                    // }
                    break;

                case '4': //disetujui kepala gudang pemberi
                    $utilization->status = 5;
                    // if($utilization->save()){
                    //     $log_utilization = new \App\Models\LogUtilization;
                    //     $log_utilization->material_id = $utilization->material_id;
                    //     $log_utilization->amount = $utilization->amount;
                    //     $log_utilization->proposed_amount = $utilization->proposed_amount;
                    //     $log_utilization->warehouse_id = $utilization->warehouse_id;
                    //     $log_utilization->proposed_warehouse_id = $utilization->proposed_warehouse_id;
                    //     $log_utilization->user_id = \Auth::User()->id;
                    //     $log_utilization->status = 5;
                    //     $log_utilization->save(); 
                    // }

                    // $model->total_proposed_amount = $model->total_proposed_amount - $request->proposed_amount;
                    // $model->amount = $model->amount - $request->proposed_amount;
                    // $model->save();
                    break;                
                default:
                    return redirect(urlBackend('pengajuan-pemanfaatan/index'))->with('info','Anda tidak memiliki otorisasi');
                    break;
            }

            $utilization->save();

            return redirect(urlBackend('pengajuan-pemanfaatan/index'))->with('success','Pengajuan Telah Disetujui');

        }else{
            // $utilization = \App\Models\utilization::whereMaterialId($model->id)->first();
            // $utilization->status = 0;
            // if($utilization->save()){
            //     $model = $this->model->findOrFail($id);
            //     $model->total_proposed_amount = $model->total_proposed_amount - $request->proposed_amount;
            //     $model->save();

            //     $log_utilization = new \App\Models\LogUtilization;
            //             $log_utilization->material_id = $utilization->material_id;
            //             $log_utilization->amount = $utilization->amount;
            //             $log_utilization->proposed_amount = $utilization->proposed_amount;
            //             $log_utilization->warehouse_id = $utilization->warehouse_id;
            //             $log_utilization->proposed_warehouse_id = $utilization->proposed_warehouse_id;
            //             $log_utilization->user_id = \Auth::User()->id;
            //             $log_utilization->status = 0;
            //             $log_utilization->save();
            // }

            return redirect(urlBackend('pengajuan-pemanfaatan/index'))->with('success','Pengajuan Berhasil Ditolak');
        }
    }
}
