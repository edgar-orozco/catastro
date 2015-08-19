<?php
Form::macro('notaria', function($id_notaria)
{
    $datos_notaria = Notaria::

    join('municipios', 'notarias.municipio', '=', 'municipios.municipio' )
    ->join('entidades', 'notarias.entidad', '=', 'entidades.entidad' )
    ->join('personas', 'notarias.id_notario', '=', 'personas.id_p' )
    ->select('entidades.nom_ent', 'municipios.nombre_municipio', 'notarias.nombre','notarias.correo', 'notarias.domicilio', 'notarias.telefono','personas.nombres','personas.apellido_paterno','personas.apellido_materno')
    ->where('id_notaria', $id_notaria)->get();

   $municipio=$datos_notaria[0]->nombre_municipio;
   $entidad=$datos_notaria[0]->nom_ent;
   $notaria=$datos_notaria[0]->nombre;
   $domicilio=$datos_notaria[0]->domicilio;
   $telefono=$datos_notaria[0]->telefono;
   $correo=$datos_notaria[0]->correo;
   $nombre_n=$datos_notaria[0]->nombres.' '.$datos_notaria[0]->apellido_paterno.' '.$datos_notaria[0]->apellido_materno;
    $notarias='
    <div class="row">
    <div class="col-md-6">'.
    Form::label($id_notaria . '[notaria]', 'Datos Notaría: '.$notaria .' de '.'  '.$municipio.',  '.$entidad ) .
    '</div>'.
    ' <div class="col-md-6">'.
     Form::label($id_notaria . '[notaria]', 'Nombre Notario: '.$nombre_n ) .
    '</div>'.
    '<div class="col-md-12">'.
    Form::label($id_notaria . '[notaria]', 'Dirección de la notaría: '.$domicilio) .
    '</div>'.
    '<div class="col-md-6">'.
    Form::label($id_notaria . '[notaria]', 'Número telefónico: '.$telefono) .
    '</div>'.
    '<div class="col-md-6">'.
    Form::label($id_notaria . '[notaria]', 'Email: '.$correo) .
    '</div>
    </div>';
   // var_dump($datos_notaria);
   return $notarias;
});