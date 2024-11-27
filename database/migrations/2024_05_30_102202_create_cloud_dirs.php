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
        Schema::create('cloud_dirs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cloud_dir_id')->nullable()->unsigned()->comment('Carpeta');
            
            $table->smallInteger('user_id')->unsigned()->comment('Usuario dueño');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->string('name', 45)->comment('Nombre de la carpeta');
			$table->string('url', 255)->comment('Ruta relativa de la carpeta');

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

        Schema::table('cloud_dirs',function (Blueprint $table){
            $table->foreign('cloud_dir_id')->references('id')->on('cloud_dirs')->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cloud_dirs');
    }
};