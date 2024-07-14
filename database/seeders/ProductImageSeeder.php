<?php

namespace Database\Seeders;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductImage::insert([
            [
             'image'=>"638472366121294617_samsung-galaxy-s23--fe-den-AI.webp",
             'product_id'=> 1,
            ],
            [
                'image'=>"638463753210935577_samsung-galaxy-s23-fe-den-2.webp",
                'product_id'=> 1,
               ],
               [
                'image'=>"638463753210779352_samsung-galaxy-s23-fe-den-5.webp",
                'product_id'=> 1,
               ],
               [
                'image'=>"638463753211404407_samsung-galaxy-s23-fe-den-3.webp",
                'product_id'=> 1,
               ],
            ]);
    }
}
