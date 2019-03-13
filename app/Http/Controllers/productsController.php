<?php

namespace App\Http\Controllers;

use App\Products;
use App\ProductsCategory;
use App\ProductsImage;
use Illuminate\Http\Request;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function GetAll()
    {
        $product = Products::select('id', 'name')->get();
        $image = ProductsImage::where('main_image', true)->get();

        foreach ($product as $p){
            $p->setAttribute('main_image', $image->where('product_id', $p->id)->first()->product_image_url);
        }

        return response()->json([
            'messages' => 'success',
            'data' => $product
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function Store(Request $request)
    {
        $product = new Products();
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->category_id = $request->category_id;
        $product->save();

        $response = $product->id;

        return response()->json(
            [
                'messages' => "success",
                'data' => $response
            ], 200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function GetByID($id)
    {
        $products = Products::find($id);
        $category = ProductsCategory::find($products->category_id);
        $image = ProductsImage::find($products->id);

        $products->setAttribute('image_url', $image->product_image_url);
        $products->setAttribute('category_name', $category->category_name);

        return response()->json(
            [
                'messages' => 'success',
                'data'=> $products
            ], 200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function Update(Request $request, $id)
    {
        $product = Products::find($id);
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->category_id = $request->category_id;
        $product->save();

        return response()->json(
            [
                'messages' => "success"
            ], 200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function Delete($id)
    {
        Products::find($id)->delete();

            return response()->json([
                'messages' => "success"
                ],200
            );
    }
}
