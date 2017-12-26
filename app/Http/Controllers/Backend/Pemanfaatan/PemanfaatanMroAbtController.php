<?php namespace App\Http\Controllers\Backend\Pemanfaatan;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use Table;
use Image;
use trinata;
use Cart;


class PemanfaatanMroAbtController extends TrinataController
{
  
    public function __construct(Crud $model)
    {
        parent::__construct();
        $this->model = $model;

        $this->resource = "backend.pemanfaatan.mro-abt.";
    }

    public function getData()
    {
        $model = $this->model->select('id','title','status');
        $cart = Cart::content();
        $keys = [];
        foreach ($cart as $key => $value) {
                $keys[$key]=$value->id;
                $qty[$value->id]=$value->qty;
        }
        // dd($keys,$qty);
        $data = Table::of($model)
            ->addColumn('title',function($model) use($keys){

                if(in_array($model->id, $keys)){
                    $checkbox = 'checked="checked"';
                }else{
                    $checkbox = '';

                }
                $title = '<input name="title" type="checkbox" class="checklist" data-id="'.$model->id.'" '.$checkbox.'> '.$model->title;


                return $title;

            })
            ->addColumn('action',function($model)use($keys,$qty){

                // $cartQty = Cart::content()->where('id',$model->id)->first();
                if(in_array($model->id, $keys)){
                    $readonly = 'readonly="readonly"';
                    $qty = $qty[$model->id];
                    // dd();
                }else{
                    $readonly = '';
                    $qty = 0;
                }

                $status = '<input class="form-control" name="title" type="text" id="amount'.$model->id.'" value="'.$model->id.'" readonly="readonly"> <input name="title"  class="form-control"  type="text" value="'.$qty.'" id="amounts'.$model->id.'" '.$readonly.'> ';
                return $status;
            })
            ->make(true);

        return $data;
    }
    public function getCartcontent($id){
        $cart = Cart::content()->where('id',$id)->first();

        dd($cart,$id);

        return $cart;
    }
    public function getDatas()
    {
        
        $cart = Cart::content();
        dd($cart);
    }

    public function getIndex()
    {
        return view($this->resource.'index');
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
    public function getAddcart($id,$qty=0)
    {        

        Cart::add(array('id' => $id, 'name' => $id, 'qty' => $qty ,'price'=>0, 'options' => [
                            'gambar' => $id,
                            ]));

        $cart = Cart::content();
        $jumlah = count($cart);
        // dd($cart);

        return response()->json(['response' => 'This is get method','data' =>$jumlah,'status'=>true]);
        // return view('frontend.inventaris.cart', compact('cart'));
    }
}
