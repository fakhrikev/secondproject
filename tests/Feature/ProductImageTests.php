<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductImageTests extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testGetWithParam(){
        $response = $this->get('/api/ProductImage/GetWithParam/11/');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' =>
            [
                'id',
                'product_id',
                'product_image_url',
                'main_image',
                'created_at',
                'updated_at',
                'deleted_at'
            ]
        ]);

    }

    public function testStore(){
        $response = $this->json('POST', '/api/ProductImage/Store', [
            'product_id' => '11',
            'product_image_url' => 'www.facebook.com',
            'main_image' => 'true',
        ]);

        $response->assertStatus(200)->assertJson(['messages' => 'success']);
    }


    public function testUpdate(){
        //$this->withoutEvents();
        $response = $this->json('PUT', '/api/ProductImage/Update/21/', [
            'main_image' => 'false',

        ])->assertStatus(200)->assertJsonCount(1);

    }

    public function testDelete(){
        $response = $this->json('DELETE','/api/ProductImage/Delete/21/', ['messages' => 'success'])->assertStatus(200);
    }
}
