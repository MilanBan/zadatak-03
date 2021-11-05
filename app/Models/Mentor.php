<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'city', 'skype'
    ];

    protected $hidden = [
        'pivot',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function groups() {
        return $this->belongsToMany(Group::class);
    }
    public function assignments() {
        return $this->hasMany(Assignment::class);
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
