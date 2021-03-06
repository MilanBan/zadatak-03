<?php

namespace App\Models;

use App\Models\Mentor;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public const VALIDATION_RULES = [
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
        ],
        'password' => [
            'string',
            'confirmed',
            'min:8',
        ],
    ];
}
