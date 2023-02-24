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
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->enum('status' , [0,1])->comment('0 => not active , 1=> active');
            $table->string('name' , 255);
            $table->string('company_name')->nullable();
            $table->string('file_name',255);
            $table->string('file_path',1000);
            $table->string('file_type',255);
            $table->string('file_size',20);
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
        Schema::dropIfExists('cvs');
    }
};
