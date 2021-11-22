<div class="col-sm-6">
    <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Category name</td>
                    <td>Action</td>
                </tr>
            </thead>
            </tbody>
                @foreach($categories as category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>