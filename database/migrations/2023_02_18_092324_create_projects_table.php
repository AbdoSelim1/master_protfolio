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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name' ,255);
            $table->string('slug' , 255)->unique();
            $table->string('github_url',500);
            $table->string('preview_url' ,500);
            $table->json('tools');
            $table->string('description' , 1000)->nullable();
            $table->date('start_date')->nullable();
            $table->enum('status',[0,1])->comment('0 => not active , 1=>active');
            $table->tinyInteger('priority');
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
        Schema::dropIfExists('projects');
    }
};
