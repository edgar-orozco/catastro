<div class="col-md-6">
    <table class="table">
        <thead>
        <tr>
            <th>VALORES</th>
            <th>TERRENO</th>
            <th>CONSTRUCCIÓN</th>
        </tr>
        </thead>
        <tr>
            <td>Valor</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Menos Demérito</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Más Incrementos</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>V. Ajustado</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>CATASTRAL</td>
            <td></td>
            <td></td>
        </tr>

    </table>

    <div class="form-actions form-group col-md-6" style="clear:both; ">
        {{ Form::submit('Realizar Valuación', array('class' => 'btn btn-primary', 'id'=>'btn-sumbit-valor')) }}
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
    


