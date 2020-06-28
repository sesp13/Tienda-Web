<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nit' => '001',
            'name' => 'Admin',
            'surname' => "Admin",
            'role' => "ROLE_ADMIN",
            'email' => "admin@admin.com",
            'password' => Hash::make("123456789"),
            'confirmed' => true,
            'active' => true
        ]);

        DB::table('users')->insert([
            'nit' => '002',
            'name' => 'Simon',
            'surname' => "Cano",
            'email' => "simon@gmail.com",
            'password' => Hash::make("123456789"),
            'confirmed' => true,
            'active' => true
        ]);

        DB::table('users')->insert([
            'nit' => '003',
            'name' => 'Alonso',
            'surname' => "Cardona",
            'email' => "alonso@gmail.com",
            'password' => Hash::make("alonso123456"),
            'confirmed' => true,
            'active' => true
        ]);

        DB::table('users')->insert([
            'nit' => '004',
            'name' => 'Carlos',
            'surname' => "Arboleda",
            'email' => "carlos@gmail.com",
            'password' => Hash::make("carlos123456"),
            'confirmed' => true,
            'active' => false
        ]);

        DB::table('users')->insert([
            'nit' => '005',
            'name' => 'Juana',
            'surname' => "Arroyave",
            'email' => "juana@gmail.com",
            'password' => Hash::make("juana123456"),
            'confirmed' => true,
            'active' => false
        ]);

        DB::table('users')->insert([
            'nit' => '006',
            'name' => 'Camilo',
            'surname' => "Cortés",
            'email' => "camilo@gmail.com",
            'password' => Hash::make("camilo123456"),
            'confirmed' => false,
            'active' => false,
            'email_token' => "123456789"
        ]);

        DB::table('users')->insert([
            'nit' => '007',
            'name' => 'Valentina',
            'surname' => "Cano",
            'email' => "valentina@gmail.com",
            'password' => Hash::make("valentina123456"),
            'confirmed' => false,
            'active' => false,
            'email_token' => "01020304050607080910"
        ]);
    }
}
