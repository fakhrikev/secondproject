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

        for($i = 0; $i < 50; $i++) {
            for ($j = 0; $j < 3; $j++){
                $isMain = $j == 0? true : false;
                DB::table('products_images')->insert([
                    'product_id' => $i+1,
                    'product_image_url' => $faker->imageUrl(),
                    'main_image' => $isMain,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
        }
    }
}
