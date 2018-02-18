<?php namespace App\Http\Controllers\Backend\Pengembalian;



use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\Utilization;
use App\Models\Reversion;
use App\Models\UtilizationDetail;
use App\Models\ReversionDetail;
use Table;
use Image;
use trinata;
use DB;
use Cart;

class PengembalianMroAbtController extends TrinataController
{
   public function __construct(Reversion $reversion, ReversionDetail $reversiondetail, Utilization $model, UtilizationDetail $detail)
    {
        parent::__construct();
        $this->model = $model;
        $this->detail = $detail;
        $this->reversion = $reversion;
        $this->reversiondetail = $reversiondetail;

        $this->resource = "backend.pengembalian.mro-abt.";
    }

    public function getData()
    {
        $model = $this->model->select()->where('type','mroabt')->where('status',5);

        $data = Table::of($model)
            ->addColumn('action',function($model){

                $button = "<a href='".urlBackendAction('detail/'.$model->id)."' class='btn btn-info'>View Detail</a>";
                return $button;
                // $status = $model->status == 'y' ? true : false;
                // return trinata::buttons($model->id , [] , $status);
            })
            ->make(true);

        return $data;
    }

    public function getIndex()
    {
        return view($this->resource.'index');
    }


    public function getDatadetail($id)
    {
        $cart = Cart::content();
        $keys = [];
        $qty = [];
        foreach ($cart as $key => $value) {
                $keys[$key]=$value->id;
                $qty[$value->id]=$value->qty;
        }

        $model = $this->model->findOrFail($id);
        $detail = DB::table('utilization_details as a')
                ->join('materials as b','a.material_id','=','b.id')
                ->select(DB::raw('a.*, b.name,b.komag,b.description,b.year_acquisition,b.unit_price,b.type,b.category,b.unit'))
                ->where('a.utilization_id',$model->id);
        // dd($detail->get());
        $data = Table::of($detail)
            ->addColumn('id',function($model) use($keys){

                if(in_array($model->id, $keys)){
                    $checkbox = 'checked="checked"';
                }else{
                    $checkbox = '';

                }
                $title = '<input name="title" type="checkbox" class="checklist" data-id="'.$model->id.'" '.$checkbox.'>';


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
                // $amount = $model->amount-$model->total_proposed_amount;

                $status = '<input class="form-control" name="title" type="text" id="amount'.$model->id.'" value="'.$model->proposed_amount.'" readonly="readonly"> <input name="title"  class="form-control"  type="text" value="'.$qty.'" id="amounts'.$model->id.'" '.$readonly.'> ';
                return $status;
            })
            ->make(true);

        return $data;

        return $data;
    }

    public function getDetail($id)
    {
        $model = $this->model->find($id);
        // dd($id);
        return view($this->resource.'_details',compact('id','model'));
    }

    public function getAjukan()
    {
        $cart = Cart::content();
        $model = $this->model;

        return view($this->resource.'ajukan',compact('cart','model'));
    }

    public function postAjukan(Request $request)
    {
        $reversion = $this->reversion;
        $inputs = $request->all();
        $cart = Cart::content();

        // dd($inputs,$cart);

        $data['user_id'] = \Auth::user()->id;
        $data['no_return'] = $inputs['no_return'];
        $data['date_return'] = $inputs['date_return'];
        $data['received_by'] = $inputs['received_by'];
        $data['no_request'] = $inputs['no_request'];
        $data['date_request'] = $inputs['date_request'];
        // $data['expected_receive_date'] = $inputs['expected_receive_date'];
        // $data['estimation_code'] = $inputs['estimation_code'];
        // $data['date_booked'] = $inputs['date_booked'];
        // $data['details'] = $inputs['details'];
        // $data['warehouse_id'] = 1;
        $data['status'] = 1;
        $data['created_at'] = \Carbon\Carbon::now('Asia/Jakarta')->toDateTimeString();

        $save = $reversion->create($data);

        foreach (Cart::content() as $key => $item) {             

            $reversiondetails = $this->reversiondetail;
            $reversiondetail['reversion_id']    = $save->id;
            $reversiondetail['material_id']       = $item->id;
            $reversiondetail['proposed_amount']   = $item->qty;
            $reversiondetail['real_amount']       = $item->options['proposed_amount'];

            $reversiondetails->create($reversiondetail);

            // $material = $this->model->whereId($item->id)->first();

            // $update['amount'] = $material->amount - $item->qty;

            // $material->update($update);
            
         }     

        Cart::destroy();

        return redirect(urlBackend('pengajuan-pengembalian/index'))->withSuccess('data has been saved');
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

        // $material = $this->model->whereId($id)->first();

        $material = DB::table('utilization_details as a')
                ->join('materials as b','a.material_id','=','b.id')
                ->select(DB::raw('a.*, b.name,b.komag,b.description,b.year_acquisition,b.unit_price,b.type,b.category,b.unit,b.status'))
                ->where('a.id',$id)->first();
        // dd($material);
        Cart::add(array('id' => $id, 'name' => $material->name, 'qty' => $qty ,'price'=>$material->unit_price, 'options' => [
                            'category' => $material->category,
                            'komag' => $material->komag,
                            'description' => $material->description,
                            'unit' => $material->unit,
                            'proposed_amount'=>$material->proposed_amount,
                            'year_acquisition' => $material->year_acquisition,
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
