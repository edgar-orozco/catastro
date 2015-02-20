<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Condominios extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('condominios', function($table) {
            $table->increments('id_condominio');
            $table->integer('id_propietarios');
            $table->string('entidad', 255);
            $table->string('municipio', 255);
            $table->string('clave', 255);
            $table->integer('no_condominal');
            $table->string('tipo_priva', 255);
            $table->integer('sup_comun');
            $table->integer('indiviso');
            $table->integer('sup_comun_magno');
            $table->integer('indiviso_magno');
            $table->string('cve_magno', 255);
            $table->integer('sup_total_comun');
            $table->integer('no_unidades');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('condominios');
    }

}
