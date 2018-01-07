<?php namespace App\Http\Controllers\Backend\Material;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Material;
use App\Repositories\UploadArea;
use Table;
use Image;
use trinata;

class MaterialInvestasiController extends TrinataController
{
  
    public function __construct(Material $model, UploadArea $upload)
    {
        parent::__construct();
        $this->model = $model;
        $this->uploadArea = $upload;

        $this->resource = "backend.material.investasi.";
    }

    public function getData()
    {
        $model = $this->model->select('id','name','komag','category', 'year_acquisition','amount','unit_price','unit')->whereType('investasi')->whereStatus(0)->orderBy('created_at','desc');

        if (isset($request->warehouse) && $request->warehouse > 0) $model->where('warehouse_id', $request->warehouse);
        if (isset($request->category) && $request->category) $model->where('category', $request->category);

        $model = $model->get();
        foreach ($model as $key => $value) {
            $value->categoryAttribute($value->category);
            $value->unitAttribute($value->unit);
            // $value->unitPriceAttribute($value->unit_price);
        }

        $data = Table::of($model)
            ->addColumn('action',function($model){
                $status = $model->status == 'y' ? true : false;
                return trinata::buttons($model->id , [] , $status);
            })
            ->make(true);

        return $data;
    }

    public function getIndex(Request $request)
    {
        $warehouse = \App\Models\Warehouse::lists('name','id')->toArray();
        $warehouse = array_merge([0=>'Pilih Gudang'], $warehouse);

        $urlAjax = 'data?warehouse='.(int) $request->warehouse.'&category='.(string) $request->category;

        return view($this->resource.'index', compact('warehouse','urlAjax'));
    }

    public function getImport(Request $request)
    {
        $model = $this->model;
        $warehouse = $request->warehouse;

        return view($this->resource.'import',compact('model','warehouse'));
    }

    public function postImport(Request $request)
    {
        
        if ($request->file) {
            
            $fileTemplate = \Trinata::globalUpload($request, 'file', 'excel/material');
            
            $path = public_path('contents/excel/material'). '/'.$fileTemplate['filename'];
            
            $savePenelitian = $this->uploadArea->parseInvestasi($path, $request);
            
            return redirect(urlBackendAction('index'))->with('success',\Session::get('total_data') . ' data has been imported');
        }
    }

    public function getCreate()
    {
        $model = $this->model;
        $warehouse = \App\Models\Warehouse::lists('name','id');

        return view($this->resource.'_form',compact('model', 'warehouse'));
    }

    public function postCreate(Request $request)
    {
        $model = $this->model;
        
        if (!$this->uploadArea->isDataExist($request->category, $request->komag, $request->warehouse_id)) {
            return redirect(urlBackendAction('index'))->with('danger','Gagal, Komag Sudah Ada');
        }

        $model->name = $request->name;
        $model->komag = $request->komag;
        $model->code = $request->code;
        $model->unit = $request->unit;
        $model->year_acquisition = $request->year_acquisition;
        $model->amount = $request->amount;
        $model->unit_price = $request->unit_price;
        $model->type = 'investasi';
        $model->category = $request->category;
        $model->description = $request->description;
        $model->warehouse_id = $request->warehouse_id;
        
        if ($model->save()) {
            $mro = new \App\Models\MaterialInvestasi;
            $mro->material_id = $model->id;
            $mro->surplus_material = $request->surplus_material;
            $mro->status = $request->status;
            $mro->save();
        }

        return redirect(urlBackendAction('index'))->with('success','Data Has Been Inserted');
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);
        $warehouse = \App\Models\Warehouse::lists('name','id');

        return view($this->resource.'_form',compact('model', 'warehouse'));
    }

    public function postUpdate(Request $request,$id)
    {
        $model = $this->model->findOrFail($id);
        if (!$this->uploadArea->isDataExist($request->category, $request->komag, $request->warehouse_id, $model->id)) {
            return redirect(urlBackendAction('index'))->with('danger','Gagal, Komag Sudah Ada');
        }
        // dd($request->all());
        $model->name = $request->name;
        $model->komag = $request->komag;
        $model->code = $request->code;
        $model->unit = $request->unit;
        $model->year_acquisition = $request->year_acquisition;
        $model->amount = $request->amount;
        $model->unit_price = $request->unit_price;
        // $model->type = 'mro';
        $model->category = $request->category;
        $model->description = $request->description;
        $model->warehouse_id = $request->warehouse_id;
        
        if ($model->save()) {
            $mro = \App\Models\MaterialInvestasi::whereMaterialId($model->id)->first();
            $mro->surplus_material = $request->surplus_material;
            $mro->status = $request->status;
            // dd($mro);
            $mro->save();
        }

        return redirect(urlBackendAction('index'))->with('success','Data Has Been Updated');
        return $this->insertOrUpdate($model,$inputs);
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);
        return $this->delete($model);
    }

    public function getPublish($id)
    {
        $model = $this->model->findOrFail($id);
        return $this->publish($model);
    }
}
