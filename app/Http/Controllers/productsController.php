<?php

namespace App\Http\Controllers;

use App\products;
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
        $product =  products::select('name')->get();

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
        $product = new products();
        $product->sku=$request->sku;
        $product->name= $request->name;
        $product->description = $request->description;
        $product ->unit_price = $request->unit_price;
        $product ->category_id = $request->category_id;
        $product->save();

        return response()->json(
            [
                'messages' => "success"
            ], 200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getByID($id)
    {
        $products =  products::find($id);
        return response()->json(
            [
                'message' => 'success',
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
        $product = products::find($id);
        $product->sku=$request->sku;
        $product->name= $request->name;
        $product->description = $request->description;
        $product ->unit_price = $request->unit_price;
        $product ->category_id = $request->category_id;
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
        products::find($id)->delete();

            return response()->json([
                'messages' => "success"
                ],200
            );
    }
}
