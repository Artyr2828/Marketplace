<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
           "user_id"=>31,
            "name"=>"Samsung Galaxy J7",
            "price"=>60000
        ]);

        DB::table('products')->insert([
               "user_id"=>31,
               "name"=>"Nvidia",
               "price"=>45000
          ]);
        DB::table('products')->insert([
                 "user_id"=>31,
                 "name"=>"headpones",
                 "price"=>10000
        ]);
       DB::table('products')->insert([
                 "user_id"=>31,
                 "name"=>"Joystick",
                 "price"=>12300
        ]);
    }
}
