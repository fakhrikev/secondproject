<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(product_categorySeeders::class);
         $this->call(productSeeders::class);
         $this->call(product_imageSeeders::class);
    }
}
