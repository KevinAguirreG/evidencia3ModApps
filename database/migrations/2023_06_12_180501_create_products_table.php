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
		Schema::create('products', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned()->comment('Cliente');
			$table->foreign('client_id')->references('id')->on('clients');
			$table->string('product_number', 255)->nullable()->comment('Nombre del producto');
			$table->string('name', 255)->comment('Nombre del producto');
			$table->string('description', 255)->nullable()->comment('Descripción del producto');
			$table->string('upc', 255)->comment('UPC');
			$table->string('packing_type', 255)->default("CAJAS")->comment("Tipo de paquete");
			$table->string('capacity', 255)->nullable()->comment("Capacidad");
			$table->integer('pieces')->comment("Piezas por caja");
			$table->integer('department_id')->unsigned()->comment("Departamento");
			$table->foreign('department_id')->references('id')->on('departments');
			$table->float('price', 12, 6)->nullable()->comment('Precio del producto');
			
			$table->string('product_code', 255)->nullable()->comment('ClaveProdServ');
			$table->string('unit_code', 255)->nullable()->comment('ClaveUnidad');
			$table->string('unit', 255)->nullable()->comment('Unidad');
			$table->string('gtin_type', 255)->nullable()->comment('Tipo de GTIN');
			
			$table->integer('tax_id')->unsigned()->comment('Impuesto');
			$table->foreign('tax_id')->references('id')->on('taxes');
			$table->string('tax_type', 255)->nullable()->comment('Tipo de tasa');
			$table->float('tax_rate', 12, 6)->nullable()->comment('Tasa o cuota');
			$table->string('factor_type', 255)->nullable()->comment('Tipo de factor');
			

			
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
		Schema::dropIfExists('products');
	}
};
