@extends('layout')
@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <br><br>
        <h3>Create New Category</h3>
        <form action="">
            <div class="form-group">
                <lable for="categoryname">Category Name></lable>
                <input type="text" class="form-control" id="categoryName" name="categoryName">
            </div>
            <button type="submit" class="btn btn-primary">Add New</button>
        </form>
        <br><br>
    </div>
    <div class="col-sm-3"></div>
</div>
@endsection