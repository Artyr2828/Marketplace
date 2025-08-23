<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductsTableSeeder;
use Database\Seeders\ImgPathSeeder;
use Database\Seeders\ProductImageSeeder;
use Database\Seeders\DescSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
     //   $this->call(ProductsTableSeeder::class);
       // $this->call(ImgPathSeeder::class);
        $this->call(DescSeeder::class);
    }
}
