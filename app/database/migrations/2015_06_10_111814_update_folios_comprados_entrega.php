<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFoliosCompradosEntrega extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('folios_comprados', function(Blueprint $table)
		{
			   // Se elimina el campo y se agrega como serial
            if (Schema::hasColumn('folios_comprados', 'id'))
            {
            	$folios_comprados = FoliosComprados::orderBy('id', 'ASC');
            	DB::statement('ALTER TABLE folios_comprados DROP COLUMN entrega_municipal');
            	DB::statement('ALTER TABLE folios_comprados DROP COLUMN entrega_estatal');
            	$table->integer('entrega_municipal')->nullable();
            	$table->integer('entrega_estatal')->nullable();            	 
            }
           
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
