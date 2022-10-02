<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\AttendanceFault;
use App\Models\Schedule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportAttendance implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $checkIn = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['check_in'])->format('H:i');
            $checkOut = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['check_out'])->format('H:i');

            $attendance = Attendance::create([
                "employee_id" => $row["employee_id"],
                "schedule_id" => $row["schedule_id"],
                "check_in" => $row["check_in"] ? $checkIn : null,
                "check_out" => $row["check_out"] ? $checkOut : null,
            ]);

            $faults = [];
            $schedule = Schedule::with(["shift"])->find($row['schedule_id']);
            if ($row['check_in']) {
                if ($schedule->start_at > $checkIn) {
                    $faults[] = "late_check_in";
                }
                if ($schedule->start_at < $checkIn) {
                    $faults[] = "early_check_in";
                }
            } else {
                $faults[] = "messing_check_in";
            }

            if ($row['check_out']) {
                if ($schedule->end_at > $checkOut) {
                    $faults[] = "late_check_out";
                }
                if ($schedule->end_at < $checkOut) {
                    $faults[] = "early_check_out";
                }
            } else {
                $faults[] = "messing_check_out";
            }

            foreach ($faults as $fault) {
                AttendanceFault::create([
                    "attendance_id" => $attendance->id,
                    "employee_id" => $row["employee_id"],
                    "fault" => $fault
                ]);
            }
        }
    }
}
