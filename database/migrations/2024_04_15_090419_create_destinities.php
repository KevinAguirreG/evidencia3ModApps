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
        Schema::create('destinities', function (Blueprint $table) {
            $table->increments('id');
			$table->string('description', 255)->nullable()->comment('Descripción');
			$table->string('name', 45)->comment('Nombre del destino');
			$table->integer('orders_quantity')->comment('Cantidad de órdenes que pueden ser asignadas al destino');
			$table->integer('warehouse_id')->unsigned()->comment('Nave');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
			$table->string('address', 255)->nullable()->comment('Dirección del destino');
			$table->string('telephone', 12)->nullable()->comment('Número de teléfono');
            $table->string('contact', 255)->nullable()->comment('Persona con la que se comunica con el destino');

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
        Schema::dropIfExists('destinities');
    }
};
