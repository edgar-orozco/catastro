<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRegistroEscrituras extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registro_escrituras', function(Blueprint $table)
        {
            $table->foreign( 'dir_enajenante_id' )->references( 'id' )->on( 'domicilios' )->nullable();
       			$table->integer('dir_adquiriente_id');
       			$table->foreign( 'dir_adquiriente_id' )->references( 'id' )->on( 'domicilios' )->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
