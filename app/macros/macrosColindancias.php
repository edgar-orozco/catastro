<?php

Form::macro('colindancias', function ($llave) {

    $orientaciones = CatOrientaciones::orderBy('orientacion')->where('status_orientacion', 1)->lists('orientacion', 'idorientacion');

    $colindancia =

        '<br><div class="row">' .
        Form::button('Agregar Colindancia', ['class' => 'btn btn-primary glyphicon glyphicon-plus agregarColindancia', 'type' => 'button']) .
        '</div><br>'.

        '<div class="form-inline" id="colindanciasDiv1">'.
          '<div class="form-group">' .
            Form::button('', ['class' => 'btn btn-primary glyphicon glyphicon-minus quitarColindancia', 'type' => 'button']) .
          '</div>'.

            '<div class="form-group">' .
                   Form::label($llave . '[orientacion]', 'Orientación :') .
                   Form::select($llave . '[orientacion]', $orientaciones, null, ['class' => 'form-control']) .
            '</div>' .
            '<div class="form-group">' .
                  Form::label($llave . '[superficie]', 'Superficie :') .
                  Form::text($llave . '[superficie]', null, ['class' => 'form-control']) .
            '</div>' .
            '<div class="form-group">' .
                 Form::label($llave . '[colindancia]', 'Colindancia :') .
                 Form::text($llave . '[colindancia]', null, ['class' => 'form-control']) .
            '</div>' .

        '</div>';

    $colindancia .= HTML::script('js/macros/colindancias.js');

    return $colindancia;

});
