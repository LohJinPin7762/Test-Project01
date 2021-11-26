<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //import database library
use App\Models\Category; //import category models
use Session;

class CategoryController extends Controller
{
    //
    public function add(){
        $r=request(); //received the data by GET or POST method $_POST['name']
        $addCategory=Category::create([
            'name'=>$r->categoryName,
        ]);
        Session::flash('success',"Category create successfully");
        Return redirect()->route('showCategory');
    }

    public function view(){
        $viewCategory=Category::all(); //generate SQL select * from categories
        Return view('showCategory')->with('categories',$viewCategory);
    }
}
