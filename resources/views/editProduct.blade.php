@extends('layouts.app')

@section('content')
    <form>
        <tr>
            <td>ID</td>
            <td id="product"></td>
        </tr>
        <tr>
            <td>SKU</td>
            <td><input type="text" id="product"></td>
        </tr>
        <tr>
            <td>Product Name</td>
            <td><input type="text" id="product"></td>
        </tr>
        <tr>
            <td>Category Name</td>
            <td><input type="text" id="product"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input type="text" id="product"></td>
        </tr>
        <tr>
            <td>Unit Price</td>
            <td><input type="text" id="product"></td>
        </tr>
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
                        $('#product').append(
                            product.id
                            + '<td>'      + product.sku
                            + '</td><td>' + product.name
                            + '</td><td>' + product.category_name
                            + '</td><td>' + product.description
                            + '</td><td>' + product.unit_price
                            + '</td>'
                        );
                    }
            });
       });
   </script>
@endsection
