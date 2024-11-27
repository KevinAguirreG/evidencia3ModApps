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
		Schema::create('order_stamps', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('order_id')->unsigned()->comment('Venta');
			$table->foreign('order_id')->references('id')->on('orders');
			$table->string('facturama_id', 255)->nullable()->comment('Id de la factura en facturama');

			$table->string('response_id', 255)->nullable()->comment('id (Servicio Prodigia)');
			$table->string('contract', 255)->nullable()->comment('contrato (Servicio Prodigia)');
			

			$table->string('uuid', 255)->comment('UUID');
			$table->dateTime('stamp_date', 0)->comment('FechaTimbrado');
			$table->text('cfd_seal')->comment('selloCFD');
			$table->string('sat_certificate', 255)->comment('noCertificadoSAT');
			$table->text('sat_seal')->comment('selloSAT');
			$table->text('xml')->comment('xmlBase64');
			$table->float('total', 12, 6)->nullable()->comment('Total de la factura timbrada');
			$table->dateTime('cancel_date', 0)->nullable()->comment('Fecha de cancelación');
			$table->text('original_string')->nullable()->comment('Cadena original');
			
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
		Schema::dropIfExists('order_stamps');
	}
};
