<?php
// app/Models/Student.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'parent_id', 'name', 'date_of_birth',
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function schedules()
    {
        return $this->belongsToMany(
            Schedule::class,
            'enrollments',
            'student_id',
            'schedule_id'
        )->withPivot('payment_status', 'enrolled_at');
    }
}
