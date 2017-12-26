<?php namespace App\Http\Controllers\Backend\Material;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Material;
use App\Repositories\UploadArea;

use Table;
use Image;
use trinata;

class MaterialMroController extends TrinataController
{
  
    public function __construct(Material $model, UploadArea $upload)
    {
    	parent::__construct();
        $this->model = $model;
        $this->uploadArea = $upload;

        $this->resource = "backend.material.mro.";
    }

    public function getData()
    {
    	$model = $this->model->select('id','name','komag','category', 'year_acquisition','amount','unit_price','unit');

    	$data = Table::of($model)
    		->addColumn('action',function($model){
                $status = $model->status == 'y' ? true : false;
    			return trinata::buttons($model->id , [] , $status);
    		})
    		->make(true);

    	return $data;
    }

    public function getIndex()
    {
        $warehouse = \App\Models\Warehouse::lists('name','id');
        
    	return view($this->resource.'index', compact('warehouse'));
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
            
            $fileTemplate = \Trinata::globalUpload($request, 'file', 'excel/penelitian');
            
            $path = public_path('contents/excel/penelitian'). '/'.$fileTemplate['filename'];
            
            $savePenelitian = $this->uploadArea->parseMro($path, $request);
            
            return redirect(urlBackendAction('index'))->with('success',\Session::get('total_data') . ' data has been imported');
        }
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

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);

        return view($this->resource.'_form',compact('model'));
    }

    public function postUpdate(Requests\Backend\CrudRequest $request,$id)
    {
        $model = $this->model->findOrFail($id);
        $inputs = $request->all();
        $inputs['image'] = $this->handleUpload($request,$model,'image',[100,100]);
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
