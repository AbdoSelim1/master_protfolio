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
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->string('city' ,50);
            $table->string('country' ,50);
            $table->string('email' ,255);
            $table->string('phone' , 20);
            $table->string('job_title',100);
            $table->enum('status' , [0,1])->comment('0 => not active , 1=> active');
            $table->tinyInteger('age');
            $table->string('about')->nullable();
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
        Schema::dropIfExists('personal_information');
    }
};
