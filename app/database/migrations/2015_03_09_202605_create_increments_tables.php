<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIncrementsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('salario_minimo', function(Blueprint $table)
        { 
               // Se eliminan los campos que ya no son requeridos
            if (Schema::hasColumn('salario_minimo', 'id_salario_minimo'))
            {
            	 DB::statement('ALTER TABLE salario_minimo DROP COLUMN id_salario_minimo');
            	 DB::statement('ALTER TABLE salario_minimo ADD COLUMN id_salario_minimo SERIAL');
            }
           
        });

        Schema::table('status', function(Blueprint $table)
        { 
               // Se eliminan los campos que ya no son requeridos
            if (Schema::hasColumn('status', 'id_status'))
            {
            	 DB::statement('ALTER TABLE status DROP COLUMN id_status');
            	 DB::statement('ALTER TABLE status ADD COLUMN id_status SERIAL');
            }
           
        });

        Schema::table('inpc', function(Blueprint $table)
        { 
               // Se eliminan los campos que ya no son requeridos
            if (Schema::hasColumn('inpc', 'id_inpc'))
            {
            	 DB::statement('ALTER TABLE inpc DROP COLUMN id_inpc');
            	 DB::statement('ALTER TABLE inpc ADD COLUMN id_inpc SERIAL');
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
		
	}

}
