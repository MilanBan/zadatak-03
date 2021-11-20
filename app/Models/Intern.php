<?php

namespace App\Models;

use App\Models\Assignment;
use App\Models\Group;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id', 'firstName', 'lastName', 'city', 'address', 'email', 'telephone', 'cv', 'github',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function assignments()
    {
        return $this->hasManyThrough(Assignment::class, Group::class);
    }

    public const VALIDATION_RULES = [
        'city' => [
            'string',
            'min:2',
            'max:20',
        ],
        'telephone' => [
            'string',
            'min:2',
            'max:20',
        ],
        'firstName' => [
            'string',
            'min:2',
            'max:20',
        ],
        'lastName' => [
            'string',
            'min:2',
            'max:20',
        ],
        'email' => [
            'string',
            'email',
            'max:255',
            'unique:interns,email'
        ],
        'address' => [
            'string',
            'min:2',
        ],
        'cv' => [
            'mimes:,doc,docx,pdf', 'max:10000',
        ],
        'github' => [
            'string',
            'url',
        ],
        'group_id' => [
            'exists:groups,id',
        ]
    ];
}
