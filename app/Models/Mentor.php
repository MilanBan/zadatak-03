<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'city', 'skype',
    ];

    protected $hidden = [
        'pivot',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public const VALIDATION_RULES = [
        'city' => [
            'string',
            'min:2',
            'max:20',
        ],
        'skype' => [
            'string',
            'min:2',
            'max:20',
        ],
        'group_id' => [
            'integer',
            'exists:group_mentor,group_id',
        ],
    ];
}
