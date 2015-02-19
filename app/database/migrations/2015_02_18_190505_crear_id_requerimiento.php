<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearIdRequerimiento extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('requerimientos', function(Blueprint $table){
         DB::statement('ALTER TABLE requerimientos ADD COLUMN id_requerimiento SERIAL');
       });
    }
	

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
