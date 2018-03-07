<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('user_id');
            $table->string('message', 1000);
            $table->string('image', 64);
            $table->boolean('hasResponse')->default(false);

            $table->timestamps();
        });
        //
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message', function (Blueprint $table) {
            Schema::drop('message');
        });

    }
}
