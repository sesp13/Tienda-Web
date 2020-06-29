<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
        
        DB::table('categories')->insert([
            'name' => 'Nintendo'
        ]);

        DB::table('categories')->insert([
            'name' => 'Playstation'
        ]);

        DB::table('categories')->insert([
            'name' => 'Xbox'
        ]);

        DB::table('categories')->insert([
            'name' => 'PC Gaming'
        ]);

    }
}
