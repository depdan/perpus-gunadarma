<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Teknologi',
            'Sains & Matematika',
            'Bisnis & Manajemen',
            'Desain & Seni',
            'Sastra & Fiksi',
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['name' => $cat],
                ['slug' => Str::slug($cat)]
            );
        }
    }
}
