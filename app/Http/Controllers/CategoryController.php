<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //database
use App\Models\Category;
use Session;
use Auth;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('addCategory');
    }

    
    public function add(){
        $r=request(); //receive data from GET / POST method  $_POST['name']
        $addCategory=Category::create([  //pre-define function in DB 
            'name'=>$r->categoryName,
        ]); 
        Session::flash('success',"Category create successfully!");
        Return redirect()->route('showCategory'); 
    }

    public function view(){
        $viewCategory = Category::all(); //auto generate SQL select*from categories
        Return view('showCategory')->with('categories',$viewCategory);
        //categories use for @foreach in blade.php
    }
}