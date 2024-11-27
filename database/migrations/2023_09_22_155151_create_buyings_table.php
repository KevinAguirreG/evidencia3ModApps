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
        Schema::create('buyings', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->float('subtotal', 10, 2)->nullable()->comment('Subtotal');
            $table->float('iva', 10, 2)->nullable()->comment('IVA');
            $table->float('total', 10, 2)->nullable()->comment('Total');
            $table->integer('buying_status_id')->unsigned()->default(1)->comment('Estatus de la compra');
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
        //Schema::dropIfExists('buyings');
        Schema::table('buyings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
