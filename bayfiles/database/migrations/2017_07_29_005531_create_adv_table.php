<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adv', function (Blueprint $table) {
            $table->increments('id');
		$table->string('categoryid');
		$table->string('description');
		$table->string('price');
		$table->string('place');
		$table->string('email');
		$table->string('phone');
		$table->string('pictureid');
		$table->int('userid');
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
        Schema::dropIfExists('adv');
    }
}
