<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $cities = [
            'قزوین',
            'الوند',
            'محمدیه',
            'آبیک',
            'تاکستان',
            'بویین زهرا',
            'اقبالیه',
            'شریفیه',
            'بیدستان',
            'ضیاءآباد',
            'آبگرم',
            'اسفرورین',
            'دانسفهان',
            'خاکعلی',
            'رازمیان',
            'سیردان',
            'معلم کلایه',
            'کوهین',
            'ارداق',
            'نرجه',
        ];

        foreach ($cities as $city) {
            City::firstOrCreate([
                'name' => $city,
            ]);
        }
    }}
