<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicianService extends Model
{
    use HasFactory;

    protected $fillable = [
        'technician_id',
        'service_id',
        'price',
        'years_of_experience',
        'estimated_duration',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'custom_price' => 'integer',
            'estimated_duration' => 'integer',
            'experience_years' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
