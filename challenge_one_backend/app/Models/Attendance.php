<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        "employee_id",
        "schedule_id",
        "check_out",
        "check_in"
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function Schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function faults()
    {
        return $this->hasMany(AttendanceFault::class, 'attendance_id');
    }
}
