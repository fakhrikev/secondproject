@extends('layouts.app')

@section('content')
    <div>
        <table id="product_detail">
                <thead>
                    <td>ID</td>
                    <td>SKU</td>
                    <td>Product Name</td>
                    <td>Category Name</td>
                    <td>Description</td>
                    <td>Unit Price</td>
                </thead>
                <tbody>

                </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/Product/GetByID/{{$id}}',
                type: 'GET',
                success: function (json) {
                    console.log(json);
                    var product = json.data;
                        $('#product_detail > tbody').append('<tr><td>'+ product.id
                                                            + '</td><td>' + product.sku
                                                            + '</td><td>' + product.name
                                                            + '</td><td>' + product.category_name
                                                            + '</td><td>' + product.description
                                                            + '</td><td>' + product.unit_price
                                                            + '</td></tr>'
                        );

                }
            })
        });
    </script>

@endsection

