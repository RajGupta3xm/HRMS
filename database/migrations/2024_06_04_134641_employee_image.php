<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employeeImage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_Id'); 
            $table->string('imageName'); 
            $table->timestamps();

            $table->foreign('employee_Id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
