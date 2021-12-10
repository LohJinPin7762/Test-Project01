<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class myCart extends Model
{
    use HasFactory;
    protected $fillable=['productID','quantity','userID','orderID'];

    public function product(){
        return $this->belongTo('App\product');
    }

    public function user(){
        return $this->belongTo('App\User');
    }
}
