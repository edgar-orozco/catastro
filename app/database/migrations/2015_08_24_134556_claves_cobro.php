<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClavesCobro extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::table('claves_cobros', function(Blueprint $table)
        {
            $table->increments('id_tipocobro');
            $table->string('nombre_tramite');
            $table->string('referencia');
            $table->string('folio');
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
