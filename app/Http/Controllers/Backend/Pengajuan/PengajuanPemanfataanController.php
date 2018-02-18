<?php namespace App\Http\Controllers\Backend\Pengajuan;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\Utilization;
use App\Models\UtilizationDetail;
use Table;
use Image;
use trinata;

class PengajuanPemanfataanController extends TrinataController
{
  
    public function __construct(Utilization $model, UtilizationDetail $detail)
    {
        parent::__construct();
        $this->model = $model;
        $this->detail = $detail;

        $this->resource = "backend.pengajuan.pemanfaatan.";
    }

    public function getData()
    {
        $model = $this->model->select()->get();
// dd($model->get());

        foreach ($model as $key => $value) {
            $value->setStatusLabelUtilization($value->status);
        }

        // dd($model);
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
        $detail = $this->detail->where('utilization_id',$model->id)->get();

        // dd($detail);

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
        return view($this->resource.'_detail',compact('model','detail','status', 'actionAllow'));
    }

}
