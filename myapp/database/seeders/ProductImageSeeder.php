<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('img_path')->insert(
       [
          'product_id'=>1,
           'path'=>'public/images/device/samsung-galaxy-j7.png'
       ]
      );
    }
}
