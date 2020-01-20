<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopUpFreebiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topup_freebies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ItemIndex');
            $table->integer('ItemCount');
            $table->boolean('isBundle');
            $table->integer('QtyPerBundle');
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
        Schema::dropIfExists('top_up_freebies');
    }
}
