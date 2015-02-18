<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNotariaIdTramitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('notarias', function(Blueprint $table)
		{
			$table->primary('id_notaria');
		});

        Schema::table('tramites', function(Blueprint $table)
		{
			$table->integer('notaria_id')->nullable();
			$table->integer('solicitante_id')->nullable();
			$table->string('tipo_solicitante')->nullable();

            $table->foreign('notaria_id')->references('id_notaria')->on('notarias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('solicitante_id')->references('id_p')->on('personas')->onUpdate('cascade')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tramites', function(Blueprint $table)
		{
			$table->dropColumn('tipo_solicitante');
			$table->dropColumn('notaria_id');
			$table->dropColumn('solicitante_id');
		});

        Schema::table('notarias', function(Blueprint $table)
        {
            $table->dropPrimary('id_notaria');
        });

    }

}
