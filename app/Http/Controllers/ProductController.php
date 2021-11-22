<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function add(){ //step2
        $r=request();//received the data by GET or POST mothod
        $images=$r->file('productImage');
        $image->move('image',$image->getClienOriginalName());
        //image is the location
        $imagesName=$images->getClienoriginalName();
        $addProduct=Product::create([
            'name'=>$r->ProductName,
            'description'=>$r->productDescription,
            'quantity'=>$r->productQuantity,
            'price'=>$r->productPrice,
            'Categroy'=>$r->CategoryID,
            'images'=>$imageName,
        ]);
        Return redirect()->route('showProduct');
    }

    public function view(){
        $viewProduct=Product::all();
        Return view('showProduct')->with('product',$viewProduct);
    }
}
