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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('faculty',255);
            $table->string('university',255)->nullable();
            $table->string('specialization',500)->nullable();
            $table->enum('status', [0, 1])->comment('0 => not active , 1=> active');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('description' ,1000)->nullable();
            $table->string('degree' , 255)->nullable();
            $table->tinyInteger('gpa')->nullable();
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
        Schema::dropIfExists('educations');
    }
};
