@extends('layouts.app')

@section('content')
    <form>
        {{ csrf_field() }}
        <table class="edit">
            <tr>
                <td><label>ID</label></td>
                <td><label id="product_id"></label></td>
            </tr>
            <tr>
                <td><label>SKU</label></td>
                <td><input name="sku" type="text" id="product_sku" value=""></td>
            </tr>
            <tr>
                <td><label>Product Name</label></td>
                <td><input type="text" name="name" id="product_name" value=""></td>
            </tr>
            <tr>
                <td><label>Category Name</label></td>
                    <td><select name="category" id="category_name">
                            <option value="1">Category 1</option>
                            <option value="2">Category 2</option>
                            <option value="3">Category 3</option>
                            <option value="4">Category 4</option>
                            <option value="5">Category 5</option>
                            <option value="6">Category 6</option>
                            <option value="7">Category 7</option>
                            <option value="8">Category 8</option>
                            <option value="9">Category 9</option>
                            <option value="10">Category 10</option>
                    </select></td>
            </tr>
            <tr>
                <td><label>Description</label></td>
                <td><textarea name="description" id="product_desc" value=""></textarea></td>
            </tr>
            <tr>
                <td><label>Unit Price</label></td>
                <td><input name="price" type="text" id="product_price" value=""></td>
            </tr>
        </table>
    </form>
@endsection

@section('script')
   <script>
       $(document).ready(function(){
            $.ajax({
                url: '/api/Product/GetByID/{{$id}}/',
                type: 'GET',
                success:
                    function(json){
                        var product = json.data;
                        $('#product_id').append(product.id);
                        $('#product_sku').val(product.sku);
                        $('#product_name').val(product.name);
                        $('#category_name').val(product.category_id);
                        $('#product_desc').val(product.description);
                        $('#product_price').val(product.unit_price);
                    }
            });

            $.ajax({
               url: '/api/Product/Update/{{$id}}/',
               type: 'PUT',
               success:
                    function () {

                    }
            });
       });
   </script>
@endsection
