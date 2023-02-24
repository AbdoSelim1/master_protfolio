<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->enum('status', [0, 1])->comment('0 => not active , 1=> active');
            $table->string('company_name', 255);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('job_title',255);
            $table->string('job_type',255);
            $table->string('job_responsibilities' ,1000);
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
        Schema::dropIfExists('works');
    }
};
