<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Model\myCart;
use App\Model\Product;

class CartController extends Controller
{

    public function __contruct(){
        $this->middleware('auth');
    }

    public function add(){
        $r=request();
        $addCart=myCart::Create([
            'productID'=>$r->productID,
            'quantity'=>$r->quantity,
            'userID'=>Auth::id(),
            'orderID'=>'',
        ]);
        Return redirect()->route('showProduct');
    }

    public function showMyCart(){
        $carts=DB::table('my_carts')
        ->leftjoin('products','product.id','=','my_carts.productID')
        ->select('my_carts.quantity as cartQTY','my_carts.id as cid','products.*')
        ->where('my_carts.orderID','=','')//if '' means haven't make payment
        ->where('my_carts.userID','=',Auth::id())//item match with current login
        -get();

        return view('myCart')->with('carts',$carts);
    }
}
