<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate(); // Clear existing categories
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $categories = [
            // Computer & IT
            'Computer Science', 'Information Technology', 'Software Engineering', 'Data Science', 'Cybersecurity', 'Artificial Intelligence', 'Computer Networks', 'Systems Analysis',

            // Engineering
            'Electronics Engineering', 'Electrical Engineering', 'Mechanical Engineering', 'Civil Engineering', 'Industrial Engineering', 'Mechatronics', 'Robotics', 'Engineering Management',

            // Business
            'Business Administration', 'Financial Management', 'Marketing', 'Human Resource Management', 'Entrepreneurship', 'Operations Management', 'Supply Chain & Logistics', 'Business Analytics',

            // Natural Sciences
            'Biology', 'Chemistry', 'Physics', 'Environmental Science', 'Geology', 'Marine Science',

            // Social Sciences
            'Psychology', 'Sociology', 'Political Science', 'History', 'Philosophy', 'Anthropology', 'Literature & Language',

            // Arts
            'Communication Studies', 'Media & Journalism', 'Visual Arts', 'Performing Arts', 'Graphic Design', 'Architecture',

            // Health
            'Nursing', 'Pharmacy', 'Public Health', 'Medical Technology', 'Physical Therapy', 'Nutrition & Dietetics',

            // Education
            'Early Childhood Education', 'Secondary Education', 'Special Education', 'Educational Leadership', 'Curriculum Development', 'TESOL',

            // Interdisciplinary
            'Capstone Innovation Projects', 'Interdisciplinary Research', 'Community Development', 'Campus-based Studies', 'Feasibility Studies',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}

