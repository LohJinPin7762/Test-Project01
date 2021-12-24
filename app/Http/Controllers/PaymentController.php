<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Session;
use Auth;
use DB;
use App\Models\myCart;
use App\Models\myOrder;


class PaymentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    } //login first
    


    public function paymentPost(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount"=>$request->sub*100,
            //'sub' get from id="sub" in myCart.blade.php
            //sub value 1=100, to get actual value, must *100
            "currency"=>"MYR",
            "source"=>$request->stripeToken,
            "description"=>"This payment is testing purpose of southern online",
        ]);

        //create new order in myOrder with logged in userID
        $newOrder=myOrder::Create([
            'paymentStatus'=>'Done',
            'userID'=>Auth::id(),
            'amount'=>$request->sub,
        ]);

        // sort by desc and get the first OrderID. (cannot directly get from above because it is for creating only)
        $orderID=DB::table('my_orders')->where('userID','=',Auth::id())->orderBy('created_at','desc')->first();

        //once item choosen and post, find item in myCart and delete
        $items=$request->input('cid');
        //update the orderID into every item that paid
        foreach($items as $item=>$value){
            $cart=myCart::find($value); //get cart item record
            $cart->orderID=$orderID->id; //update/bind orderID to cart item record
            $cart->save();

        }
        Session::flash('success','Order successfully!');
        return redirect()->route('my.order');
    }

    public function viewOrder(){
        $viewOrder=DB::table('my_orders') //select everything from table
        ->leftjoin('my_carts','my_carts.id','=','my_carts.orderID') 
        ->select('my_orders.*')
        // ->where('userID','=',Auth::id())
        // ->where('orderID',"IS NOT NULL")
        ->get();

        return view('myOrder')->with('orders',$viewOrder);
    }

}