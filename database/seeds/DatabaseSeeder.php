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
        // Mencionar todas las clases de seeder
        $this->call(UserSeed::class);
        $this->call(CategorySeed::class);
        $this->call(ProductSeed::class);
    }
}
