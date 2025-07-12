<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTagCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_tag_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')
                    ->constrained('courses')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('tag_course_id')
                    ->constrained('tag_course')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('course_tag_course');
    }
}
