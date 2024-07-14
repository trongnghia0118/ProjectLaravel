<?php

namespace Database\Seeders;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::insert([
            [
                'user_id'=>4,
                'product_id'=>1,
                'content'=>'Sản Phẩm Tốt',
                'rating'=>5,
                'created_at'=>now(),
            ],
            [
                'user_id'=>5,
                'product_id'=>1,
                'content'=>'Tạm',
                'rating'=>4,
                'created_at'=>now(),
            ],
            ]);
    }
}
