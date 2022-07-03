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
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('term_id');
            $table->unsignedInteger('maths');
            $table->unsignedInteger('science');
            $table->unsignedInteger('history');
            $table->unsignedInteger('total_marks');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_marks');
    }
};
