<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('descripcion')->nullable();
			$table->string('archivo');
			$table->string('path');
			$table->decimal('size',10,2);
			$table->string('mimetype');
			$table->integer('documentable_id');
			$table->string('documentable_type');

			$table->timestamps();
		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * 	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documentos');
	}

}
