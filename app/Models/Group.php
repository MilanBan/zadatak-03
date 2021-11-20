<?php

namespace App\Models;

use App\Models\Assignment;
use App\Models\Intern;
use App\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        // 'pivot',
    ];

    public function interns()
    {
        return $this->hasMany(Intern::class);
    }

    public function mentors()
    {
        return $this->belongsToMany(Mentor::class);
    }

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class)
            ->withPivot(['created_at', 'start_date', 'finish_date', 'active']);
    }

    public const VALIDATION_RULES = [
        'name' => [
            'string',
            'min:2',
            'max:20',
            'unique:groups,name',

        ],
    ];

}
