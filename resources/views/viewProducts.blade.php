@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <br><br>
            <h3>Products</h3>
            <div class="row">    
                @foreach($products as $product)
                <div class="col-sm-4">
                <div class="card" style="width: 19rem; height:98%;">
                <h5 class="card-title" style="text-align: center;margin-top: 7px;">{{$product->name}}</h5>
                    <img class="card-img-top img-fluid" src="{{asset('images/'.$product->image)}}" alt="Product Image" style='max-height: 250px;'>
                    <div class="card-body">
                        
                        <p class="card-text">{{$product->description}}</p>
                        <h5 class="card-text" style="text-align: center;">Price: RM {{$product->price}}</h5>
                        <a href="{{ route('product.detail', $product->id) }}" class="btn btn-primary" style="margin-left:105px">View</a>
                    </div>
                </div>
                </div>
                @endforeach
            </div>    
            <br><br>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
@endsection