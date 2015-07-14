<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeritoUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perito_usuarios', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer( 'user_id' );
            $table->integer( 'perito_id');
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
            $table->foreign( 'perito_id' )->references( 'id' )->on( 'peritos' );
            $table->unique( array( 'user_id', 'perito_id' ) );
            $table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('perito_usuarios');
	}

}
