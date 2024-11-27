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
        Schema::create('product_reorders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->comment('Producto');
            $table->foreign('product_id')->references('id')->on('products');
            $table->float('minimum_reserve_amount')->comment('Cantidad minima de reservación');
            $table->float('delta_per_month')->comment('Desviacíon delta por mes');;
            $table->timestamp('reorder_time')->comment('Tiempo que se vuelve a hacer la orden'); //Duda aquí
            $table->float('variance')->comment('Varianza');

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
        Schema::dropIfExists('product_reorders');
    }
};
