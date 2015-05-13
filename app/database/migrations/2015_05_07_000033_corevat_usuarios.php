<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('usuarios', function(Blueprint $table) {
			$table->increments('iduser');
			$table->string('username', 20);
			$table->string('password', 60);
			$table->string('apellidos', 100);
			$table->string('nombres', 100);
			$table->string('registro', 15);
			$table->string('especialidad', 50);
			$table->string('nombre', 100);
			$table->string('domicilio', 150);
			$table->string('colonia', 100);
			$table->string('municipio', 50);
			$table->string('estado', 20);
			$table->string('otrostel', 100);
			$table->string('teloficina', 50);
			$table->string('telpersonal', 50);
			$table->string('telfax', 50);
			$table->string('correoelectronico', 100);
			$table->integer('idmunicipio');
			$table->integer('idestado');
			$table->string('cedulaprofesional', 20);
			$table->string('registro_colegio', 20);
			
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			$table->string('foto', 100);
			
			$table->integer('p1')->default(0);
			$table->integer('p2')->default(0);
			$table->integer('p3')->default(0);
			$table->integer('p4')->default(0);
			$table->integer('p5')->default(0);
			$table->integer('p6')->default(0);
			$table->integer('p7')->default(0);
			$table->integer('p8')->default(0);
			$table->integer('p9')->default(0);
			$table->integer('p10')->default(0);
			
			$table->integer('p11')->default(0);
			$table->integer('p12')->default(0);
			$table->integer('p13')->default(0);
			$table->integer('p14')->default(0);
			$table->integer('p15')->default(0);
			$table->integer('p16')->default(0);
			$table->integer('p17')->default(0);
			$table->integer('p18')->default(0);
			$table->integer('p19')->default(0);
			$table->integer('p20')->default(0);
			
			$table->integer('p21')->default(0);
			$table->integer('p22')->default(0);
			$table->integer('p23')->default(0);
			$table->integer('p24')->default(0);
			$table->integer('p25')->default(0);
			$table->integer('p26')->default(0);
			$table->integer('p27')->default(0);
			$table->integer('p28')->default(0);
			$table->integer('p29')->default(0);
			$table->integer('p30')->default(0);
			
			$table->integer('p31')->default(0);
			$table->integer('p32')->default(0);
			$table->integer('p33')->default(0);
			$table->integer('p34')->default(0);
			$table->integer('p35')->default(0);
			$table->integer('p36')->default(0);
			$table->integer('p37')->default(0);
			$table->integer('p38')->default(0);
			$table->integer('p39')->default(0);
			$table->integer('p40')->default(0);
			
			$table->integer('p41')->default(0);
			$table->integer('p42')->default(0);
			$table->integer('p43')->default(0);
			$table->integer('p44')->default(0);
			$table->integer('p45')->default(0);
			$table->integer('p46')->default(0);
			$table->integer('p47')->default(0);
			$table->integer('p48')->default(0);
			$table->integer('p49')->default(0);
			$table->integer('p50')->default(0);
			
			$table->integer('idper')->default(0);
			$table->integer('idemp')->default(1);
			$table->integer('idusernivelacceso')->default(1);
			$table->integer('status_usuario')->default(0);
			$table->integer('totalregistrosporpagina')->default(7);
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('idmunicipio')->references('idmunicipio')->on('municipios')->onUpdate('cascade');
			$table->foreign('idusernivelacceso')->references('idusernivelacceso')->on('usuarios_niveldeacceso')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS usuarios CASCADE;");
	}

}
