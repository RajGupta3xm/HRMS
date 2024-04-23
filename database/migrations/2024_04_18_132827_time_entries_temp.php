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
        Schema::create('time_entries_temp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('date');
            $table->string('day');
            $table->decimal('monday_hours', 8, 2)->default(0.00);
            $table->decimal('tuesday_hours', 8, 2)->default(0.00);
            $table->decimal('wednesday_hours', 8, 2)->default(0.00);
            $table->decimal('thursday_hours', 8, 2)->default(0.00);
            $table->decimal('friday_hours', 8, 2)->default(0.00);
            $table->decimal('saturday_hours', 8, 2)->default(0.00);
            $table->decimal('sunday_hours', 8, 2)->default(0.00);
            $table->decimal('total_hours', 8, 2)->default(0.00);
            $table->string('descriptions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_entries_temp');
    }
};
