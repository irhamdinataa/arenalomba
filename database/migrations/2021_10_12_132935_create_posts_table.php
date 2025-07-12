<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('categories_id')
                    ->constrained('categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                    
            $table->integer('sub_categories')->nullable();
            $table->string('post_title');
            $table->string('post_teaser')->nullable();
            $table->longText('post_content');
            $table->string('slug')->unique();
            $table->string('post_status')->nullable();
            $table->string('post_image')->nullable();
            $table->text('post_image_description')->nullable();
            $table->dateTime('published_at')->nullable();

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
        Schema::dropIfExists('posts');
    }
}
