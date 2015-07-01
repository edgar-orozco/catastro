<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotariaUsuaarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notaria_usuario', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer( 'user_id' );
            $table->integer( 'notaria_id');
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
            $table->foreign( 'notaria_id' )->references( 'id_notaria' )->on( 'notarias' );
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
		Schema::drop('notaria_usuario');
	}

}
