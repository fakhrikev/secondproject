<?php

namespace App\Http\Controllers;

use App\ProductsImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getWithParam($id)
    {
        $product = ProductsImage::where('product_id', $id)->get();
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

    public function store(Request $request, $product_id)
    {
        if($request->hasFile('main_image'))
        {
            $image = $request->file('main_image');
            $main_image_name = time() . '-' . $image->getClientOriginalName();
            $imagePath = 'productImages/';
            $image->move($imagePath,$main_image_name);

            $prod_image = new ProductsImage();
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

                $image = new ProductsImage();
                $image->product_id = $product_id;
                $image->product_image_url = $other_images;
                $image->main_image = false;
                $image->save();
            }
        }

        return response()->json([
           'data' => $prod_image,
            'message' => 'success'
        ], 200);
    }

    public  function  setMainImage(Request $request, $id){
        $image = ProductsImage::find($id);
        $image->main_image = $request->main_image;
        $image->save();

        $otherImages = ProductsImage::where('product_id', $image->product_id)->where('id', '!=', $image->product_id)->get();
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
    public function delete($id)
    {
        ProductsImage::find($id)->delete();

        return response()->json([
            'messages' => "success"
        ],200
        );
    }
}
