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
         $this->call(ProductCategorySeeders::class);
         $this->call(ProductSeeders::class);
         $this->call(ProductImageSeeders::class);
    }
}
