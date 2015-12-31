<?php
class CreaDirectorioPrediosCartografiaSeeder extends Seeder {
    public function run()
    {

       $dir = '/complementarios/predios/';
        if ( !is_dir(public_path() . $dir)) 
        {
            File::makeDirectory(public_path() . $dir, $mode = 0777, true, true);
        }

     
    }
}