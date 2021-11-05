<?php

namespace App\Models;

use App\Models\Intern;
use App\Models\Mentor;
use App\Models\Assignment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
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
        return $this->belongsToMany(Assignment::class, 'assignment_group', 'assignment_id', 'group_id')
            ->withPivot(['start_date', 'finish_date', 'active']);
    }

    public const VALIDATION_RULES = [
        'name' => [
            'string',
            'min:2',
            'max:20'
        ]
    ];

}
