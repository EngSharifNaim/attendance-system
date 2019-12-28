<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogintablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logintables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->time('login_at');
            $table->time('logout_at');
            $table->time('time_in');
            $table->float('duration');
            $table->float('late');
            $table->float('preout');
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
