<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Web Development', 'Mobile Apps', 'Data Science', 'Machine Learning', 'Design'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
