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
        Schema::create('buying_rows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buying_id')->unsigned()->comment('Compras');
            $table->foreign('buying_id')->references('id')->on('buyings');
            $table->integer('product_id')->unsigned()->comment('Producto');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('barcode')->comment('Código de barras del producto comprado / UPC');
            $table->string('zamexco_code')->comment('Clave única del producto en Zamexco / últimos 5 dígitos del UPC');
            $table->float('amount', 10, 2)->comment('Cantidad que se compró');
            $table->float('price', 10, 2)->comment('Costo de la compra');
            $table->float('total', 10, 2)->comment('Total del producto');
            $table->integer('buying_status_id')->unsigned()->default(1)->comment('Estatus del row');
            $table->foreign('buying_status_id')->references('id')->on('buying_statuses');
            

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
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('buying_rows');
        Schema::table('buying_rows', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
