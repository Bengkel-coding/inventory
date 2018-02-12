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
        $model = $this->model->findOrFail($id);
        $detail = $this->detail->where('reversion_id',$model->id)->get();

        // dd($detail);
        return view($this->resource.'_detail',compact('model','detail'));
    }

}
