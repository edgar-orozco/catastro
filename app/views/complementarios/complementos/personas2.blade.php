<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script language="javascript">
            $(document).ready(function () {
                $().ajaxStart(function () {
                    $('#loading').show();
                    $('#result').hide();
                }).ajaxStop(function () {
                    $('#loading').hide();
                    $('#result').fadeIn('slow');
                });
                $('#form, #fat, #fo4').submit(function () {
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function (data) {
                            $('#result').text("Datos Creado Correctamente");
                            $('#reset').click();
                            $('#cerrar').click();
                            $('#response2').val(data.id_p);
                        }
                    })

                    return false;
                });
            });
            $("#cerrar").click(function (event) {
                $('#reset').click();
            });

            $('#fo4').on('submit', function () {
                var Value = $("#nombres").val();
                var appa = $("#apellido_paterno").val();
                var apma = $("#apellido_materno").val();
                $('#personasp').val(Value + " " + appa + " " + apma);
                $('#cerrar').click();
                
            });
        </script>
       
    </head>

    <body>
        <div class="modal-header">
            <h4 class="modal-titulo" id="condominio-titulo">Personas</h4>
        </div>
        {{ Form::open(array('id'=>'fo4','name'=>'fo4')) }}
        <div style="margin-left: 14px;margin-right: 14px;">
            <div class="form-group">
                {{Form::label('nombres','Nombressssss')}}
                {{Form::text('nombres', null, ['tabindex'=>'1','class'=>'form-control','autofocus'=> 'autofocus', 'ng-model' => 'personas.nombres','onblur'=>'aMayusculas(this.value,this.id)'] )}}
                {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
                <p class="help-block"></p>
            </div>
            
            <div class="form-group">
                {{Form::label('apellido_paterno','Apellido Paterno')}}
                {{Form::text('apellido_paterno', null, ['tabindex'=>'2','class'=>'form-control','autofocus'=> 'autofocus', 'ng-model' => 'personas.apellido_paterno','onblur'=>'aMayusculas(this.value,this.id)'] )}}
                {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
                <p class="help-block"></p>
            </div>

            <div class="form-group">
                {{Form::label('apellido_materno','Apellido Materno')}}
                {{Form::text('apellido_materno', null, ['tabindex'=>'3','class'=>'form-control','autofocus'=> 'autofocus', 'ng-model' => 'personas.apellido_materno','onblur'=>'aMayusculas(this.value,this.id)'] )}}
                {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
                <p class="help-block"></p>
            </div>
            
            <div class="form-group">
                {{Form::label('rfc','RFC')}}
                {{Form::text('rfc', null, ['tabindex'=>'4','class'=>'form-control','autofocus'=> 'autofocus','ng-model' => 'personas.rfc','onblur'=>'ValidaRfc(this.value),aMayusculas(this.value,this.id)','pattern'=>'^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$'] )}}
                {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
                <p class="help-block"></p>
            </div>

            <div class="form-group">
                {{Form::label('curp','CURP')}}
                {{Form::text('curp', null, ['tabindex'=>'5','class'=>'form-control','autofocus'=> 'autofocus','ng-model' => 'personas.curp','onblur'=>'aMayusculas(this.value,this.id)','pattern'=>'^[a-zA-Z]{4}\d{6}[a-zA-Z]{6}\d{2}$'] )}}
                {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
                <p class="help-block"></p>
            </div>
            
            <div class="form-actions form-group">
                {{ Form::submit('Guardar nombre', array('class' => 'btn btn-primary','id'=>'guardar','tabindex'=>'6')) }} 
                {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning','id'=>'reset']) }}
                <button class="btn btn-danger" type="button" id="cerrar" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                {{Form::close()}}
            </div>
        </div>
        <!--<div id="result"></div>-->
    </body>
</html>
