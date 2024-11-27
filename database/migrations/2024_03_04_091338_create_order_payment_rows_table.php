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
		Schema::create('order_payment_rows', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('order_payment_id')->unsigned()->comment('Factura');
			$table->foreign('order_payment_id')->references('id')->on('order_payments');
			$table->integer('order_stamp_id')->unsigned()->comment('Factura');
			$table->foreign('order_stamp_id')->references('id')->on('order_stamps');
			$table->integer('payment_type_id')->unsigned()->comment('Tipo de pago');
			$table->foreign('payment_type_id')->references('id')->on('payment_types');
			$table->integer('payment_method_id')->unsigned()->comment('Método de pago');
			$table->foreign('payment_method_id')->references('id')->on('payment_methods');
			$table->string('currency_type', 255)->default("MXN")->comment('Moneda');
			$table->integer('partiality_number')->unsigned()->comment('Número de parcialidad');
			$table->float('previous_balance', 12, 6)->comment('Importe Saldo Anterior');
			$table->float('total', 12, 6)->comment('Cantidad pagada');
			$table->float('pending_amount', 12, 6)->comment('Saldo insoluto');
			
			//Datos de creación y modificación
			$table->string('notes', 1024)->nullable()->comment('Notas');
			$table->boolean('is_active')->default(1)->comment('Muestra si la fila está activa');
			$table->smallInteger('created_by')->unsigned()->nullable()->comment('Usuario que creó');
			$table->foreign('created_by')->references('id')->on('users');
			$table->smallInteger('updated_by')->unsigned()->nullable()->comment('Último usuario que modificó');
			$table->foreign('updated_by')->references('id')->on('users');
			$table->timestamp('created_at', 0)->useCurrent()->comment('Fecha de creación');
			$table->timestamp('updated_at', 0)->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))
				->comment('Última fecha de modificación');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('order_payment_rows');
	}
};
