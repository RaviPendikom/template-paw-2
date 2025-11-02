<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'employee_number',
        'email',
        'position',
        'photo'
    ];

    public function extracurriculars() : HasMany {
        return $this->hasMany(Extracurricular::class);
    }
}
