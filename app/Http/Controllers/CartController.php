<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Models\myCart;
use App\Models\Product;


class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function add(){
        $r=request();

        $addCart=myCart::create([
            'productID'=>$r->productID,
            'quantity'=>$r->quantity,
            'userID'=>Auth::id(),
            'orderID'=>'',
        ]);
        Session::flash('success',"Product added into Cart!");
        return redirect()->route('show.my.cart');
    }

    public function showMyCart(){
        $carts=DB::table('my_carts')
        ->leftjoin('products','products.id','=','my_carts.productID')
        ->select('my_carts.quantity as cartQTY','my_carts.id as cid','products.*')
        ->where('my_carts.orderID','=','') //if '' means no payment made
        ->where('my_carts.userID','=',Auth::id())
        //->get();
        ->paginate(5); //five item in one page only

        $noItem=DB::table('my_carts')
        ->leftjoin('products','products.id','=','my_carts.productID')
        ->select(DB::raw('COUNT(*) as count_item'))
        ->where('my_carts.orderID','=','') //if '' means no payment made
        ->where('my_carts.userID','=',Auth::id())
        ->groupBy('my_carts.userID')
        ->get();

        return view('myCart')->with('carts',$carts)->with('noItem',$noItem);
    }

    public function delete($id){
        $delete=myCart::find($id);
        $delete->delete();

        Session::flash('success',"Product was deleted successfully!");
        return redirect()->route('show.my.cart');
    }
}