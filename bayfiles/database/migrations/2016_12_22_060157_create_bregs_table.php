<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBregTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breg', function (Blueprint $table) {
            $table->increments('id');
			$table->string('businessname');
			$table->string('businesstypeid');
			$table->string('locationid');
			$table->string('address');
			$table->string('email');
			$table->string('phone');
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
        Schema::dropIfExists('bregs');
    }
}
