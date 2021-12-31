<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\Category;
use Session;

class ProductController extends Controller
{
    public function add(){
        $r=request(); //receive data from GET / POST method  $_POST['name']
        
        //upload image before add to DB
        $image=$r->file('productImage');
        $image->move('images',$image->getClientOriginalName());
        $imageName=$image->getClientOriginalName();

        $addProduct=Product::create([ //pre-define function in DB
            'name'=>$r->productName,
            'description'=>$r->productDescription,
            'price'=>$r->productPrice,
            'quantity'=>$r->productQuantity,
            'CategoryID'=>$r->CategoryID,
            'image'=>$imageName, //save the image name only.
            //image different
        ]);  
        Session::flash('success',"Product create successfully!");
        return redirect()->route('showProduct'); 
    }

    public function view(){
        //$viewProduct=Product::all();

        $viewProduct=DB::table('products') //select everything from table
        ->leftjoin('categories','categories.id','=','products.CategoryID') 
        ->select('products.*','categories.name as categoryName')
        ->get();

        return view('showProduct')->with('products',$viewProduct);
    }

    public function delete($id){
        $deleteProduct=Product::find($id);
        $deleteProduct->delete();

        Session::flash('success',"Product was deleted successfully!");
        return redirect()->route('showProduct');
    }

    public function edit($id){
        $products=Product::all()->where('id',$id);
        return view('editProduct')
        ->with('products',$products)
        ->with('categoryID',Category::all());
    }

    public function update(){
        $r=request();
        $products = Product::find($r->productID);

        if($r->file('productImage')!=''){
            $image=$r->file('productImage');        
            $image->move('images',$image->getClientOriginalName());                   
            $imageName=$image->getClientOriginalName(); 
            $products->image=$imageName;
        } 

        $products->name=$r->productName;
        $products->description=$r->productDescription;
        $products->price=$r->productPrice;
        $products->quantity=$r->productQuantity;
        $products->CategoryID=$r->CategoryID;
        $products->save();

        return redirect()->route('showProduct');
    }

    public function viewProduct(){
        $products=Product::all();
        return view('viewProducts')->with('products',$products);
    }

    public function productdetail($id){
        $products=Product::all()->where('id',$id);

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
}