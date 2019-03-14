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
        $image = products_image::where('product_id', $id)->get();

        foreach ($image as $i){
            $str = $i->product_image_url;
            if(!str_contains($str, "lorem")){
                $newstr = "/productImages/".$str;
                $i->product_image_url = $newstr;
            }
        }

        return response()->json([
            'data' => $image,
            'message' => 'success'
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function Store(Request $request, $product_id)
    {
        if($request->hasFile('main_image'))
        {
            $image = $request->file('main_image');
            $main_image_name = time() . '-' . $image->getClientOriginalName();
            $imagePath = 'productImages/';
            $image->move($imagePath,$main_image_name);

            $prod_image = new products_image();
            $prod_image->product_id = $product_id;
            $prod_image->product_image_url = $main_image_name;
            $prod_image->main_image = true;
            $prod_image->save();
        }

        if($request->hasFile('product_images'))
        {
            foreach ($request->file('product_images') as $image)
            {
                $other_images = time() . '-' . $image->getClientOriginalName();
                $imagePath = 'productImages/';
                $image->move($imagePath, $other_images);

                $image = new products_image();
                $image->product_id = $product_id;
                $image->product_image_url = $other_images;
                $image->main_image = false;
                $image->save();
            }
        }

        return response()->json([
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
        $image = products_image::find($id);

        if($image->exists()){
            $image->delete();
            $data = "Image(s) has been deleted";
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
