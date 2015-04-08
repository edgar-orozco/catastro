  <?php
        $url = URL::current();
        $new = explode("/", $url);
        $count = count($new);
        $count = $count - 1;
        $clave = $new[$count];
        ?>
{{ Form::open (array('url'=>'/agregar-condominio', 'name'=>'construcciones'))}}
    <table class="table">
    <thead>
        <tr>
            <th>Superficie Privativa:</th>
            <th>Superficie Comun:</th>
            <th>Indiviso:</th>
            <th>Superfie Total Común:</th>
            <th> No Unidades:</th>
        </tr>
    </thead>
     <tbody>
<tr>
    <td>
    {{ Form::hidden('id',$clave) }}
    {{ Form::text('tipo_priva', null, array('class' => 'form-control focus  ', 'placeholder'=>'Tipo Priva', 'autofocus'=> 'autofocus')) }}
    </td><td>
    {{ Form::text('sup_comun', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Comun', 'autofocus'=> 'autofocus')) }}
    </td><td>
    {{ Form::text('indiviso', null, array('class' => 'form-control focus  ', 'placeholder'=>'Indiviso', 'autofocus'=> 'autofocus')) }}
    {{$errors->first("indiviso")}}
    </td><td>
    {{ Form::text('sup_total_comun', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Total', 'autofocus'=> 'autofocus')) }}
    </td><td>
   {{ Form::text('no_unidades', null, array('class' => 'form-control focus  ', 'placeholder'=>'No Unidades', 'autofocus'=> 'autofocus')) }}
    </td>
</tr>
</tbody>
</table>

{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
{{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}   
{{ Form::close() }}

<table class="table">
    <thead>
        <tr>
            <th>Numero Condominal</th>
            <th>Superficie Privativa</th>
            <th>Superficie Comun</th>
            <th>Indiviso</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>


        @foreach($condominio as $row)
        <tr>
            <td>{{$row->no_condominal }}</td>
            <td>{{$row->tipo_priva }}</td>
            <td>{{$row->sup_comun }}</td>
            <td>{{$row->indiviso }}</td>
            <td nowrap>
                <a data-toggle="modal" data-target="#condominio-editar"   href="/cargar-condominio-editar/{{$row->id_condominio}}" class="btn btn-warning nuevo" title="Editar">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>

                <!--borrar-->
                <a href="/cargar-condominio-destroy/{{$row->id_condominio}}" class="btn btn-danger nuevo" title="Borrar">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
