<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAvaluoMercado extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

--
DROP TRIGGER IF EXISTS avaluo_enfoque_mercado_before ON avaluo_enfoque_mercado;
DROP FUNCTION IF EXISTS avaluo_enfoque_mercado_before();
CREATE FUNCTION avaluo_enfoque_mercado_before() RETURNS TRIGGER AS $$
	BEGIN
		new.valor_comparativo_mercado = new.superficie_construida * new.promedio_analisis;
		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER avaluo_enfoque_mercado_before BEFORE INSERT OR UPDATE ON avaluo_enfoque_mercado FOR EACH ROW EXECUTE PROCEDURE avaluo_enfoque_mercado_before();
COMMENT ON FUNCTION avaluo_enfoque_mercado_before() IS '';

--
DROP TRIGGER IF EXISTS avaluo_enfoque_mercado_after ON avaluo_enfoque_mercado;
DROP FUNCTION IF EXISTS avaluo_enfoque_mercado_after();
CREATE FUNCTION avaluo_enfoque_mercado_after() RETURNS TRIGGER AS $$
	BEGIN
		UPDATE avaluo_conclusiones SET valor_mercado = new.valor_comparativo_mercado WHERE idavaluo = new.idavaluo;
		RETURN NULL;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER avaluo_enfoque_mercado_after AFTER INSERT OR UPDATE ON avaluo_enfoque_mercado FOR EACH ROW EXECUTE PROCEDURE avaluo_enfoque_mercado_after();
COMMENT ON FUNCTION avaluo_enfoque_mercado_after() IS '';

EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS avaluo_enfoque_mercado_after ON avaluo_enfoque_mercado;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS avaluo_enfoque_mercado_after();");

		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS avaluo_enfoque_mercado_after ON avaluo_enfoque_mercado;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS avaluo_enfoque_mercado_after();");

	}

}
