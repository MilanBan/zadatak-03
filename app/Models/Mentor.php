<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'city', 'skype'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public const VALIDATION_RULES = [
        'city' => [
            'string',
            'min:2',
            'max:20'
        ],
        'skype' => [
            'string',
            'min:2',
            'max:20',
        ]
    ];
}
