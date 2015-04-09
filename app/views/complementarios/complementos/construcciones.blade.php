
<div class="panel-body">
    {{ Form::open(array('url' => 'guardar-construccion', 'method' => 'POST', 'name' => 'formConstruccion', 'id' => 'formConstruccion')) }}

        {{Form::text('gid',$gid,['id'=>'gid', "hidden" ])}}
        {{Form::text('estado',$estado,['id'=>'estado', "hidden" ])}}
        {{Form::text('municipio',$municipio,['id'=>'municipio', "hidden" ])}}
        {{Form::text('clave_cata',$clave_catas,['id'=>'clave_cata', "hidden" ])}}

        <div class="row">
        <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lnivel','Nivel:')}}
                    {{Form::text('nivel',null,['class'=>'form-control', 'required', 'id'=>'nivel' ])}}
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lsuperficie_construccion', 'Superficie:')}}
                    {{Form::text('superficie_construccion', null, ['id'=>'superficie_construccion','class'=>'form-control'])}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Ledad_construccion','Edad:')}}
                    {{Form::text('edad_construccion', null, ['id'=>'edad_construccion','class'=>'form-control'])}}
                </div>
            </div>
            
           
            
            
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Luso_construccion','Uso:')}}
                    {{Form::select('uso_construccion', $tuc, ['seleccione'], ['id'=>'uso_construccion', 'class' => 'form-control'])}}
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lclase_construccion', 'Clase:')}}
                    {{Form::select('clase_construccion', $tcc, null, ['id'=>'clase_construccion', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Ltecho_construccion','Techo:')}}
                    {{Form::select('techo_construccion', $ttc, null, ['id'=>'techo_construccion', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lestado_conservacion','Estado:')}}
                    {{Form::select('estado_conservacion', $tec, null, ['id'=>'estado_conservacion', 'class' => 'form-control'])}}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lmuro_construccion','Muros:')}}
                    {{Form::select('muro_construccion', $tmc, null, ['id'=>'muro_construccion', 'class' => 'form-control'])}}
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lpiso_construccion', 'Pisos:')}}
                    {{Form::select('piso_construccion', $tpic, null, ['id'=>'piso_construccion', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lpuerta_construccion','Puertas:')}}
                    {{Form::select('puerta_construccion', $tpuc, null, ['id'=>'puerta_construccion', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lventana_construccion','Ventanas:')}}
                    {{Form::select('ventana_construccion', $tvc, null, ['id'=>'ventana_construccion', 'class' => 'form-control'])}}
                </div>
            </div>
               
                
                
        </div>
        <button type="submit" class="btn btn-primary next">
            Siguiente
            <i class="glyphicon glyphicon-chevron-right"></i>
        </button>
    {{Form::close()}}
</div>


@section('javascript')


<script type="text/javascript">

$('#formConstruccion').bind('submit',function () 
    {   
        $.ajax(
        {
            type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            processData: false,
            contentType: false,
            url: '/guardar-construccion',
            beforeSend: function()
            {
                alert("mandando petición");
            },
            success: function (data) 
            {               
                alert("guardado correcto");
                
               
            


            }
        });
        return false;
    });

</script>

@append
