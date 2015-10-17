@extends('layouts.hooktramite')
@section('content')

    {{ Form::open(array('action' => 'TramitePredioFusionadoController@store', 'method' => 'POST', 'id' => 'form')) }}

    <table class="table" id="predios-agregados">
        <thead>
        <tr>
            <th colspan="3">
                Clave
            </th>

            <th colspan="2">
                Cuenta
            </th>
        </tr>
        <tr>
            <th>
                Zona
            </th>
            <th>
                Manzana
            </th>
            <th>
                Predio
            </th>

            <th>
                Tipo
            </th>

            <th>
                Cuenta
            </th>
        </tr>
        </thead>
        <tbody>

           <tr data-pk="1" class="fila-predio">
                <td>
                    {{Form::input('text','predios[1][zona]',null, ['size'=>'4','maxlength'=>'3', 'pattern'=>'\d{1,3}', 'required'=>true,'title'=>'Favor de ingresar sólo números'])}}
                </td>

                <td>
                    {{Form::input('text','predios[1][manzana]',null, ['size'=>'5','maxlength'=>'4', 'pattern'=>'\d{1,4}', 'required'=>true,'title'=>'Favor de ingresar sólo números'])}}
                </td>
               <td>
                   {{Form::input('text','predios[1][predio]',null, ['size'=>'7','maxlength'=>'6', 'pattern'=>'\d{1,6}', 'required'=>true,'title'=>'Favor de ingresar sólo números'])}}
               </td>

                <td>
                    {{Form::input('text','predios[1][tipo]',null, ['size'=>'2','maxlength'=>'1', 'pattern'=>'[rR|uU]', 'required'=>true,'title'=>'Favor de ingresar sólo U o R'])}}
                </td>
               <td>
                   {{Form::input('text','predios[1][cuenta]',null, ['size'=>'6','maxlength'=>'5', 'pattern'=>'\d{1,5}', 'required'=>true,'title'=>'Favor de ingresar sólo números'])}}
               </td>
                <td>
                    <button type="button" class="btn btn-warning pull-right borrar-predio" data-pk="1" title="Eliminar datos de predio">
                        <i class="glyphicon glyphicon-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <button type="button" class="btn btn-success pull-right agregar-predio">
                        <i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Agregar predio</button>
                </td>
            </tr>
        </tfoot>
    </table>

    <input type="hidden" name="tramite_id" value="{{$tramite_id}}">
    <input type="hidden" name="tipoactividad_id" value="{{$tipoactividad_id}}">
    <input type="hidden" name="departamento_id" value="{{$departamento_id}}">

    <button type="submit" class="btn btn-success guardar-predios">
        <i class="glyphicon glyphicon-save"></i>&nbsp; Guardar</button>

    {{Form::close()}}
@stop

@section('javascript')
    <script>

        $(function () {


            var setFilas = function() {

                //Boton borrar construccion, si solo queda un registro en la tabla no lo elimina sino que lo limpia.
                $("tbody tr:last > td:last > button").on('click', function (ev) {
                    ev.preventDefault();
                    var pk = $(this).closest('tr').data('pk');
                    console.log("Se pidio borrar %s", pk);
                    var bloque_id = $(this).closest('tr').find('.bloque-id').text();
                    var bloques = $('.fila-predio').length;
                    if (!confirm('Ha presionado el botón para no agregar este predio. ¿Desea continuar con esta acción?')) return false;
                    if (bloques == 1) {
                        $("tr[data-pk=" + pk + "]").find('input').val(null);
                    }
                    else {
                        $("tr[data-pk=" + pk + "]").remove();
                    }
                    return false;
                });

            }

            //Boton agregar predio
            $('.agregar-predio').click(function(ev){
                ev.preventDefault();
                //Tomamos la primera fila editable y la clonamos
                var randomID = new Date().getTime();
                var trs = $('tbody > :first-child');
                var tr = $(trs).clone();
                $(tr).attr('data-pk',randomID);

                $(tr).find('input').each(function(){
                    $(this).val(null);
                    var nombre = $(this).attr('name');
                    nombre = nombre.replace("[1]",'['+randomID+']');
                    $(this).attr('name',nombre);
                });

                $('tbody').append(tr);
                $('#predios-agregados').trigger('predio-agregado',[randomID]);
                return false;
            });

            $('#predios-agregados').on('predio-agregado', function(ev, id){
                setFilas();
            });


            setFilas();



        });

    </script>
@append