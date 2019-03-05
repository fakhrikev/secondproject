<?php

namespace Tests\Feature;

use http\Message;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAll()
    {
        $response = $this->get('/api/Product/GetAll/');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' =>
                [
                    '*' =>[
                        'name'
                        ]
                    ],
        ]);

    }

    public function testGetByID(){
            $response = $this->get('/api/Product/GetByID/11/');

            $response->assertStatus(200);
            $response->assertJsonStructure(['data' =>
                [
                    'id',
                    'sku',
                    'name',
                    'description',
                    'unit_price',
                    'category_id',
                    'created_at',
                    'updated_at',
                    'deleted_at'
                ]
            ]);

    }

    public function testStore(){
        $response = $this->json('POST', '/api/Product/Store', [
            'sku' => 'BOO123',
            'name' => 'Seto',
            'description' => 'Seto Mulyadi',
            'unit_price' => '500',
            'category_id' => '2',
        ]);

        $response->assertStatus(200)->assertJson(['messages' => 'success']);
    }


    public function testUpdate(){
        //$this->withoutEvents();
        $response = $this->json('PUT', '/api/Product/Update/21/', [
            'sku' => 'BOO345',
            'name' => 'Alphard',
            'description' => 'Toyota Alphard',
            'unit_price' => '100',
            'category_id' => '1',
        ])->assertStatus(200)->assertJsonCount(1);

    }

    public function testDelete(){
        $response = $this->json('DELETE','/api/Product/Delete/21/', ['messages' => 'success'])->assertStatus(200);
    }
}
