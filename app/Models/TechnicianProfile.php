<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicianProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'bio',
        'national_code',
        'iban',
        'is_available',
        'vacation_until',
        'is_verified',
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
