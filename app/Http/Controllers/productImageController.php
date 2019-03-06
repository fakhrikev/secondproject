<?php

namespace App\Http\Controllers;

use App\products_image;
use Illuminate\Http\Request;

class productImageController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function GetWithParam($id)
    {
        $product = products_image::where('product_id', $id)->get();
        return response()->json([
            'data' => $product,
            'message' => 'success'
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
        $prod_image = new products_image();
        $prod_image->product_id = $request->product_id;
        $prod_image->product_image_url = $request->product_image_url;
        $prod_image->save();

        return response()->json([
           'data' => $prod_image,
            'message' => 'success'
        ], 200);
    }

    public  function  SetMainImage(Request $request, $id){
        $image = products_image::find($id);
        $image->main_image = $request->main_image;
        $image->save();

        $otherImages = products_image::where('product_id', $image->product_id)->where('id', '!=', $image->product_id)->get();
        foreach($otherImages as $other){
            $other->main_image = false;
            $other->save();
        }

        return response()->json([
            'messages' => "success"
        ],200
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
        products_image::find($id)->delete();

        return response()->json([
            'messages' => "success"
        ],200
        );
    }
}
