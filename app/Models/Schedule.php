<?php
// app/Models/Schedule.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'class_id', 'day_of_week', 'start_time', 'end_time',
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'enrollments',
            'schedule_id',
            'student_id'
        )->withPivot('payment_status', 'enrolled_at');
    }
}
