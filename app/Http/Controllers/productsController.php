<?php

namespace App\Http\Controllers;

use App\products;
use App\products_category;
use App\products_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function GetAll()
    {
        $product =  products::select('id', 'name')->get();
        $image = products_image::where('main_image', true)->get();

        foreach ($image as $i){
            $str = $i->product_image_url;
            if(!str_contains($str, "lorem")){
                $newstr = "/productImages/".$str;
                $i->product_image_url = $newstr;
            }
        }

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
        $validator = Validator::make($request->all(),
            [
                'sku' => 'required|max: 10',
                'name' => 'required|max: 20',
                'description' => 'required|max: 1000',
                'unit_price' => 'required|numeric',
                'category_id' => 'required|integer'
            ]
        );

        if($validator->fails()){
            return redirect('product/create')->withErrors($validator)
                ->withInput(Input::all());
        }

        $product = new products();
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
        $products =  products::find($id);
        $category = products_category::find($products->category_id);
        $image = products_image::find($products->id);

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
        $validator = Validator::make($request->all(),
            [
                'sku' => 'required | max: 10',
                'name' => 'required | max: 20',
                'description' => 'required | max: 1000',
                'unit_price' => 'required | numeric',
                'category_id' => 'required | integer'
            ]
        );

        if($validator->fails()){
            return redirect('product/create')->withErrors($validator)
                ->withInput(Input::all());
        }

        $product = products::find($id);
        $product->sku=$request->sku;
        $product->name= $request->name;
        $product->description = $request->description;
        $product ->unit_price = $request->unit_price;
        $product ->category_id = $request->category_id;
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function Delete($id)
    {
        $product = products::find($id);

        if($product->exists()){
            $product->delete();
            $data = "Product has been deleted";
        }

        else{
            $data = "Product is not exists";
        }

        return response()->json([
                'messages' => "success",
                'data' => $data,
                ],200
            );
    }
}
