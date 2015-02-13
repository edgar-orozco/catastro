<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearInpc extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('inpc',function(Blueprint $table)
            {            
                $table->increments('id_inpc');
                $table->integer('mes');
                $table->integer('anio');
                $table->float('inpc');
                $table->integer('usuario');
                $table->date('f_modificacion');
                $table->date('f_alta');
                $table->timestamps();
            }
                    );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('inpc');
	}

}
