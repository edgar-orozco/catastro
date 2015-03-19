<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class EntidadesTableSeeder extends Seeder {

	public function run()
	{
		

		// Uncomment the below to wipe the table clean before populating
    	// DB::table('entidades')->delete();

		function csv_to_array($filename='', $delimiter='|')
			{
			    if(!file_exists($filename) || !is_readable($filename))
			        return FALSE;
			 
			    $header = NULL;
			    $data = array();
			    if (($handle = fopen($filename, 'r')) !== FALSE)
			    {
			        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
			        {
			            if(!$header)
			                $header = $row;
			            else
			                $data[] = array_combine($header, $row);
			        }
			        fclose($handle);
			    }
			    return $data;
			}

			/****************************************
			* CSV FILE SAMPLE *
			****************************************/
			// gid|entidad|nom_ent|geom
			// 1|01|Aguascalientes|01000000
			// 2|02|Aguascalientes|01000600
			 
			$csvFile = public_path().'/sources/entidades.csv';

			$entidades = csv_to_array($csvFile);


        // Uncomment the below to run the seeder
        DB::table('entidades')->insert($entidades);

	}

}