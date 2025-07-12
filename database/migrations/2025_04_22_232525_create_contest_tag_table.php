<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_tag_contest', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contest_id')
                    ->constrained('contest')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('tag_contest_id')
                    ->constrained('tag_contest')
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
        Schema::dropIfExists('contest_tag');
    }
}
