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


class PemanfaatanTercatatController extends TrinataController
{
    public function __construct(Material $model, UploadArea $upload, Utilization $utilization, UtilizationDetail $utidetail)
    {
        parent::__construct();
        $this->model = $model;
        $this->utilization = $utilization;
        $this->utidetail = $utidetail;
        $this->warehouse = new Warehouse;
        $this->uploadArea = $upload;
        $this->resource = "backend.pemanfaatan.tercatat.";
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

        $model = $this->model->select('id','warehouse_id','name','komag','category', 'year_acquisition','amount','unit_price','unit')->whereType('tercatat')->orderBy('created_at','desc');

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
        $head = \Auth::user()->head()->first();

        // dd($inputs,$cart);

        if ($head->warehouse_id==0) {
            return redirect(urlBackend('pemanfaatan-tercatat/ajukan'))->withInfo('data warehouse empty');
        }else{
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
            $data['warehouse_id'] = $head->warehouse_id;
            $data['status'] = 1;
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

                // $update['amount'] = $material->amount - $item->qty;
                $update['total_proposed_amount'] = $material->total_proposed_amount + $item->qty;

                $material->update($update);
                
             }     

            Cart::destroy();

            return redirect(urlBackend('pengajuan-pemanfaatan/index'))->withSuccess('data has been saved');
        }
    }
    


    public function getRemovecart($id)
    {

        // dd($request->all(),$request['item']);
        // $rowId = $request['item'];
        $cartQty = Cart::content()->where('id',$id)->first();
        Cart::remove($cartQty->rowid);

        $cart = Cart::content();
        $jumlah = count($cart);

        return response()->json(['response' => 'This is get method','data' =>$jumlah,'status'=>true]);
    }

    public function getDeletecart($id)
    {

        // dd($request->all(),$request['item']);
        // $rowId = $request['item'];
        $cartQty = Cart::content()->where('id',$id)->first();
        Cart::remove($cartQty->rowid);

        $cart = Cart::content();
        $jumlah = count($cart);

        // return 
        // return redirect(urlBackendAction('index'))->withSuccess('data has been saved');
        return redirect()->back()->withSuccess('data has been deleted');
    }
    public function getAddcart($id,$qty=0)
    {        

        $material = $this->model->whereId($id)->first();
        
        Cart::add(array('id' => $id, 'name' => $material->name, 'qty' => $qty ,'price'=>$material->unit_price, 'options' => [
                            'category' => $material->category,
                            'cardnumber' => $material->cardnumber,
                            'komag' => $material->komag,
                            'description' => $material->description,
                            'unit' => $material->unit,
                            'year_acquisition' => $material->year_acquisition,
                            'amount' => $material->amount,
                            'total_proposed_amount' => $material->total_proposed_amount,
                            'warehouse_id' => $material->warehouse_id,
                            'status' => $material->status,
                            'type' => $material->type,
                            ]));

        $cart = Cart::content();
        $jumlah = count($cart);
        // dd($cart);

        return response()->json(['response' => 'This is get method','data' =>$jumlah,'status'=>true]);
        // return view('frontend.inventaris.cart', compact('cart'));
    }
    
}
