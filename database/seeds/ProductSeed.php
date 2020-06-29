<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas

        DB::table('products')->insert([
            'name' => 'Nintendo Switch',
            'category_id' => 1,
            'stock' => 50,
            'price' => 900000
        ]);

        DB::table('products')->insert([
            'name' => 'Super Mario Bros U',
            'category_id' => 1,
            'stock' => 25,
            'price' => 125000,
        ]);

        DB::table('products')->insert([
            'name' => 'The legend of zelda',
            'category_id' => 1,
            'stock' => 75,
            'price' => 75000,
        ]);

        DB::table('products')->insert([
            'name' => 'The last of us',
            'category_id' => 2,
            'stock' => 10,
            'price' => 100000,
        ]);

        DB::table('products')->insert([
            'name' => 'God of war',
            'category_id' => 2,
            'stock' => 40,
            'price' => 180000,
        ]);

        DB::table('products')->insert([
            'name' => 'Play station 4',
            'category_id' => 2,
            'stock' => 3,
            'price' => 1200000,
        ]);

        DB::table('products')->insert([
            'name' => 'Halo',
            'category_id' => 3,
            'stock' => 85,
            'price' => 140000,
        ]);

        DB::table('products')->insert([
            'name' => 'Gears of war',
            'category_id' => 3,
            'stock' => 23,
            'price' => 50000,
        ]);

        DB::table('products')->insert([
            'name' => 'Xbox 360',
            'category_id' => 3,
            'stock' => 1,
            'price' => 400000,
        ]);

        DB::table('products')->insert([
            'name' => 'MSI GAMING',
            'category_id' => 3,
            'stock' => 0,
            'price' => 4500000,
        ]);

        DB::table('products')->insert([
            'name' => 'GTA V',
            'category_id' => 3,
            'stock' => 200,
            'price' => 75000,
        ]);

        DB::table('products')->insert([
            'name' => 'Mouse Gamer',
            'category_id' => 3,
            'stock' => 10,
            'price' => 40000,
        ]);
    }
}
