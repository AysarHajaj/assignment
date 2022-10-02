<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'employee_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }

    public function attendance_faults()
    {
        return $this->hasMany(AttendanceFault::class, 'employee_id');
    }
}
