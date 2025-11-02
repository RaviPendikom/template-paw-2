<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Extracurricular extends Model
{
    protected $fillable = [
        'name',
        'description',
        'schedule',
        'teacher_id'
    ];

    public function teacher(): BelongsTo{
        return $this->belongsTo(Teacher::class);
    }
}
