@extends('layouts.app')

@section('content')

    <div class="panel-heading">Add Product</div>

    <div>
        <form class="table">
            {{ csrf_field() }}
            <table class="tab-content">
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
                    <td><label>Main Image</label></td>
                    <td><input name="main_image" type="file" id="main_image"></td>
                </tr>
                <tr>
                    <td><label>Other Images</label></td>
                    <td><input name="product_images" multiple type="file" id="product_images"></td>
                </tr>
                <tr>
                    <td><input name="submitbtn" type="submit"></td>
                </tr>
            </table>
        </form>
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

                else if(this.main_image.value == "") {
                    alert("Please enter a main image");
                    this.main_image.focus();
                }

                else if(this.product_images.value == "") {
                    alert("Please enter other images");
                    this.product_images.focus();
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
            images.append( 'main_image', $('#main_image')[0].files[0]);

            $.each($('#product_images')[0].files, function (i, image) {
                images.append('product_images[]', $('#product_images')[0].files[i]);
            });

            $.ajax({
                url: '/api/Product/Store/',
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
    </script>
@endsection
