<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAemInformacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

--
DROP TRIGGER IF EXISTS aem_informacion_after ON aem_informacion;
DROP FUNCTION IF EXISTS aem_informacion_after();
CREATE FUNCTION aem_informacion_after() RETURNS TRIGGER AS $$
	BEGIN
		IF ( TG_OP = 'INSERT' ) THEN
			INSERT INTO aem_analisis (idavaluoenfoquemercado, idaeminformacion, created_at) 
			VALUES(new.idavaluoenfoquemercado, new.idaeminformacion, new.created_at);
		ELSIF (TG_OP = 'UPDATE') THEN
		END IF;
		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aem_informacion_after AFTER INSERT OR UPDATE ON aem_informacion FOR EACH ROW EXECUTE PROCEDURE aem_informacion_after();
COMMENT ON FUNCTION aem_informacion_after() IS '';

EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aem_informacion_after ON aem_informacion;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aem_informacion_after();");

	}

}
