<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class product_categorySeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('products_categories')->insert([
                'category_name' => $faker->name,
                'visible' => rand()%2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
