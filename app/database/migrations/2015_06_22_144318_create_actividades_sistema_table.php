<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActividadesSistemaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actividades_sistema', function(Blueprint $table)
		{
			$table->bigIncrements( 'id' );
            $table->integer( 'user_id' );
            $table->string( 'modulo', 255);
            $table->string( 'actividad', 255);
            $table->integer( 'pk_afectada' );
			$table->timestamps('created_at');
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop( 'actividades_sistema' );
	}

}
