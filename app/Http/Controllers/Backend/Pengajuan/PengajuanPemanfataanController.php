<?php namespace App\Http\Controllers\Backend\Pengajuan;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\Utilization;
use App\Models\LogUtilization;
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
        // dd(\Auth::User(),$model);
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
        return view($this->resource.'_detail',compact('model','detail','status', 'actionAllow'));
    }
    
    public function postDetail(Request $request,$id)
    {
        $utilization = $this->model->findOrFail($id);
        // $detail = $utilization->utilizationDetail();
        // dd($detail->get());
// dd($request->all());
        if($request->status == 1){
            // $utilization = \App\Models\Utilization::whereMaterialId($model->id)->first();

            switch ($utilization->status) {
                case '1': //disetujui kepala gudang pemohon
                    $utilization->status = 2;

                    if($utilization->save()){
                        $log_utilization = new LogUtilization; //udah
                        $log_utilization->no_utilization = $utilization->no_utilization;
                        $log_utilization->date_utilization = $utilization->date_utilization;
                        $log_utilization->to = $utilization->to;
                        $log_utilization->from = $utilization->from;
                        $log_utilization->expected_receive_date = $utilization->expected_receive_date;
                        $log_utilization->booked_by = $utilization->booked_by;
                        $log_utilization->estimation_code = $utilization->estimation_code;
                        $log_utilization->date_booked = $utilization->date_booked;
                        $log_utilization->details = $utilization->details;
                        $log_utilization->type = $utilization->type;
                        $log_utilization->warehouse_id = $utilization->warehouse_id;
                        $log_utilization->user_id = \Auth::User()->id;
                        $log_utilization->status = 2;
                        $log_utilization->save(); 
                    }
                    break;

                case '2': //disetujui bui
                    $utilization->status = 3;
                    if($utilization->save()){
                        $log_utilization = new LogUtilization; //udah
                        $log_utilization->no_utilization = $utilization->no_utilization;
                        $log_utilization->date_utilization = $utilization->date_utilization;
                        $log_utilization->to = $utilization->to;
                        $log_utilization->from = $utilization->from;
                        $log_utilization->expected_receive_date = $utilization->expected_receive_date;
                        $log_utilization->booked_by = $utilization->booked_by;
                        $log_utilization->estimation_code = $utilization->estimation_code;
                        $log_utilization->date_booked = $utilization->date_booked;
                        $log_utilization->details = $utilization->details;
                        $log_utilization->type = $utilization->type;
                        $log_utilization->warehouse_id = $utilization->warehouse_id;
                        $log_utilization->user_id = \Auth::User()->id;
                        $log_utilization->status = 3;
                        $log_utilization->save(); 
                    }
                    break;

                case '3': //disetujui admin gudang pemberi
                    $utilization->status = 4;
                    if($utilization->save()){
                        $log_utilization = new LogUtilization; //udah
                        $log_utilization->no_utilization = $utilization->no_utilization;
                        $log_utilization->date_utilization = $utilization->date_utilization;
                        $log_utilization->to = $utilization->to;
                        $log_utilization->from = $utilization->from;
                        $log_utilization->expected_receive_date = $utilization->expected_receive_date;
                        $log_utilization->booked_by = $utilization->booked_by;
                        $log_utilization->estimation_code = $utilization->estimation_code;
                        $log_utilization->date_booked = $utilization->date_booked;
                        $log_utilization->details = $utilization->details;
                        $log_utilization->type = $utilization->type;
                        $log_utilization->warehouse_id = $utilization->warehouse_id;
                        $log_utilization->user_id = \Auth::User()->id;
                        $log_utilization->status = 4;
                        $log_utilization->save(); 
                    }
                    break;

                case '4': //disetujui kepala gudang pemberi
                    $utilization->status = 5;
                    if($utilization->save()){
                        $log_utilization = new LogUtilization; //udah
                        $log_utilization->no_utilization = $utilization->no_utilization;
                        $log_utilization->date_utilization = $utilization->date_utilization;
                        $log_utilization->to = $utilization->to;
                        $log_utilization->from = $utilization->from;
                        $log_utilization->expected_receive_date = $utilization->expected_receive_date;
                        $log_utilization->booked_by = $utilization->booked_by;
                        $log_utilization->estimation_code = $utilization->estimation_code;
                        $log_utilization->date_booked = $utilization->date_booked;
                        $log_utilization->details = $utilization->details;
                        $log_utilization->type = $utilization->type;
                        $log_utilization->warehouse_id = $utilization->warehouse_id;
                        $log_utilization->user_id = \Auth::User()->id;
                        $log_utilization->status = 5;
                        $log_utilization->save(); 
                    

                        foreach ($utilization->utilizationDetail()->get() as $key => $value) 
                        {

                            $model = new Material;
                            $model = $model->findOrFail($value->material_id);

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

                            $model->total_proposed_amount = $model->total_proposed_amount - $value->proposed_amount;
                            $model->amount = $model->amount - $value->proposed_amount;
                            $model->save();

                            $log_material->amount_current = $model->amount;
                            $log_material->action = "pemanfaatan";
                            $log_material->save();
                        }
                    }
                    
                    break;                
                default:
                    return redirect(urlBackend('pengajuan-pemanfaatan/index'))->with('info','Anda tidak memiliki otorisasi');
                    break;
            }

            // $utilization->save();

            return redirect(urlBackend('pengajuan-pemanfaatan/index'))->with('success','Pengajuan Telah Disetujui');

        }else{

            $utilization->status = 0;
            if($utilization->save()){
                foreach ($utilization->utilizationDetail()->get() as $key => $value) 
                {

                    $model = new Material;
                    $model = $model->findOrFail($value->material_id);

                    $model->total_proposed_amount = $model->total_proposed_amount - $value->proposed_amount;
                    $model->save();
                }

                $log_utilization = new LogUtilization; //udah
                $log_utilization->no_utilization = $utilization->no_utilization;
                $log_utilization->date_utilization = $utilization->date_utilization;
                $log_utilization->to = $utilization->to;
                $log_utilization->from = $utilization->from;
                $log_utilization->expected_receive_date = $utilization->expected_receive_date;
                $log_utilization->booked_by = $utilization->booked_by;
                $log_utilization->estimation_code = $utilization->estimation_code;
                $log_utilization->date_booked = $utilization->date_booked;
                $log_utilization->details = $utilization->details;
                $log_utilization->type = $utilization->type;
                $log_utilization->warehouse_id = $utilization->warehouse_id;
                $log_utilization->user_id = \Auth::User()->id;
                $log_utilization->status = 0;
                $log_utilization->save();
            }

            return redirect(urlBackend('pengajuan-pemanfaatan/index'))->with('success','Pengajuan Berhasil Ditolak');
        }
    }
}
