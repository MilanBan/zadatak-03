<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Mentor;
use App\Models\Assignment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intern extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName', 'lastName', 'city', 'address', 'email', 'telephone', 'cv', 'github' 
    ];

    
    public function group() {
        return $this->belongsTo(Group::class);
            // ->using(Assignment::class);
    }

    public function assignments() {
        return $this->hasManyThrough(Assignment::class, Group::class);
    }

    public const VALIDATION_RULES = [
        'city' => [
            'string',
            'min:2',
            'max:20'
        ],
        'telephone' => [
            'string',
            'min:2',
            'max:20',
        ],
        'firstName' => [
            'string',
            'min:2',
            'max:20'
        ],
        'lastName' => [
            'string',
            'min:2',
            'max:20'
        ],
        'email' => [
            'string',
            'email',
            'max:255'
        ],
        'address' => [
            'string',
            'min:2',
        ],
        'cv' => [
            'mimes:,doc,docx,pdf|max:10000'
        ],
        'git' => [
            'string',
            'url',
        ]
    ];
}
