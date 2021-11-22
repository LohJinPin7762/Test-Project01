<div class="col-sm-6">
    <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Product name</td>
                    <td>Desciption</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Category</td>
                    <td>Action</td>
                </tr>
            </thead>
            </tbody>
                @foreach($categories as category)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->image}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->Description}}</td>
                    <td>{{$product->Price}}</td>
                    <td>{{$product->Quantity}}</td>
                    <td>{{$product->Category}}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>