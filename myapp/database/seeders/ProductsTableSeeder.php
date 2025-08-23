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
            "name"=>"Samsung Galaxy J7",
            "price"=>60000
        ]);

        DB::table('products')->insert([
               "name"=>"Nvidia",
               "price"=>45000
          ]);
        DB::table('products')->insert([
                 "name"=>"headpones",
                 "price"=>10000
        ]);
       DB::table('products')->insert([
                 "name"=>"Joystick",
                 "price"=>12300
        ]);
    }
}
