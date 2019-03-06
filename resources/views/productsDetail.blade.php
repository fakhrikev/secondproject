@extends('layouts.app')

@section('content')
    <div>
        <table id="product_detail" border="1" cellpadding="12px">
                <thead>
                    <td>ID</td>
                    <td>SKU</td>
                    <td>Image</td>
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
                    var product = json.data;
                    $.ajax({
                        url: '/api/Product/GetWithParam',
                        type: 'GET',
                        success: function (images) {
                            $.each(images.data, function (i, image) {

                            });
                        }

                    });
                        $('#product_detail > tbody').append('<tr><td>'+ product.id
                                                            + '</td><td>' + product.sku
                                                            + '</td><td>' + '<img src = "'+ product.image_url+'">'
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

