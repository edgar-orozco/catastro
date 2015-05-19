<?php
foreach ($datos_p as $k) {
    $tipo_predio = str_replace('(', '', $k[0]);
    $niveles = $k[1];
    $folio = $k[2];
    $superficie_terreno = $k[3];
    $uso_construccion = str_replace(')', '', $k[4]);
}
?>


{{Form::open(array('url' => 'guardar-predios', 'method' => 'POST', 'name' => 'formPredios', 'id' => 'formPredios'))}}
<div class="panel-body">
    {{Form::text('gid',$gid,['id'=>'gid', "hidden" ])}}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('Ltipo_predio','Tipo Predio')}}   
                {{Form::select('tipo_predio', ['U' => 'Urbano','R' => 'Rustico'], $tipo_predio, ['id'=>'tipo_predio', 'class' => 'form-control focus', 'tabindex'=>'1', 'autofocus'=> 'autofocus','style'=>'width: 250px'])}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('Lniveles','Niveles')}}
                {{Form::number('niveles', $niveles ,['class'=>'form-control bfh-number','required', 'id'=>'niveles', 'min' => '1' , 'tabindex'=>'2','style'=>'width: 250px'])}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('Lfolio','Folio Real')}}
                {{Form::text('folio',$folio,['class'=>'form-control','required', 'id'=>'folio', 'tabindex'=>'3', 'max' =>'50','style'=>'width: 250px'])}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('Lsuperficie_terreno','Superficie Predio')}}
                <br>
                <span style=" margin-left: 154px;"><strong>M<sup>2</sup></strong></span>
                {{Form::text('superficie_terreno',$superficie_terreno,['class'=>'form-control bfh-number','min'=>'0', 'step'=>'any' ,'value' =>'0' ,'pattern'=>'/[-+]?([0-9]*\.[0-9]+|[0-9]+)/','id'=>'superficie_terreno', 'tabindex'=>'4','style'=>'width: 150px;margin-top: -24px;'])}}
               
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('Luso_construccion','Uso de suelo')}}
                {{Form::select('uso_construccion',  $tus, $uso_construccion, ['id'=>'uso_construccion', 'class' => 'form-control', 'tabindex'=>'5','style'=>'width: 200px'])}}

            </div>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary next">
    Siguiente
    <i class="glyphicon glyphicon-chevron-right"></i>
</button>

{{Form::close()}}

@section('javascript')


<script type="text/javascript">

    $('#formPredios').bind('submit', function ()
    {
        $.ajax(
                {
                    type: 'POST',
                    data: new FormData(this), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
                    processData: false,
                    contentType: false,
                    url: '/guardar-predios',
                    success: function (data)
                    {


                    }
                });
        return false;
    });


    $(document).ready(function () {
        $("#niveles").keydown(function (event) {
            if (event.shiftKey)
            {
                event.preventDefault();
            }

            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 189 || event.keyCode == 109) {
            }
            else {
                if (event.keyCode < 95) {
                    if (event.keyCode < 48 || event.keyCode > 57) {
                        event.preventDefault();
                    }
                }
                else {
                    if (event.keyCode < 96 || event.keyCode > 105) {
                        event.preventDefault();
                    }
                }
            }
        });
    });

    $(document).ready(function () {
        $("#superficie_terreno").keydown(function (event) {
            if (event.shiftKey)
            {
                event.preventDefault();
            }

            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 189 || event.keyCode == 109 || event.keyCode == 110 || event.keyCode == 190 || event.keyCode == 45 || event.keyCode == 96 || event.keyCode == 189) {
            }
            else {
                if (event.keyCode < 95) {
                    if (event.keyCode < 48 || event.keyCode > 57) {
                        event.preventDefault();
                    }
                }
                else {
                    if (event.keyCode < 96 || event.keyCode > 105) {
                        event.preventDefault();
                    }
                }
            }
        });
    });


//tabindex
    $('input').on('keydown', function (e) {

        if (e.keyCode === 13)
        {
            // Obtenemos el número del tabindex del campo actual
            var currentTabIndex = $(this).attr('tabindex');
            // Le sumamos 1 :P
            var nextTabIndex = parseInt(currentTabIndex) + 1;
            // Obtenemos (si existe) el siguiente elemento usando la variable nextTabIndex
            var nextField = $('[tabindex=' + nextTabIndex + ']');
            // Si se encontró un elemento:
            if (nextField.length > 0)
            {
                // Hacerle focus / seleccionarlo
                nextField.focus();
                // Ignorar el funcionamiento predeterminado (enviar el formulario)
                e.preventDefault();
            }
            // Si no se encontro ningún elemento, no hacemos nada (se envia el formulario)
        }
    });
</script>

@append


