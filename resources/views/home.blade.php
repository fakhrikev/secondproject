@extends('layouts.app')

@section('content')
        <div>
            <table border="1">
                <thead>
                <td>Image</td>
                <td>Product Name</td>
                </thead>
                <tbody id="product"></tbody>
            </table>
        </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajax({
               url: '/api/Product/GetAll',
               type: 'GET',
               success: function (json) {
                   console.log(json.data[2].id);
                   $.each(json.data, function (i, product) {
                      $('#product').append('<tr>'
                                                + '<td>'
                                                + '<img height="100px" width="100px" src = "'+ product.main_image+'">'
                                                + '</td>'
                                                + '<td>'
                                                + '<a href="{{url("Product/Detail/")}}/'+product.id+'">'+product.name+'</a>'
                                                + '</td>'
                                                + '</tr>');
                    })
                }
            })
        });
    </script>

@endsection


