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
        Schema::create('university_collectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('type_id')->comment('1: student, 2: teacher');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('personal_id');
            $table->json('emails');
            $table->date('date_of_birth');
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
        Schema::dropIfExists('teachers');
    }
};
