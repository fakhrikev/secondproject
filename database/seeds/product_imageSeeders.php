<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class product_imageSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 0; $i < 20; $i++) {
            for ($j = 0; $j < 4; $j++){
                DB::table('products_images')->insert([
                    'product_id' => rand(1, 20),
                    'product_image_url' => $faker->imageUrl(),
                    'main_image' => false,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
        }
    }
}
