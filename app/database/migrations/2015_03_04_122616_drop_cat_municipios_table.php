<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropCatMunicipiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		  if(Schema::hasTable('cat_municipios'))
        {
            Schema::drop('cat_municipios');
        }
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('cat_municipios', function(Blueprint $table)
        {
            //Clave de la entidad
            $table->char('entidad',2);
            //Clave del municipio
            $table->char('municipio',3);
            //Nombre del municipio
            $table->text('nom_mpo');
            //Nombre de la cabecera municipal
            $table->text('nom_cabecera');
            
        });
	}

}
