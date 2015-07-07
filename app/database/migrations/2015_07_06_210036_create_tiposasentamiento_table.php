<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposasentamientoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        if(!Schema::hasTable('tiposasentamiento'))
        {
            Schema::create('tiposasentamiento',function(Blueprint $table) {
                $table->increments('id');
                $table->string('descripcion');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiposasentamiento');
    }

}
