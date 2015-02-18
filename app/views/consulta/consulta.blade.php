
<table border="1"  id="myTable" class="tablesorter">
     <thead>
        <tr>
               
                <th width="500">Clave Catastral</th>
                <th width="700">Id Municipio</th>
                <th width="700">Clave Ori</th>
               
        </tr>
    </thead>
    <tbody>
        <tr>
       <?php 
		
        
	//	$val= trim( $val,'');
		print_r($vale);
		//$vale= substr($val, 1);
		
?>
           @foreach ($vale as $key  )     
           
            <td> 
               <?php $val= str_replace('(', '',$key[0]);?>
            	{{$calve=$val;}}
                
            </td>
            <td>
                
            	{{$mun=$key[1];}}
            </td>
            <td>
                <?php $val1= str_replace(')', '',$key[2]); ?>
                {{$mun=$val1;}}
            </td>
        </tr>
        @endforeach
  
        </tr>
    </tbody>
    </table><?php //echo $busqueda->links(); ?>