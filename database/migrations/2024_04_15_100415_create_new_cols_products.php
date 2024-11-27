<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->float('weight', 12, 6)->nullable()->comment('Peso del producto');
            $table->integer('sat_data_id')->nullable()->unsigned()->comment('Datos del SAT');
            $table->foreign('sat_data_id')->references('id')->on('sat_datas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('weight');
            $table->dropColumn('sat_data_id');

        });
    }
};
