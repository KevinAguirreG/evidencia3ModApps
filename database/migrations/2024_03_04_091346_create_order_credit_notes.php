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
		Schema::create('order_credit_notes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('folio')->unsigned()->comment('Folio');
			$table->integer('order_stamp_id')->unsigned()->comment('Factura');
			$table->foreign('order_stamp_id')->references('id')->on('order_stamps');
			$table->integer('client_id')->unsigned()->comment('Cliente');
			$table->foreign('client_id')->references('id')->on('clients');
			$table->integer('payment_type_id')->unsigned()->nullable()->comment('Tipo de pago');
			$table->foreign('payment_type_id')->references('id')->on('payment_types');
			$table->integer('payment_method_id')->unsigned()->nullable()->comment('Método de pago');
			$table->foreign('payment_method_id')->references('id')->on('payment_methods');
			$table->string('currency_type', 255)->default("MXN")->comment('Moneda');
			$table->float('previous_balance', 12, 6)->nullable()->comment('Importe Saldo Anterior');
			$table->float('total', 12, 6)->nullable()->comment('Total del complemento de pago timbrada');
			$table->float('pending_amount', 12, 6)->nullable()->comment('Saldo Insoluto');
			
			$table->string('facturama_id', 255)->comment('Id del complemento de pago en facturama');
			$table->string('uuid', 255)->comment('UUID');
			$table->dateTime('stamp_date', 0)->comment('FechaTimbrado');
			$table->text('cfd_seal')->comment('selloCFD');
			$table->string('sat_certificate', 255)->comment('noCertificadoSAT');
			$table->text('sat_seal')->comment('selloSAT');
			$table->text('xml')->comment('xmlBase64');
			$table->dateTime('cancel_date', 0)->nullable()->comment('Fecha de cancelación');
			$table->text('original_string')->comment('Cadena original');
			
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
		Schema::dropIfExists('order_credit_notes');
	}
};
