<?php

namespace App\Models;

use App\Models\Assignment;
use App\Models\Intern;
use App\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'pros', 'cons', 'mark', 'assignment_id', 'intern_id', 'mentor_id',
    ];

    protected $hidden = [
        'assignment_id', 'mentor_id', 'intern_id',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function intern()
    {
        return $this->belongsTo(Intern::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public const VALIDATION_RULES = [
        'mark' => [
            'integer',
            'between:1,10',
        ],
        'pros' => [
            'string',
            'min:1',
            'max:1000',
        ],
        'cons' => [
            'string',
            'min:1',
            'max:1000',
        ],
    ];

}
