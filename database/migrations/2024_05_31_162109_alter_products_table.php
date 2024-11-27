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
			$table->dropForeign('products_client_id_foreign');
			$table->dropColumn('client_id');
			$table->dropColumn('price');
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
			$table->integer('client_id')->unsigned()->comment('Cliente');
			$table->foreign('client_id')->references('id')->on('clients');
			$table->float('price', 12, 6)->nullable()->comment('Precio del producto');
		});
	}
};
