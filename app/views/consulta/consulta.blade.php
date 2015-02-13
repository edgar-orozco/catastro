
<table border="1"  id="myTable" class="tablesorter">
     <thead>
        <tr>
               
                <th width="500">Clave Catastral</th>
                <th width="700">Id Municipio</th>
               
        </tr>
    </thead>
    <tbody>
        <tr>
       <?php 
		
        
	//	$val= trim( $val,'');
		//print_r($val);
		//$vale= substr($val, 1);
		
?>
           @foreach ($vale as $key  )     
           
            <td> 

            	{{$calve=$key[0];}}
                
            </td>
            <td>
            	{{$mun=$key[1];}}
            </td>
            
        </tr>
        @endforeach
  
        </tr>
    </tbody>
    </table><?php //echo $busqueda->links(); ?>