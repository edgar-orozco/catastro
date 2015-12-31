<?php
class CreaDirectorioPrediosCartografiaSeeder extends Seeder {
    public function run()
    {

      

        $carpeta = '/ResultadoCartografia/predios';
if (!file_exists(public_path() . $carpeta)) {
    mkdir(public_path() .$carpeta, 0777, true);
}
     
    }
}