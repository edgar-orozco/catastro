<style>
    table.resumen-valor td.sumable {
        text-align: right;
    }
    table.resumen-valor td.listable {
        text-align: left;
    }
    table.resumen-valor tr.totalizable{

    }
</style>
<div class="col-md-6">
    <table class="table resumen-valor">
        <thead>
        <tr>
            <th>VALORES</th>
            <th>TERRENO</th>
            <th>CONSTRUCCIÓN</th>
        </tr>
        </thead>
        <tr>
            <td class="listable">Valor</td>
            <td class="sumable valor-terreno"></td>
            <td class="sumable valor-construccion"></td>
        </tr>
        <tr>
            <td class="listable">Menos Demérito</td>
            <td class="sumable dem-terreno"></td>
            <td class="sumable dem-construccion"></td>
        </tr>
        <tr>
            <td class="listable">Más Incrementos</td>
            <td class="sumable inc-terreno"></td>
            <td class="sumable inc-construccion"></td>
        </tr>
        <tr>
            <td class="listable">V. Ajustado</td>
            <td class="sumable vajust-terreno"></td>
            <td class="sumable vajust-construccion"></td>
        </tr>
        <tfoot>
            <tr class="totalizable">
                <td class="listable">CATASTRAL</td>
                <td colspan="2" class="valor-catastral"></td>

            </tr>
        </tfoot>
    </table>

    <div class="form-actions form-group col-md-6" style="clear:both; ">
        {{ Form::submit('Realizar Valuación', array('class' => 'btn btn-primary', 'id'=>'btn-actualizar-valor')) }}
        {{ Form::submit('Guardar', array('class' => 'btn btn-primary', 'id'=>'btn-sumbit-valor')) }}
        {{ Form::submit('Imprimir', array('class' => 'btn btn-primary', 'id'=>'btn-sumbit-valor')) }}
    </div>

</div>

<div class="col-md-6">
    <div class="form-group">
        {{Form::label('observaciones','OBSERVACIONES')}}
        {{Form::textarea('observaciones', null, ['class' => 'form-control'])}}
        {{$errors->first('observaciones', '<span class=text-danger>:message</span>')}}
    </div>
</div>
    


