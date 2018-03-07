<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message', function(Blueprint $table)
        {
            $table->string('agent', 127)->default('');
            $table->string('ip', 31)->default('');
        });
    }

    public function down()
    {
        Schema::table('message', function(Blueprint $table)
        {
            $table->dropColumn('agent');
            $table->dropColumn('ip');
        });
    }
}
