<?php

namespace App\Services;

use App\Imports\ImportAttendance;
use App\Models\Employee;
use Excel;


class AttendanceService
{
    public function uploadContent($file)
    {
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes
            //Check for file extension and size
            $this->checkUploadedFileProperties($extension, $fileSize);
            //Where uploaded file will be stored on the server 
            $location = 'uploads'; //Created an "uploads" folder for that
            // Upload file
            $file->move($location, $filename);
            // In case the uploaded file path is to be stored in the database 
            $filepath = public_path($location . "/" . $filename);

            Excel::import(new ImportAttendance, $filepath);
            return true;
        } else {
            //no file was uploaded
            throw new \Exception('No file was uploaded');
        }
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
                throw new \Exception('No file was uploaded'); //413 error
            }
        } else {
            throw new \Exception('Invalid file extension'); //415 error
        }
    }

    public function getEmployeesData()
    {
        $employees = Employee::with([
            "schedules" => function ($q) {
                $q->with([
                    "shift",
                    "attendance"
                ]);
            }
        ])->get();

        $result = [];

        foreach ($employees as $employee) {
            $employeeData = [
                "employee_id" => $employee->id,
                "employee_name" => $employee->name,
                "total_working_hours" => "N/A",
                "schedules" => []
            ];
            $totalWorkingHours = 0;
            $totalWorkingHoursApplicable = true;
            foreach ($employee->schedules as $schedule) {
                $workingHours = "N/A";
                if ($schedule->attendance && $schedule->attendance->check_in && $schedule->attendance->check_out) {
                    $workingHours = (strtotime($schedule->attendance->check_out) - strtotime($schedule->attendance->check_in)) / (60 * 60);
                } else {
                    $totalWorkingHoursApplicable = false;
                }

                $scheduleData = [
                    "id" => $schedule->id,
                    "shift" => [
                        "id" => $schedule->shift->id,
                        "name" => $schedule->shift->name,
                        "start_time" => $schedule->shift->start_at,
                        "end_time" => $schedule->shift->end_at
                    ],
                    "attendance" => [
                        "id" => $schedule->attendance ? $schedule->attendance->id : null,
                        "check_in" =>  $schedule->attendance ? $schedule->attendance->check_in : null,
                        "check_out" =>  $schedule->attendance ? $schedule->attendance->check_out : null,
                        "working_hours" => $workingHours
                    ]
                ];
                if ($workingHours != "N/A") {
                    $totalWorkingHours += $workingHours;
                }
                $employeeData["schedules"][] = $scheduleData;
            }
            if ($totalWorkingHoursApplicable) {
                $employeeData["total_working_hours"] = $totalWorkingHours;
            }

            $result[] = $employeeData;
        }

        return $result;
    }
}
