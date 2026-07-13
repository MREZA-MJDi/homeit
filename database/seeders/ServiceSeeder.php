<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [

            // Software
            ['Software','Windows Installation','fixed',450000,60],
            ['Software','Windows Troubleshooting','hourly',300000,60],
            ['Software','Microsoft Office Installation','fixed',180000,20],
            ['Software','Adobe Photoshop Installation','fixed',200000,25],
            ['Software','Driver Installation','fixed',150000,20],
            ['Software','Antivirus Installation','fixed',120000,15],

            // Hardware
            ['Hardware','RAM Upgrade','fixed',350000,30],
            ['Hardware','SSD Installation','fixed',450000,45],
            ['Hardware','Laptop Cleaning Service','fixed',600000,90],
            ['Hardware','Desktop Assembly','fixed',900000,120],

            // Network
            ['Network','Home Network Setup','hourly',350000,60],
            ['Network','Office Network Configuration','hourly',450000,90],
            ['Network','Network Troubleshooting','hourly',400000,60],

            // Internet
            ['Internet & Modem','Modem Installation','fixed',250000,30],
            ['Internet & Modem','Router Configuration','fixed',300000,45],
            ['Internet & Modem','Internet Troubleshooting','hourly',350000,60],

            // Printer
            ['Printer & Scanner','Printer Installation','fixed',200000,30],
            ['Printer & Scanner','Scanner Installation','fixed',200000,30],
            ['Printer & Scanner','Printer Troubleshooting','hourly',250000,45],

            // Data Recovery
            ['Data Recovery','Data Recovery','quote',null,null],
            ['Data Recovery','Data Backup','fixed',500000,60],
            ['Data Recovery','File Transfer','fixed',250000,30],

            // Security
            ['Security','Malware Removal','fixed',450000,60],
            ['Security','Security Audit','quote',null,null],

            // Smart Home
            ['Smart Home','Smart Camera Setup','fixed',600000,90],
            ['Smart Home','Smart Device Installation','quote',null,null],

            // Web
            ['Web Design','Business Website Design','quote',null,null],
            ['Web Design','Landing Page Design','quote',null,null],
            ['Web Design','E-commerce Website','quote',null,null],

            // Training
            ['Private Training','Windows Training','hourly',400000,120],
            ['Private Training','Office Training','hourly',400000,120],
            ['Private Training','Programming Training','hourly',700000,120],

            // Consultation
            ['Consultation','Computer Purchase Consultation','fixed',200000,30],
            ['Consultation','Network Consultation','fixed',300000,45],

        ];

        foreach ($services as $service) {

            $category = ServiceCategory::where('name',$service[0])->first();

            Service::create([
                'category_id' => $category->id,
                'title' => $service[1],
                'slug' => Str::slug($service[1]),
                'short_description' => null,
                'description' => null,
                'price_type' => $service[2],
                'base_price' => $service[3],
                'duration' => $service[4],
                'image' => null,
                'is_active' => true,
            ]);

        }
    }
}
