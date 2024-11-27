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
		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id')->from(10001);
			$table->integer('client_id')->unsigned()->nullable()->comment('Cliente');
			$table->foreign('client_id')->references('id')->on('clients');
			$table->integer('payment_type_id')->unsigned()->nullable()->comment('Tipo de pago');
			$table->foreign('payment_type_id')->references('id')->on('payment_types');
			$table->integer('payment_method_id')->unsigned()->nullable()->comment('Método de pago');
			$table->foreign('payment_method_id')->references('id')->on('payment_methods');
			$table->string('branch_code', 255)->nullable()->comment('Número de sucursal');
			$table->string('fax', 255)->nullable()->comment('Número de sucursal');
			$table->string('order_number', 255)->nullable()->comment('Purchase Order Number');
			$table->timestamp('order_date', 0)->nullable()->useCurrent()->comment('Purchase Order Date');
			$table->timestamp('shipping_date', 0)->nullable()->useCurrent()->comment('Fecha De Envio');
			$table->timestamp('cancel_date', 0)->nullable()->useCurrent()->comment('Fecha De Cancelacion');
			$table->string('order_type', 255)->nullable()->comment('Tipo De Orden');
			$table->string('currency_type', 255)->nullable()->comment('Moneda');
			$table->string('department', 255)->nullable()->comment('Department');
			$table->string('promotional_event', 255)->nullable()->comment('Promotional Event');
			$table->string('payment_terms', 255)->nullable()->comment('PaymentTerms');
			$table->string('fob', 255)->nullable()->comment('F.O.B.');
			$table->string('fob_details', 255)->nullable()->comment('F.O.B. Punto De Entrega Punto De Embarque');
			$table->string('carrier', 255)->nullable()->comment('Portador');
			$table->string('ship_to', 255)->nullable()->comment('Enviar a');
			$table->string('gln', 255)->nullable()->comment('GLN');
			$table->string('pay_to', 255)->nullable()->comment('Pagar A');
			$table->string('store', 255)->nullable()->comment('Formato De Tienda');
			$table->string('supplier_name', 255)->nullable()->comment('Nombre De Proveedor');
			$table->string('supplier_number', 255)->nullable()->comment('Supplier Number');
			$table->string('supplier_phone', 255)->nullable()->comment('Supplier Number');


			// $table->float('subtotal', 12, 4)->comment('Subtotal');
			// $table->float('discount', 12, 4)->comment('Descuento');
			// $table->float('total', 12, 4)->comment('Total');
			
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
		Schema::dropIfExists('orders');
	}
};
