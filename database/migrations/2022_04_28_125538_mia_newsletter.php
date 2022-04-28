<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaNewsletter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_newsletter', function (Blueprint $table) {
            $table->id();

            $table->string('firstname');
    $table->string('lastname');
    $table->string('email');
    $table->string('phone');
    $table->text('data_extra');
    $table->integer('status');
    

            

            $table->timestamps();

            $table->integer('deleted')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mia_newsletter');
    }
}