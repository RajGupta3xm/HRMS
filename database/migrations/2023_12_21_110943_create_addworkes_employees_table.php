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
        Schema::create('addworkes_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('userDepartment');
            $table->tinyInteger('status');
            $table->string('userDesignation');
            $table->integer('userId');
            $table->integer('allocationpercentage');
            $table->date('startdate');
            $table->date('enddate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addworkes_employees');
    }
};
