@extends('layouts.app')

@section('content')
        <div>
            <table id="product">
                <thead>
                <td>Image</td>
                <td>Product Name</td>
                <td>Edit</td>
                <td>Delete</td>
                </thead>
                <tbody></tbody>
            </table>
        </div>
@endsection

@section('script')
    <script>
        function deleteProduct($id){
            var r = window.confirm("Are you sure want to delete the product?");
            if(r == true) {
                $.ajax({
                    url: '/api/Product/Delete/'+$id+'',
                    type: 'DELETE',
                    success: function () {
                        window.location.reload();
                    }
                });
            }
            else if(r == false){
                return null;
            }
        }

        function editProduct($id){
            window.location.href = '{{url("Product/Edit/")}}/'+$id;
        }

        $(document).ready(function() {
            $.ajax({
               url: '/api/Product/GetAll',
               type: 'GET',
               success: function (json) {
                   $.each(json.data, function (i, product) {
                      $('#product > tbody').append('<tr><td>'
                                                + '<img height="100px" width="100px" src = "'+ product.main_image+'">'
                                                + '</td><td>'
                                                + '<a href="{{url("Product/Detail/")}}/'+product.id+'">'+product.name+'</a>'
                                                + '</td><td>'
                                                + '<input type="button" value="Edit" onclick="editProduct('+product.id+')">'
                                                + '</td><td>'
                                                + '<input type="button" value="Delete" onclick="deleteProduct('+product.id+')">'
                                                + '</td></tr>');
                    })
                }
            })
        });
    </script>

@endsection


