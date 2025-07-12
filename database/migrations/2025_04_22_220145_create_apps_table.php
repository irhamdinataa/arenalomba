<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->nullable();
            $table->string('logo', 128)->nullable();
            $table->string('favicon', 128)->nullable();
            $table->string('title', 128)->nullable();
            $table->text('description')->nullable();
            $table->string('link_web', 128)->nullable();
            $table->string('banner', 128)->nullable();
            $table->string('link_fb', 128)->nullable();
            $table->string('link_ig', 128)->nullable();
            $table->string('link_yt', 128)->nullable();
            $table->string('link_banner', 128)->nullable();

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
        Schema::dropIfExists('apps');
    }
}
