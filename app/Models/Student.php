<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    public function extra(): BelongsToMany
    {
        return $this->belongsToMany(Extra::class, 'student_extra', 'student_id', 'extra_id');
    }
}
