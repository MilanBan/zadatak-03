<?php

namespace App\Models;

use App\Models\Intern;
use App\Models\Mentor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function interns(): HasMany
    {
        return $this->hasMany(Intern::class);
    }

    public function mentors(): HasMany
    {
        return $this->hasMany(Mentor::class);
    }
}
