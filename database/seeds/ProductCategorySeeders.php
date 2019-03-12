<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductCategorySeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('ProductsCategories')->insert([
                'category_name' => $faker->word,
                'visible' => rand()%2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
