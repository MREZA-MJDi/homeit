<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            [
                'name' => 'Software',
                'icon' => 'monitor',
            ],
            [
                'name' => 'Hardware',
                'icon' => 'cpu',
            ],
            [
                'name' => 'Network',
                'icon' => 'network',
            ],
            [
                'name' => 'Internet & Modem',
                'icon' => 'wifi',
            ],
            [
                'name' => 'Printer & Scanner',
                'icon' => 'printer',
            ],
            [
                'name' => 'Data Recovery',
                'icon' => 'database-backup',
            ],
            [
                'name' => 'Security',
                'icon' => 'shield',
            ],
            [
                'name' => 'Smart Home',
                'icon' => 'house',
            ],
            [
                'name' => 'Web Design',
                'icon' => 'globe',
            ],
            [
                'name' => 'Private Training',
                'icon' => 'graduation-cap',
            ],
            [
                'name' => 'Consultation',
                'icon' => 'message-circle',
            ],

        ];

        foreach ($categories as $index => $category) {

            ServiceCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'icon' => $category['icon'],
                'image' => null,
                'description' => null,
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }
}
