<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    function __construct(AttendanceService $service)
    {
        $this->service = $service;
    }

    public function uploadContent(Request $request)
    {
        $file = $request->file('uploaded_file');

        return $this->service->uploadContent($file);
    }

    public function getEmployeesData()
    {
        return $this->service->getEmployeesData();
    }
}
