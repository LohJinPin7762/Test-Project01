<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;//import Database Library //step1
use app\Model\Category;//import category model

class CategoryController extends Controller
{
    public function add(){ //step2
        $r=request();//received the data by GET or POST mothod $_POST['name']
        $addCategroy=Category::create([
            'name'=>$r->categoryName,
        ]);
        Return view('addCategory');
    }
}
