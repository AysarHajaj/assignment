<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceFaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_faults', function (Blueprint $table) {
            $table->id();
            $table->string('fault');
            $table->foreignId('employee_id')->constrained('employees');
            $table->foreignId('attendance_id')->constrained('attendances');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_faults', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['attendance_id']);
        });
        Schema::dropIfExists('attendance_faults');
    }
}
