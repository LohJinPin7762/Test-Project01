@extends('layout')
@section('content')
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr style="text-align: center; font-weight: bold;">
                    <!-- <td>ID</td> -->
                    <td>Image</td>
                    <td>Product Name</td>
                    <td style="width:250px">Description</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Category</td>
                    <td>Action</td>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                <tr style="text-align: center;">
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <td><img src="{{ asset('images/'.$product->image) }}" alt="product image" title="product image" width="100" class="img-fluid"></td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->categoryName}}</td>
                    <td><a href="{{ route('editProduct',['id'=>$product->id]) }}" class="btn btn-warning btn-sm" style="margin-bottom:5px;">Edit</a> <br> 
                        <a href="{{ route('deleteProduct',['id'=>$product->id]) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure to delete this?')">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>
    </div>
    <div class="col-sm-2"></div>
</div>
@endsection