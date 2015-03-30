<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDepartamentosTramitesAddAlias extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('departamentos_tramites', function(Blueprint $table)
        {
            //Alias del departamento, lo usamos como llave comun para las consultas.
            $table->string('alias')->nullable();
            //Tipo de unidad (Departamento, Direccion, Subdireccion, etc)
            $table->string('tipo')->nullable();
            //Descripcion o nombre completo del area administrativa
            $table->string('descripcion')->nullable();
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('departamentos_tramites', function(Blueprint $table)
        {
            $table->dropColumn('alias');
            $table->dropColumn('descripcion');
            $table->dropColumn('tipo');
        });

	}

}
