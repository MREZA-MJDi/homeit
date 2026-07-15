<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_description',
        'description',
        'price_type',
        'base_price',
        'duration',
        'image',
        'is_active',
    ];
    public function technicians()
    {
        return $this->hasMany(TechnicianService::class);
    }
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
}
