<?php
// app/Models/SchoolClass.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    // since table is named "classes"
    protected $table = 'classes';

    protected $fillable = ['name', 'description'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'class_id');
    }
}
