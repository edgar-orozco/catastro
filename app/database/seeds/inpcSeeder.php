<?php
class inpcSeeder extends Seeder {
    public function run()
    {
      DB::table('inpc')->delete();
      //$usuario =Auth::user()->id;
      $usuario = null;
      DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2009,'inpc'=>92.4544696, 'usuario'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2009,'inpc'=>92.65858923, 'usuario'=>$usuario)
                );
      
      DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2009,'inpc'=>93.19164488701, 'usuario'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2009,'inpc'=>93.51782254, 'usuario'=>$usuario)
                );
      DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2009,'inpc'=>93.245433168061, 'usuario'=>$usuario)
                );
      DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2009,'inpc'=>93.417141911415, 'usuario'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2009,'inpc'=>93.671601856385, 'usuario'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2009,'inpc'=>93.895719694096, 'usuario'=>$usuario)
                );
      DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2009,'inpc'=>94.366711949963, 'usuario'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2009,'inpc'=>94.65220359554, 'usuario'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2009,'inpc'=>95.143194058464, 'usuario'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2009,'inpc'=>95.536951859488, 'usuario'=>$usuario )
                );

       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2010,'inpc'=>96.575479439774, 'usuario'=>$usuario )
                );

       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2010,'inpc'=>97.134050050685, 'usuario'=>$usuario )
                );
       
       DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2010,'inpc'=>97.823643397489, 'usuario'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2010,'inpc'=>97.511947204733, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2010,'inpc'=>96.897519532732, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2010,'inpc'=>96.867177425472, 'usuario'=>$usuario )                
                );
       DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2010,'inpc'=>97.077503396247, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2010,'inpc'=>97.347134394847, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2010,'inpc'=>97.857433471482, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2010,'inpc'=>98.461517243282, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2010,'inpc'=>99.250412032025, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2010,'inpc'=>99.742092088296, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2011,'inpc'=>100.228, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2011,'inpc'=>100.604, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2011,'inpc'=>100.797, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2011,'inpc'=>100.789, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2011,'inpc'=>100.046, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2011,'inpc'=>100.041, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2011,'inpc'=>100.521, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2011,'inpc'=>100.68, 'usuario'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2011,'inpc'=>100.927, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2011,'inpc'=>101.608, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2011,'inpc'=>102.707, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2011,'inpc'=>103.551, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2012,'inpc'=>104.284, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2012,'inpc'=>104.496, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2012,'inpc'=>104.556, 'usuario'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2012,'inpc'=>104.228, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2012,'inpc'=>103.899, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2012,'inpc'=>104.378, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2012,'inpc'=>104.964, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2012,'inpc'=>105.279 , 'usuario'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2012,'inpc'=>105.743 , 'usuario'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2012,'inpc'=>106.278 , 'usuario'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2012,'inpc'=>107 , 'usuario'=>$usuario)                
                );
       
       
       DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2012,'inpc'=>107.246 , 'usuario'=>$usuario)                
                );
       
       
       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2013 ,'inpc'=>107.678, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2013 ,'inpc'=>108.208, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2013 ,'inpc'=>109.002, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2013 ,'inpc'=>109.074, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2013 ,'inpc'=>108.711, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2013 ,'inpc'=>108.645, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2013 ,'inpc'=>108.608999999999, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2013 ,'inpc'=>108.918, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2013 ,'inpc'=>109.328, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2013 ,'inpc'=>109.848, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2013 ,'inpc'=>110.872, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2013 ,'inpc'=>111.508, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2014 ,'inpc'=>112.505, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2014 ,'inpc'=>112.79, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2014 ,'inpc'=>113.099, 'usuario'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2014 ,'inpc'=>112.888, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2014 ,'inpc'=>112.527, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2014 ,'inpc'=>112.721999999999, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2014 ,'inpc'=>113.032, 'usuario'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2014 ,'inpc'=>113.438, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2014 ,'inpc'=>113.938999999999, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2014 ,'inpc'=>114.569, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2014 ,'inpc'=>115.492999999999, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2014 ,'inpc'=>116.059, 'usuario'=>$usuario )                
                );

       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2015 ,'inpc'=>115.954, 'usuario'=>$usuario )                
                );

       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2015 ,'inpc'=>116.174, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2015 ,'inpc'=>116.647, 'usuario'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2015 ,'inpc'=>116.345, 'usuario'=>$usuario )                
                );

       DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2015 ,'inpc'=>115.764, 'usuario'=>$usuario )                
                );

      DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2015 ,'inpc'=>115.958, 'usuario'=>$usuario )                
                );

      DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2015 ,'inpc'=>116.128, 'usuario'=>$usuario )                
                );
    }
}
