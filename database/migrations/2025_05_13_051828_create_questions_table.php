<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id'); // foreign key to exams table
            $table->string('question_type');
            $table->string('attempt_time');
            $table->text('question_text');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c')->nullable();
            $table->string('option_d')->nullable();
            $table->string('correct_answer'); // store 'A', 'B', 'C', 'D' or actual value
            $table->timestamps();

            $table->foreign('exam_id')->references('id')->on('exam_sedules')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
