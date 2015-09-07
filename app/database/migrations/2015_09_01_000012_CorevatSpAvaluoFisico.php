<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAvaluoFisico extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

--
DROP TRIGGER IF EXISTS avaluo_enfoque_fisico_after ON avaluo_enfoque_fisico;
DROP FUNCTION IF EXISTS avaluo_enfoque_fisico_after();
CREATE FUNCTION avaluo_enfoque_fisico_after() RETURNS TRIGGER AS $$
	BEGIN
		UPDATE avaluo_conclusiones SET valor_fisico = new.total_valor_fisico WHERE idavaluo = new.idavaluo;
		RETURN NULL;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER avaluo_enfoque_fisico_after AFTER INSERT OR UPDATE ON avaluo_enfoque_fisico FOR EACH ROW EXECUTE PROCEDURE avaluo_enfoque_fisico_after();
COMMENT ON FUNCTION avaluo_enfoque_fisico_after() IS '';

EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS avaluo_enfoque_fisico_after ON avaluo_enfoque_fisico;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS avaluo_enfoque_fisico_after();");

	}

}
