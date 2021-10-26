<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Mentor;
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
    }
}
