@extends('layouts.app')

@section('content')
    <div class="edit-page">
        <div class="form">
            <div class="edit-product">
                    <div class="panel-heading">Edit Product</div>
                    <form class="table">
                        {{ csrf_field() }}
                        <table class="form-group">
                            <tr>
                                <td><label>SKU</label></td>
                                <td><input name="product_sku" type="text" id="product_sku" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Product Name</label></td>
                                <td><input type="text" name="product_name" id="product_name" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Category Name</label></td>
                                    <td><select name="category_name" id="category_name">
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
                                <td><textarea name="product_desc" id="product_desc" value=""></textarea></td>
                            </tr>
                            <tr>
                                <td><label>Unit Price</label></td>
                                <td><input name="product_price" type="number" id="product_price" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Add Image(s)</label></td>
                                <td><input name="product_images" multiple type="file" id="product_images"></td>
                            </tr>
                        </table>
                        <div class="image-edit">
                            <div class="images"></div>
                        </div>
                        <div class="button-edit">
                            <input type="submit" value="Submit">
                            <button id="setmain">Set Main Image</button>
                            <button id="delete">Delete Image(s)</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
   <script>
       $('form').submit(function (e) {
           e.preventDefault();
           if(this.product_sku.value == "") {
               alert("Please enter a valid SKU");
               this.product_sku.focus();
           }

           else if(this.product_name.value == "") {
               alert("Please enter product name");
               this.product_name.focus();
           }

           else if(this.category_name.value == "") {
               alert("Please select product category");
               this.category_name.focus();
           }

           else if(this.product_desc.value == "") {
               alert("Please enter a description");
               this.product_desc.focus();
           }

           else if(this.product_price.value == "") {
               alert("Please enter a valid price");
               this.product_price.focus();
           }

           else {
               alert("Success!  The form has been completed, validated and submitted...");
           }


           var data;
           data = new FormData();
           images = new FormData();
           data.append('sku', $('#product_sku').val());
           data.append('name', $('#product_name').val());
           data.append('category_id', $('#category_name').val());
           data.append('description', $('#product_desc').val());
           data.append('unit_price', $('#product_price').val());

           $.each($('#product_images')[0].files, function (i, image) {
               images.append('product_images[]', $('#product_images')[0].files[i]);
           });

           $.ajax({
               url: '/api/Product/Update/{{$id}}?_method=PUT',
               type: 'POST',
               data: data,
               contentType: false,
               processData: false,
               success: function(json) {
                   var product_id = json.data;
                   $.ajax({
                       url: '/api/ProductImage/Store/'+product_id+'/',
                       type: 'POST',
                       data: images,
                       contentType: false,
                       processData: false,
                       success: function() {
                           window.location.href = '{{url("/")}}';
                       }
                   });
               }
           });

       });

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
               url: '/api/ProductImage/GetWithParam/{{$id}}',
               type: 'GET',
               success: function (images) {
                   $.each(images.data, function (i, image) {
                       $('.images').append('<img id="blr'+[i]+'" class="image" height="100px" width="100px" src ="'+image.product_image_url+'">'
                                         + '<input type="checkbox" hidden id="imgCheck'+[i]+'" name="imgCheck'+[i]+'" value="product">');
                   });

                   $('.image').on('click', function(){
                       var $$ = $(this);
                       if( !$$.is('.checked')){
                           $$.addClass(' checked');
                           $('#imgCheck').prop('checked', true);
                       } else {
                           $$.removeClass('checked');
                           $('#imgCheck').prop('checked', false);
                       }
                   });
               }
           });
       });
   </script>
@endsection

