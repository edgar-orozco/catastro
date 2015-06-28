<?php

Form::macro('colindancias', function ($llave, $JsonColindancias) {

    $orientaciones = CatOrientaciones::orderBy('orientacion')->where('status_orientacion', 1)->lists('orientacion', 'orientacion');

    $js = '<script> var JsonColindancias ='. $JsonColindancias .' </script>';

    $colindancia =

        $js.
        '<br><div class="row">' .
            Form::button('<i class="glyphicon glyphicon-plus"></i> Agregar Colindancia', ['class' => 'btn btn-success agregarColindancia', 'type' => 'button']) .
        '</div><br>'.

        '<div id="divsColindancias">'.
        '<div class="form-inline" id="colindanciaDiv1">'.
            '<div class="form-group">' .
                   Form::label($llave . '[1][orientacion]', 'Orientación :') .
                   Form::select($llave . '[1][orientacion]', $orientaciones, null, ['class' => 'form-control', 'required'=>true]) .
            '</div>' .
            '<div class="form-group">' .
                  Form::label($llave . '[1][superficie]', 'Superficie :') .
                  Form::text($llave . '[1][superficie]', null, ['class' => 'form-control', 'required'=>true]) .
            '</div>' .
            '<div class="form-group">' .
                 Form::label($llave . '[1][colindancia]', 'Colindancia :') .
                 Form::text($llave . '[1][colindancia]', null, ['class' => 'form-control', 'required'=>true]) .
            '</div>' .

            '<div class="form-group">' .
                Form::button('<i class="glyphicon glyphicon-trash"></i>', ['class' => 'btn btn-warning quitarColindancia', 'type' => 'button', 'title'=>'Eliminar colindancia']) .
            '</div>'.
        '</div>'.
        '</div>';

    $colindancia .= HTML::script('js/macros/colindancias.js');

    return $colindancia;

});
