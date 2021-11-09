<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class)
            ->withPivot([ 'created_at', 'start_date', 'finish_date', 'active']);
    }

    public const VALIDATION_RULES = [
        'name' => [
            'string',
            'min:2',
            'max:20'
        ],
        'description' => [
            'string',
            'min:2',
            'max:1000'
        ],
    ];
}
