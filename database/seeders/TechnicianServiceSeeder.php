<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\TechnicianService;
use App\Models\User;
use Illuminate\Database\Seeder;

class TechnicianServiceSeeder extends Seeder
{
    public function run(): void
    {
        $technicians = User::role('Technician')->get();
        $services = Service::all();

        foreach ($technicians as $technician) {
            foreach ($services->random(min(3, $services->count())) as $service) {
                TechnicianService::firstOrCreate(
                    [
                        'technician_id' => $technician->id,
                        'service_id' => $service->id,
                    ],
                    [
                        'custom_price' => $service->base_price,
                        'estimated_duration' => $service->duration,
                        'experience_years' => rand(1, 10),
                        'description' => 'تکنسین دارای مهارت در این سرویس است.',
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
