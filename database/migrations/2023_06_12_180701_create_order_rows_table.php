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
		Schema::create('order_rows', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('order_id')->unsigned()->comment('Venta');
			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
			$table->integer('product_id')->unsigned()->comment('Producto');
			$table->foreign('product_id')->references('id')->on('products');
			$table->string('product_code', 255)->nullable()->comment('Artc');
			$table->string('line', 255)->nullable()->comment('Linea');
			$table->string('stock_number', 255)->nullable()->comment('Nro Stock de Prov');
			$table->string('color', 255)->nullable()->comment('Color');
			$table->string('size', 255)->nullable()->comment('Tamaño');
			$table->integer('amount')->nullable()->comment('Cantidad Pedida');
			$table->string('uom', 255)->nullable()->comment('UOM');
			$table->string('package', 255)->nullable()->comment('paquete');
			$table->float('cost', 12, 6)->nullable()->comment('Cost');
			$table->float('cost_total', 12, 6)->nullable()->comment('Costo Extendí');

			//HEB rows
			$table->string('product_number', 255)->nullable()->comment('Articulo');
			$table->string('provider_number', 255)->nullable()->comment('Descripcion');
			$table->string('description', 255)->nullable()->comment('Capac.');
			$table->string('capacity', 255)->nullable()->comment('Capac.');
			$table->string('units_casepack', 255)->nullable()->comment('U. por CasePack');
			$table->string('total_casepack', 255)->nullable()->comment('Tot. PedidoCasepack');
			$table->string('pieces', 255)->nullable()->comment('Tot. Pedido Unidades');
			$table->string('price_limit_date', 255)->nullable()->comment('Precio Lista Vigente');
			
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
		Schema::dropIfExists('order_rows');
	}
};
