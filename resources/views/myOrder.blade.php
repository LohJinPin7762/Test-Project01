@extends('layout')
@section('content')
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <br><br>
        <h3>My Order</h3>
        <table class="table table-bordered">
            <thead>
                <tr style="text-align: center; font-weight: bold;">
                    <!-- <td>ID</td> -->
                    <td>Order ID</td>
                    <td>Paid Date time</td>
                    <td>Amount Paid</td>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr style="text-align: center;">
                    <td>{{$order->id}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>RM {{$order->amount}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>
    </div>
    <div class="col-sm-2"></div>
</div>

@endsection