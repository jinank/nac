<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('website');
            $table->string('address');
            $table->string('phone_number');
            $table->string('description');
            $table->enum('is_approved',['Yes','No'])->default('No');
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
        Schema::dropIfExists('new_businesses');
    }
}
