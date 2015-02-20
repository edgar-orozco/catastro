
<table border="1"  id="myTable" class="tablesorter">
     <thead>
        <tr>   
                <th width="500">Clave Catastral</th>
                <th width="700">Dato 2</th>
                <th width="700">Dato 3</th>
                <th width="500">Dato 4</th>
                <th width="700">Dato 5</th>
                <th width="700">Dato 6</th>
                <th width="500">Dato 7</th>   
        </tr>
    </thead>
    <tbody>
        <tr>
       <?php 
		
        
	//	$val= trim( $val,'');
		//print_r($vale);
		//$vale= substr($val, 1);
		
?>
           @foreach ($vale as $key  )     
           
            <td> 
               <?php $val= str_replace('(', '',$key[0]);?>
            	{{$calve=$val;}}
                
            </td>
            <td>
                <?php $val2= str_replace('"', '',$key[1]); ?>
            	{{$mun=$val2;}}
            </td>
            <td>
                
                {{$mun=$key[2];}}
            </td>
            <td>
                <?php $val3= str_replace('"', '',$key[3]); ?>
                {{$mun=$val3;}}
            </td>
            <td>
                <?php $val4= str_replace('"', '',$key[4]); ?>
                {{$mun=$val4;}}
            </td>
            <td>
                
                {{$mun=$key[5];}}
            </td>
            <td>
                <?php $val1= str_replace(')', '',$key[6]); ?>
                {{$mun=$val1;}}
            </td>
        </tr>
        @endforeach
  
        </tr>
    </tbody>
    </table><?php //echo $busqueda->links(); ?>