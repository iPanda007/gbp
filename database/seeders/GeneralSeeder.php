<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'parent_id' => 0],
            ['name' => 'Health', 'parent_id' => 0],
            ['name' => 'Lifestyle', 'parent_id' => 0],
            ['name' => 'Education', 'parent_id' => 0],
            ['name' => 'Travel', 'parent_id' => 0],
            ['name' => 'Food', 'parent_id' => 0],
        ];

        $tags = [
            ['name' => 'AI'],
            ['name' => 'Wellness'],
            ['name' => 'Fitness'],
            ['name' => 'Coding'],
            ['name' => 'Travel Tips'],
            ['name' => 'Healthy Eating'],
        ];

        foreach($tags as $tag) {
            Tag::create($tag);
        }

        foreach($categories as $category) {
            Category::create($category);
        }
    }
}
