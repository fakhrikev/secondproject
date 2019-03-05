<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class productSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 0; $i < 20; $i++){
        DB::table('products')->insert([
            'sku' => str_random(10),
            'name' => $faker->word,
            'description' => $faker->sentence,
            'category_id' => rand(1, 20),
            'unit_price' => $faker->numberBetween(5000, 10000),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
