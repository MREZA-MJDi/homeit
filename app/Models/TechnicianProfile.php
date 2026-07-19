<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicianProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio',
        'years_of_experience',
        'education',
        'avatar',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
            'is_verified' => 'boolean',
            'vacation_until' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
