@extends('layouts.default')

@section
@section('javascript')

<!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
{{ HTML::script('js/jquery/jquery.min.js') }}
{{ HTML::script('js/jquery/jquery-ui.js') }}

<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
<script>
    $(document).ready(function () {

        var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allSiguienteBtn = $('.next');


        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                    $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allSiguienteBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-primary').trigger('click');

    });
</script>
<script>
    $(document).ready(function () {
        $("form").submit(function () {
        });
    });
</script>


@stop
@section('content')
    <style type="text/css">
        #map-canvas {
            height: 30%;
            margin: 0px;
            padding: 0px
        }

        .body{ 
            margin-top:40px; 
        }
       

        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;

        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
        </style>
<div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Datos Complementarios</div>

          <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Clave</th>
                <th>Entidad</th>
                <th>Municipio</th>
                <th>Propietario</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach($predios as $predio)
                <th scope="row">{{$predio->clave_catas}}</th>
                <td>{{$predio->nom_ent}}</td>
                <td>{{$predio->nombre_municipio }}</td>
                <?php $clave=$predio->entidad.'-'.$predio->municipio.'-'.$predio->clave_catas ?>
                <td><?php $propietarios = DB::select("select sp_get_propietarios('$clave')"); 
                foreach ($propietarios as $keys) {
               $propie = explode(',', $keys->sp_get_propietarios);
               echo $propie[0];
                }?></td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
    
    <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Predios</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Construcciones</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>Instalaciones Especiales</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    <p>Condominios</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                    <p>Servicios</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
                    <p>Giro</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-7" type="button" class="btn btn-default btn-circle" disabled="disabled">7</a>
                    <p>Persona entrevistada</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-7" type="button" class="btn btn-default btn-circle" disabled="disabled">7</a>
                    <p>Anexos</p>
                </div>
            </div>
        </div>

    <div style="float: right;margin-top: -7px;margin-right: -66px;">
        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15179.10423749334!2d-92.83543432609864!3d17.989152844348357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2smx!4v1423185076690" width="600" height="450" frameborder="0" style="border:0"></iframe>-->  
    </div>
    <div class="container">

        <div class="row setup-content" id="step-1">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3>Predios</h3>
                     @include('complementarios.complementos.predios')


                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3>Construcciones</h3>
                    @include('complementarios.complementos.construcciones')
                    <button type="button" class="btn btn-primary next">
                        Siguiente
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>

                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-3">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3>Instalaciones Especiales</h3>
                    @include('complementarios.complementos.instalaciones')
                    <button type="button" class="btn btn-primary next">
                        Siguiente
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-4">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3>Condominios</h3>
                    @include('complementarios.complementos.condominio')

                    <button type="button" class="btn btn-primary next">
                        Siguiente
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-5">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3>Servicios</h3>
                    @include('complementarios.complementos.servicio')
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-6">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3>Giros</h3>
                    @include('complementarios.complementos.giros')
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-7">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3> Persona entrevistada</h3>
                    @include('complementarios.complementos.personaEntrevistada')
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-7">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3> Anexo</h3>
                    @include('complementarios.cargar.cargaArchivos')
                </div>
            </div>
        </div>
    </div>
    @stop
