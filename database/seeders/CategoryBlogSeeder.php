<?php

namespace Database\Seeders;

use App\Models\CategoryBlog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => Str::uuid(), 'name' => 'Programming', 'slug' => 'programming'],
            ['id' => Str::uuid(), 'name' => 'Life Style', 'slug' => 'life-style'],
        ];

        CategoryBlog::insert($data);
    }
}
