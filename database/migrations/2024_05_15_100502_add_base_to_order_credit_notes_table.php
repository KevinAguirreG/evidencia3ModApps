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
		Schema::table('order_credit_notes', function (Blueprint $table) {
			$table->float('total_base', 12, 6)->nullable()->after('previous_balance')->comment('Total sin IVA');
			$table->float('iva', 12, 6)->nullable()->after('total_base')->comment('IVA');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('order_credit_notes', function (Blueprint $table) {
			$table->dropColumn('total_base');
			$table->dropColumn('iva');
		});
	}
};
