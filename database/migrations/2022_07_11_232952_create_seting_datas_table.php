<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetingDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seting_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('tigia')->nullable();
            $table->float('usdt')->nullable();
            $table->string('tentk')->nullable();
            $table->float('tk1')->nullable();
            $table->float('tk2')->nullable();
            $table->float('tk3')->nullable();
            $table->float('tk4')->nullable();
            $table->float('tk5')->nullable();
            $table->float('tk6')->nullable();
            $table->float('gia1')->nullable();
            $table->float('gia2')->nullable();
            $table->float('gia3')->nullable();
            $table->float('gia4')->nullable();
            $table->float('gia5')->nullable();
            $table->float('gia6')->nullable();



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
        Schema::dropIfExists('seting_datas');
    }
}
