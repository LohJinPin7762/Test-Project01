@extends('layout')
@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <br><br>
        <h3>Create New Product</h3>
        <form action="{{ route('addProduct') }}" method="POST" enctype="multipart/form-data" >
           @CSRF
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName">                
            </div>
            <div class="form-group">
                <label for="productDescription">Product Desciption</label>
                <input type="text" class="form-control" id="productDescription" name="productDescription">                
            </div>
            <div class="form-group">
                <label for="productPrice">Product Price</label>
                <input type="number" class="form-control" id="productPrice" name="productPrice" min="0">                
            </div>
            <div class="form-group">
                <label for="productPrice">Product Quantity</label>
                <input type="number" class="form-control" id="productQuantity" name="productQuantity" min="0">                
            </div>

            <div class="form-group">
                <label for="productDescription">Product Image</label>
                <input type="file" class="form-control" id="productImage" name="productImage">                
            </div>
            <div class="form-group">
                <label for="catID">Category</label>
                <input type="text" class="form-control" id="CategoryID" name="CategoryID">                
            </div>
            <button type="submit" class="btn btn-primary">Add New</button>
        </form>
        <br><br>
    </div>
    <div class="col-sm-3"></div>
</div>
@endsection