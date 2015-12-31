<?php
class CreaDirectorioPrediosCartografiaSeeder extends Seeder {
    public function run()
    {

      

        $carpeta = '/complementarios/predios';
if (!file_exists(public_path() . $carpeta)) {
    mkdir(public_path() .$carpeta, 0777, true);
}
     
    }
}