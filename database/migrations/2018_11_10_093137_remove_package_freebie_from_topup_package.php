<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePackageFreebieFromTopupPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('topup_package', function (Blueprint $table) {
        $table->dropColumn('freebie_package');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('topup_package', function (Blueprint $table) {
        $table->string('freebie_package');
      });
    }
}
