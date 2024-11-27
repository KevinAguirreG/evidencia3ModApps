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
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->comment('Producto');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('inventory_id')->unsigned()->comment('Inventario');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->timestamp('move_date')->nullable()->comment('Fecha del movimiento');
            $table->float('amount')->comment('Cantidad de producto que hay');
            $table->float('delta_amount')->comment('Cantidad de producto que se movió');
            $table->integer('movement_type_id')->unsigned()->comment('Movimiento');
            $table->foreign('movement_type_id')->references('id')->on('movement_types');
            

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
        Schema::dropIfExists('inventory_logs');
    }
};