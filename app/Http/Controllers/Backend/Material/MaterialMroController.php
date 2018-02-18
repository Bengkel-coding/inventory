<?php namespace App\Http\Controllers\Backend\Material;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Material;
use App\Repositories\UploadArea;
use Table;
use Image;
use trinata;
use Excel;

class MaterialMroController extends TrinataController
{
  
    public function __construct(Material $model, UploadArea $upload)
    {
    	parent::__construct();
        $this->model = $model;
        $this->uploadArea = $upload;

        $this->resource = "backend.material.mro.";
    }

    public function getData(Request $request)
    {

    	$model = $this->model->join('warehouses', 'materials.warehouse_id','=','warehouses.id')->select('materials.id','materials.name','materials.komag','materials.category', 'materials.year_acquisition','materials.amount','materials.unit_price','materials.unit','materials.description','warehouses.name as warehouse','materials.status')->whereType('mro')->orderBy('materials.created_at','desc');

        if (isset($request->warehouse) && $request->warehouse > 0) $model->where('warehouse_id', $request->warehouse);
        if (isset($request->category) && $request->category) $model->where('category', $request->category);

        $model = $model->get();
        foreach ($model as $key => $value) {
            $value->categoryAttribute($value->category);
            $value->unitAttribute($value->unit);
            $value->unitPriceAttribute($value->unit_price);
        }

    	$data = Table::of($model)
    		->addColumn('action',function($model){
                // $status = $model->status == 'y' ? true : false;
                $status = ['update','delete'];
                if ($model->status > 0) array_splice($status, 1);
                return trinata::buttons($model->id , $status);
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
        // $warehouse = $request->warehouse;
        $warehouse = \App\Models\Warehouse::lists('name','id')->toArray();
        // $warehouse = array_merge($warehouse);

        return view($this->resource.'import',compact('model','warehouse'));
    }

    public function getExport(Request $request)
    {

        $data = []; 
        
        $model = $this->model->whereType('mro');
        if ($request->warehouse) $model->where('warehouse_id', $request->warehouse);
        if ($request->category) $model->where('category', $request->category);

        $data['rows'] = $model->take(1)->get();
        $data['column'] = ['Nama Material',
                        'KOMAG','Tahun Perolehan', 'Jumlah Material', 'Harga Satuan', 'Harga Total'];
        
        $filename = 'export-material-mro-'.date('Ymdhis');
        
        Excel::create($filename, function($excel) use($data) {
            $sheetname = 'Sheet 1';
            $excel->sheet($sheetname, function($sheet) use($data) {
                $sheet->setAllBorders('thin');
                $sheet->row(1, $data['column']); //header
                $baris = 2;
                foreach($data['rows'] as $value){
                    
                    $sheet->row($baris++, [$value->name, $value->komag, $value->year_acquisition, $value->amount, $value->unit_price, 1111]);
                }
            });
        })->export('xls');

    }

    public function postImport(Request $request)
    {
        
        if ($request->file) {
            
            $fileTemplate = \Trinata::globalUpload($request, 'file', 'excel/material');
            
            $path = public_path('contents/excel/material'). '/'.$fileTemplate['filename'];
            
            $savePenelitian = $this->uploadArea->parseMro($path, $request);
            
            return redirect(urlBackendAction('index'))->with('success',\Session::get('total_data') . ' data has been imported');
        }
    }

    public function getCreate()
    {
    	$model = $this->model;
        $warehouse = \App\Models\Warehouse::lists('name','id');
        // $warehouse = array_merge([0=>'Pilih Gudang'], $warehouse);
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
        $model->serialnumber = $request->serialnumber;
        $model->unit = $request->unit;
        $model->year_acquisition = $request->year_acquisition;
        $model->amount = $request->amount;
        $model->unit_price = $request->unit_price;
        $model->type = 'mro';
        $model->category = $request->category;
        $model->description = $request->description;
        $model->warehouse_id = $request->warehouse_id;
        
        if ($model->save()) {
            $mro = new \App\Models\MaterialMro;
            $mro->material_id = $model->id;
            $mro->min_stock_level = $request->min_stock_level;
            $mro->max_stock_level = $request->max_stock_level;
            $mro->excess_stock = $request->excess_stock;
            $mro->status = $request->status;
            $mro->save();
        }

        return redirect(urlBackendAction('index'))->with('success','Data Has Been Inserted');
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);

        $warehouse = \App\Models\Warehouse::lists('name','id');

        return view($this->resource.'_form',compact('model','warehouse'));
    }

    public function postUpdate(Request $request,$id)
    {
        $model = $this->model->findOrFail($id);
        if (!$this->uploadArea->isDataExist($request->category, $request->komag, $request->warehouse_id, $model->id)) {
            return redirect(urlBackendAction('index'))->with('danger','Gagal, Komag Sudah Ada');
        }

        $model->name = $request->name;
        $model->komag = $request->komag;
        $model->serialnumber = $request->serialnumber;
        $model->unit = $request->unit;
        $model->year_acquisition = $request->year_acquisition;
        $model->amount = $request->amount;
        $model->unit_price = $request->unit_price;
        // $model->type = 'mro';
        $model->category = $request->category;
        $model->description = $request->description;
        $model->warehouse_id = $request->warehouse_id;
        
        if ($model->save()) {
            $mro = \App\Models\MaterialMro::whereMaterialId($model->id)->first();
            // $mro->material_id = $model->id;
            $mro->min_stock_level = $request->min_stock_level;
            $mro->max_stock_level = $request->max_stock_level;
            $mro->excess_stock = $request->excess_stock;
            $mro->status = $request->status;
            $mro->save();
        }

        return redirect(urlBackendAction('index'))->with('success','Data Has Been Updated');
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
