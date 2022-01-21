<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\Category;
use Session;
use Auth;

class ProductController extends Controller
{
   
    public function viewProduct(){

        if(Auth::id()!=1){
            Session::flash('success',"Admin only allow to access this page!");
            return redirect(route('products'));
        }
        $products=Product::all();

        (new CartController)->cartItem(); //declared namespace, auto find in controllers folder
        // App('App\Http\Controllers\CartController')->cartItem();
        return view('viewProducts')->with('products',$products);
    }

    public function productdetail($id){
        $products=Product::all()->where('id',$id);

        (new CartController)->cartItem();
        return view('productDetail')->with('products',$products);
    }

    public function searchProduct(){
        $r=request();
        $keyword=$r->keyword;
        $products=DB::table('products')
        ->where('name','like','%'.$keyword.'%')
        ->get();

        return view('viewProducts')->with('products',$products);
    }

    public function viewPhone(){
        $products=DB::table('products')
        ->where('CategoryID','=','1')
        ->get();

        return view('viewProducts')->with('products', $products);
    }

    public function viewComputer(){
        $products=DB::table('products')
        ->where('CategoryID','=','2')
        ->orWhere('CategoryID','=','3')
        ->get();

        return view('viewProducts')->with('products', $products);
    }
}