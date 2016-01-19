<table class="table datatable" id="WebServiceI">
      <thead>
        <tr>
          
          <!--<th>{{Form::checkbox('', '', '', ['id'=>'todos'])}}</th>-->
          <th>Volante</th>
          <th>Nombre</th>
          <th>Fecha de Rececion:</th>
          <th>Tipo de Tramite</th>
          <th>Tramite:</th>
          <th>Resultado</th>
          <th>Estado del Tramite</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td align="center"> 
              {{ $content->volante }}
            </td>

          
            
            <td align="center">
              {{ $content->nombre }}

            </td>
  

            <td align="center">
              {{ $content->fecha_recepcion }}
            </td>


            <td align="center">
              {{ $content->tipo_tram }}
            </td>


            <td align="center">
             {{ $content->tramite }}
            </td>


            <td align="center">
              {{ $content->result }}
            </td>

             <td align="center">
              {{ $content->status }}
            </td>
            
          </tr>
      </tbody>
    </table>