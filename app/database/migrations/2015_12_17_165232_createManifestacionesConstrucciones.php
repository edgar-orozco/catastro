<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManifestacionesConstrucciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('manifestaciones_construcciones', function(Blueprint $table)
		{
			$table->dropColumn(['muros', 'tipo_construccion', 'techos', 'pisos', 'puertas', 'ventanas', 'inst_especiales', 'edo_construccion', 'uso_construccion']);

			$table->integer('muro_id')->unsigned()->nullable();
			$table->foreign('muro_id')->references('id')->on('mtiposmurosconstruccion')->onDelete('cascade');

			$table->integer('techo_id')->unsigned()->nullable();
			$table->foreign('techo_id')->references('id')->on('mtipostechosconstruccion')->onDelete('cascade');

			$table->integer('piso_id')->unsigned()->nullable();
			$table->foreign('piso_id')->references('id')->on('mtipospisosconstruccion')->onDelete('cascade');

			$table->integer('puerta_id')->unsigned()->nullable();
			$table->foreign('puerta_id')->references('id')->on('mtipospuertasconstruccion')->onDelete('cascade');

			$table->integer('ventana_id')->unsigned()->nullable();
			$table->foreign('ventana_id')->references('id')->on('mtiposventanasconstruccion')->onDelete('cascade');

			$table->integer('inst_especiales_id')->unsigned()->nullable();
			$table->foreign('inst_especiales_id')->references('id')->on('mtiposinstalacionesespeciales')->onDelete('cascade');

			$table->integer('edo_construccion_id')->unsigned()->nullable();
			$table->foreign('edo_construccion_id')->references('id')->on('mtiposestadosconservacion')->onDelete('cascade');

			$table->integer('uso_construccion_id')->unsigned()->nullable();
			$table->foreign('uso_construccion_id')->references('id')->on('mtiposusosconstruccion')->onDelete('cascade');

			$table->integer('tipo_construccion_id')->unsigned()->nullable();
			$table->foreign('tipo_construccion_id')->references('id')->on('mtipos_construccion')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('manifestaciones_construcciones', function(Blueprint $table)
		{
            $table->dropForeign('manifestaciones_construcciones_muro_id_foreign');
            $table->dropForeign('manifestaciones_construcciones_techo_id_foreign');
            $table->dropForeign('manifestaciones_construcciones_tipo_construccion_id_foreign');
            $table->dropForeign('manifestaciones_construcciones_piso_id_foreign');
            $table->dropForeign('manifestaciones_construcciones_puerta_id_foreign');
            $table->dropForeign('manifestaciones_construcciones_ventana_id_foreign');
            $table->dropForeign('manifestaciones_construcciones_inst_especiales_id_foreign');
            $table->dropForeign('manifestaciones_construcciones_edo_construccion_id_foreign');
            $table->dropForeign('manifestaciones_construcciones_uso_construccion_id_foreign');
            $table->dropColumn(['tipo_construccion_id', 'muro_id', 'techo_id', 'piso_id', 'puerta_id', 'ventana_id', 'inst_especiales_id', 'edo_construccion_id', 'uso_construccion_id']);
            $table->string('muros');
            $table->string('pisos');
            $table->string('puertas');
            $table->string('techos');
            $table->string('ventanas');
            $table->string('inst_especiales');
            $table->string('edo_construccion');
            $table->string('uso_construccion');
		});
	}

}
