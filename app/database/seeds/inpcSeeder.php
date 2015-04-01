<?php
class inpcSeeder extends Seeder {
    public function run()
    {
      DB::table('inpc')->delete();
      $usuario =Auth::user()->id;  
      DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2009,'inpc'=>92.4544696, 'user'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2009,'inpc'=>92.65858923, 'user'=>$usuario)
                );
      
      DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2009,'inpc'=>93.19164488701, 'user'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2009,'inpc'=>93.51782254, 'user'=>$usuario)
                );
      DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2009,'inpc'=>93.245433168061, 'user'=>$usuario)
                );
      DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2009,'inpc'=>93.417141911415, 'user'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2009,'inpc'=>93.671601856385, 'user'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2009,'inpc'=>93.895719694096, 'user'=>$usuario)
                );
      DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2009,'inpc'=>94.366711949963, 'user'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2009,'inpc'=>94.65220359554, 'user'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2009,'inpc'=>95.143194058464, 'user'=>$usuario)
                );

      DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2009,'inpc'=>95.536951859488, 'user'=>$usuario )
                );

       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2010,'inpc'=>96.575479439774, 'user'=>$usuario )
                );

       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2010,'inpc'=>97.134050050685, 'user'=>$usuario )
                );
       
       DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2010,'inpc'=>97.823643397489, 'user'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2010,'inpc'=>97.511947204733, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2010,'inpc'=>96.897519532732, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2010,'inpc'=>96.867177425472, 'user'=>$usuario )                
                );
       DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2010,'inpc'=>97.077503396247, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2010,'inpc'=>97.347134394847, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2010,'inpc'=>97.857433471482, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2010,'inpc'=>98.461517243282, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2010,'inpc'=>99.250412032025, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2010,'inpc'=>99.742092088296, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2011,'inpc'=>100.228, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2011,'inpc'=>100.604, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2011,'inpc'=>100.797, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2011,'inpc'=>100.789, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2011,'inpc'=>100.046, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2011,'inpc'=>100.041, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2011,'inpc'=>100.521, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2011,'inpc'=>100.68, 'user'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2011,'inpc'=>100.927, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2011,'inpc'=>101.608, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2011,'inpc'=>102.707, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2011,'inpc'=>103.551, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2012,'inpc'=>104.284, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2012,'inpc'=>104.496, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2012,'inpc'=>104.556, 'user'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2012,'inpc'=>104.228, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2012,'inpc'=>103.899, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2012,'inpc'=>104.378, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2012,'inpc'=>104.964, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2012,'inpc'=>105.279 , 'user'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2012,'inpc'=>105.743 , 'user'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2012,'inpc'=>106.278 , 'user'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2012,'inpc'=>107 , 'user'=>$usuario)                
                );
       
       
       DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2012,'inpc'=>107.246 , 'user'=>$usuario)                
                );
       
       
       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2013 ,'inpc'=>107.678, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2013 ,'inpc'=>108.208, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2013 ,'inpc'=>109.002, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2013 ,'inpc'=>109.074, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2013 ,'inpc'=>108.711, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2013 ,'inpc'=>108.645, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2013 ,'inpc'=>108.608999999999, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2013 ,'inpc'=>108.918, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2013 ,'inpc'=>109.328, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2013 ,'inpc'=>109.848, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2013 ,'inpc'=>110.872, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2013 ,'inpc'=>111.508, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2014 ,'inpc'=>112.505, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2014 ,'inpc'=>112.79, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 3,'anio' => 2014 ,'inpc'=>113.099, 'user'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 4,'anio' => 2014 ,'inpc'=>112.888, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 5,'anio' => 2014 ,'inpc'=>112.527, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 6,'anio' => 2014 ,'inpc'=>112.721999999999, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 7,'anio' => 2014 ,'inpc'=>113.032, 'user'=>$usuario)                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 8,'anio' => 2014 ,'inpc'=>113.438, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 9,'anio' => 2014 ,'inpc'=>113.938999999999, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 10,'anio' => 2014 ,'inpc'=>114.569, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 11,'anio' => 2014 ,'inpc'=>115.492999999999, 'user'=>$usuario )                
                );
       
       DB::table('inpc')->insert(
            array('mes' => 12,'anio' => 2014 ,'inpc'=>116.059, 'user'=>$usuario )                
                );

       DB::table('inpc')->insert(
            array('mes' => 1,'anio' => 2015 ,'inpc'=>115.954, 'user'=>$usuario )                
                );

       DB::table('inpc')->insert(
            array('mes' => 2,'anio' => 2015 ,'inpc'=>116.174, 'user'=>$usuario )                
                );

    }
}
