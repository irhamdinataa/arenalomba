<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_request', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('categories_id')
                    ->constrained('category_contest')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('sub_categories')->nullable();
            $table->string('post_title');
            $table->string('post_teaser')->nullable();
            $table->longText('post_content');
            $table->string('slug')->unique();
            $table->string('level')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('price')->nullable();
            $table->string('organizer')->nullable();
            $table->string('status')->nullable();
            $table->string('location')->nullable();
            $table->string('payment')->nullable();
            $table->string('post_status')->nullable();
            $table->string('post_image')->nullable();
            $table->text('post_image_description')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->string('is_approve')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('contest_request');
    }
}
