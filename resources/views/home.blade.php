@extends('layouts.app')

@section('content')
        <div>
            <table>
                <thead>
                    Product Name
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
                                                    + '<a href="{{url("Product/Detail/")}}/'+product.id+'">'+product.name+'</a>'
                                                + '</td>'
                                        + '</tr>');
                    })
                }
            })
        });
    </script>

@endsection


