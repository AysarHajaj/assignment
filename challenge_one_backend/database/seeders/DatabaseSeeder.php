<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Location;
use App\Models\Schedule;
use App\Models\Shift;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Employee::insert([
            ["name" => "Aysar"],
            ["name" => "Jhon"],
            ["name" => "Ahmed"],
        ]);

        Location::insert([
            ["name" => "x"],
            ["name" => "y"],
            ["name" => "z"],
        ]);

        Shift::insert([
            [
                "name" => "AM",
                "start_at" => "8:00",
                "end_at" => "14:00",
            ],
            [
                "name" => "PM",
                "start_at" => "15:00",
                "end_at" => "22:00",
            ],
        ]);

        Schedule::insert([
            [
                "employee_id" => 1,
                "shift_id" => 1,
                "location_id" => 1
            ],
            [
                "employee_id" => 1,
                "shift_id" => 1,
                "location_id" => 2
            ],
            [
                "employee_id" => 1,
                "shift_id" => 2,
                "location_id" => 1
            ],
            [
                "employee_id" => 2,
                "shift_id" => 1,
                "location_id" => 1
            ],
            [
                "employee_id" => 2,
                "shift_id" => 2,
                "location_id" => 2
            ],
            [
                "employee_id" => 2,
                "shift_id" => 2,
                "location_id" => 1
            ],
            [
                "employee_id" => 3,
                "shift_id" => 1,
                "location_id" => 1
            ],
            [
                "employee_id" => 3,
                "shift_id" => 1,
                "location_id" => 2
            ],
            [
                "employee_id" => 3,
                "shift_id" => 2,
                "location_id" => 1
            ],
            [
                "employee_id" => 3,
                "shift_id" => 2,
                "location_id" => 2
            ],
        ]);
    }
}
