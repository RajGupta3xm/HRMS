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
      
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('projectcompany');
            $table->string('projectname');
            $table->integer('pmemployeeId')->notNull();
            $table->integer('pmallocation')->notNull();

            $table->string('currency')->notNull();

            $table->decimal('projectbudget', 10, 2)->notNull();
            $table->string('projecttype');
            $table->string('csm');
            $table->string('contract');
            $table->string('tags');
            $table->string('status');

            $table->string('sc');
            $table->string('cilentname');
            $table->string('cilentemail')->unique();

            $table->string('companyname');
            $table->bigInteger('cilentphone');
            $table->string('country');
            $table->string('city');
            $table->date('projectstartdate');
            $table->date('projectenddate');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        //
    }
};
