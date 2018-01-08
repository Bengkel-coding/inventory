<?php namespace App\Http\Controllers\Backend\Pengajuan;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\Mutation;
use App\Models\Warehouse;
use Table;
use Image;
use trinata;

class PengajuanMutasiController extends TrinataController
{
  
    public function __construct(Material $model, Mutation $mutation)
    {
        parent::__construct();
        $this->model = $model;
        $this->mutation = $mutation;

        $this->resource = "backend.pengajuan.mutasi.";
    }

    public function getData(Request $request)
    {
        // if (isset($request->warehouse) && $request->warehouse > 0) $model->where('warehouse_id', $request->warehouse);

        // if (isset($request->type) && $request->type) $model->where('type', $request->type);

        $model = 
                    // \DB::table('materials')
                    $this->model
                    ->join('mutations', 'materials.id', '=', 'mutations.material_id')
                    // ->join('warehouses', 'mutations.warehouse_id', '=', 'warehouses.id')
                    ->select('materials.id', 'materials.name', 'materials.komag', 'materials.category', 'mutations.amount', 'mutations.proposed_amount', 'mutations.warehouse_id', 'mutations.proposed_warehouse_id', 'mutations.status')
                    ->where('materials.status', '=', 0)
                    ;
        
        // dd($model->toSql());
        $data = Table::of($model)
            ->addColumn('warehouse_id',function($model){
                // dd(
                return $model->warehouse()->first()->name;
            })
            ->addColumn('proposed_warehouse_id',function($model){
                $proposed_warehouse = injectModel('warehouse')->whereId($model->proposed_warehouse_id)->first();
                return $proposed_warehouse->name;
            })
            ->addColumn('action',function($model){
                $status = $model->status == 'y' ? true : false;
                return trinata::buttons($model->id , [] , $status);
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
        return $this->delete($model,[$model->image]);
    }

    public function getPublish($id)
    {
        $model = $this->model->findOrFail($id);
        return $this->publish($model);
    }
}
