<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('empId')->unique();
            $table->string('emergencycontact');
            $table->string('pannumber');
            $table->string('name');
            $table->string('currentaddress');
            $table->integer('trainingcompletion');
            $table->string('department');
            $table->string('permanentaddress');
            $table->integer('comnpanyexperience');
            $table->string('designation');
            $table->string('city');
            $table->string('employeestatus');
            $table->string('reportingmanager');
            $table->date('dob');
            $table->date('lastworkingday');
            $table->string('officialemail');
            $table->date('joiningdate');
            $table->string('personalemail');
            $table->string('higestqualification');
            $table->string('contactdetails');
            $table->string('aadharnumber');
            $table->string('employee_image')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
