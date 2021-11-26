@extends('layout')
@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <br><br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Image</td>
                        <td>Product Name</td>
                        <td>Desciption</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Category</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->image}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->CategoryID}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        <br><br>
    </div>
    <div class="col-sm-3"></div>
</div>
@endsection