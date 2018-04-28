<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Advcomment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('advcomment', function (Blueprint $table) {
        	$table->increments('id');
        	$table->string('comment');
        	$table->integer('userid');
        	$table->integer('advid');
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
        Schema::dropIfExists('advcomment');
    }
}
