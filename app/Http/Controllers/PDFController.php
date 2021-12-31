<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use App\Models\myOrder;
use Auth;

class PDFController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function pdfReport()
    {
        $orders=DB::table('my_orders')
        ->select('my_orders.id','my_orders.amount','my_orders.paymentStatus')
        ->where('my_orders.userID','=',Auth::id())
        ->get();

        $pdf = PDF::loadView('myPDF', compact('orders'));
        return $pdf->download('OrderReport.pdf');

    }
}