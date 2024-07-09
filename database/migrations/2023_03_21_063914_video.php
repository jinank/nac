<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Video extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('file_name')->unique();
            $table->string('video_title');
            $table->string('creator_name');
            $table->string('genere_id');
            $table->string('zipcode');
            $table->string('tags');
            $table->string('description');
            $table->string('thumbnail');
            $table->string('other_video_link')->nullable();
            $table->string('ads_button_text')->nullable();
            $table->string('ads_button_link')->nullable();
            $table->enum('is_approved',["Yes","No"])->default('No');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
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
        //
    }
}
