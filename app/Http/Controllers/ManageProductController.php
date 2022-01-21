<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\Category;
use Session;
use Auth;

class ManageProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('addProduct')->with('categoryID',Category::all());
    }
    
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
        if(Auth::id()!=1){
            Session::flash('success',"Admin only allow to access this page!");
            return redirect(route('products'));
        }
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

}