<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'logo',
        'description'
    ];

    /**
     * Get the singleton instance of School.
     * If it doesn't exist, create a new row.
     */
    public static function singleton(): School
    {
        $school = self::first();
        if (!$school) {
            $school = self::create([
                'name' => 'My School',
                'address' => '',
                'phone' => '',
                'email' => '',
                'description' => '',
                'logo' => null,
            ]);
        }
        return $school;
    }
}
