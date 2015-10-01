<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClavesCobro2 extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('claves_cobros', function(Blueprint $table) {
            $table->increments('id_tipocobro');
            $table->string('tipocobro');
            $table->string('nombre');
            $table->string('referencia');
            $table->string('observacion');
            $table->string('folio');
            $table->string('no_licencia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //   Schema::dropIfExists('traslados');
        Schema::dropIfExists('claves_cobros');
    }

}
