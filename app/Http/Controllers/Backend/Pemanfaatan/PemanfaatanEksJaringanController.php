<?php namespace App\Http\Controllers\Backend\Pemanfaatan;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Material;
use App\Models\Utilization;
use App\Models\UtilizationDetail;
use App\Models\Warehouse;
use App\Repositories\UploadArea;
use Table;
use Image;
use trinata;
use Cart;


class PemanfaatanEksJaringanController extends TrinataController
{
  
    public function __construct(Material $model, UploadArea $upload, Utilization $utilization, UtilizationDetail $utidetail)
    {
        parent::__construct();
        $this->model = $model;
        $this->utilization = $utilization;
        $this->utidetail = $utidetail;
        $this->warehouse = new Warehouse;
        $this->uploadArea = $upload;
        $this->resource = "backend.pemanfaatan.eks-jaringan.";
    }

    public function getData()
    {

        $cart = Cart::content();
        $keys = [];
        $qty = [];
        foreach ($cart as $key => $value) {
                $keys[$key]=$value->id;
                $qty[$value->id]=$value->qty;
        }

        $model = $this->model->select('id','warehouse_id','name','komag','category', 'year_acquisition','amount','unit_price','unit')->whereType('eksjar')->orderBy('created_at','desc');

        $getId = request()->get('warehouse');
        if(!empty($getId)){
            $model = $model->where('warehouse_id',$getId);
        }
        
        $data = Table::of($model)
            ->addColumn('warehouse_id',function($model){
                // dd(
                return $model->warehouse()->first()->name;
            })
            ->addColumn('id',function($model) use($keys){

                if(in_array($model->id, $keys)){
                    $checkbox = 'checked="checked"';
                }else{
                    $checkbox = '';

                }
                $title = '<input name="title" type="checkbox" class="checklist" data-id="'.$model->id.'" '.$checkbox.'> '.$model->title;


                return $title;

            })
            ->addColumn('action',function($model)use($keys,$qty){
                if(in_array($model->id, $keys)){
                    $readonly = 'readonly="readonly"';
                    $qty = $qty[$model->id];
                    // dd();
                }else{
                    $readonly = '';
                    $qty = 0;
                }
                $amount = $model->amount-$model->total_proposed_amount;

                $status = '<input class="form-control" name="title" type="text" id="amount'.$model->id.'" value="'.$amount.'" readonly="readonly"> <input name="title"  class="form-control"  type="text" value="'.$qty.'" id="amounts'.$model->id.'" '.$readonly.'> ';
                return $status;
            })
            ->make(true);

        return $data;
    }

    public function getIndex()
    {
        $warehouse = $this->warehouse->first();
        $gudang = $this->warehouse->lists('name','id');
        $getId = request()->get('warehouse');
        if(!empty($getId)){
            $param = '?warehouse='.$getId;
        }else{            
            $param = '?warehouse='.$warehouse->id;
        }
        return view($this->resource.'index', compact('param','gudang'));
    }


    public function getAjukan()
    {
        $cart = Cart::content();
        $model = $this->model;

        return view($this->resource.'ajukan',compact('cart','model'));
    }

    public function postAjukan(Request $request)
    {
        $utilization = $this->utilization;
        $inputs = $request->all();
        $cart = Cart::content();

        // dd($inputs,$cart);

        $data['user_id'] = \Auth::user()->id;
        $data['no_utilization'] = $inputs['no_utilization'];
        $data['date_utilization'] = $inputs['date_utilization'];
        $data['to'] = $inputs['to'];
        $data['from'] = $inputs['from'];
        $data['booked_by'] = $inputs['booked_by'];
        $data['expected_receive_date'] = $inputs['expected_receive_date'];
        $data['estimation_code'] = $inputs['estimation_code'];
        $data['date_booked'] = $inputs['date_booked'];
        $data['details'] = $inputs['details'];
        $data['warehouse_id'] = 1;
        $data['created_at'] = \Carbon\Carbon::now('Asia/Jakarta')->toDateTimeString();

        $save = $utilization->create($data);

        foreach (Cart::content() as $key => $item) {             

            $utidetails = $this->utidetail;
            $utidetail['utilization_id']    = $save->id;
            $utidetail['material_id']       = $item->id;
            $utidetail['proposed_amount']   = $item->qty;
            $utidetail['real_amount']       = $item->options['amount'];

            $utidetails->create($utidetail);

            $material = $this->model->whereId($item->id)->first();

            $update['amount'] = $material->amount - $item->qty;

            $material->update($update);
            
         }     

        Cart::destroy();

        return redirect(urlBackendAction('index'))->withSuccess('data has been saved');
    }
}
