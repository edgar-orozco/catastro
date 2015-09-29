
<div class="form-horizontal">
    <div class="form-group">
            {{Form::label('manifestacion[estatus_fiscal]','Estatus')}}
            {{Form::select('manifestacion[estatus_fiscal]', [null => '']+$listaEstatusFiscal, null, ['class'=>'form-control select2 select-manifestacion-estatus-fiscal'] )}}
            {{$errors->first('manifestacion[estatus_fiscal]', '<span class=text-danger>:message</span>')}}
    </div>
</div>

<div class="form-inline">
    <div class="form-group">
        {{Form::label('manifestacion[inc_terreno]','Incremento en terreno')}}
        <div class="input-group">
            {{Form::text('manifestacion[inc_terreno]', null, [
                'class' => 'form-control',
                'maxlength'=>'5',
                'size'=>'6',
                ]
            )}}
            <span class="input-group-addon">%</span>
        </div>
        {{$errors->first('manifestacion[inc_terreno]', '<span class=text-danger>:message</span>')}}


        {{Form::label('manifestacion[valor_terreno]','Valor terreno')}}
        {{Form::text('manifestacion[valor_terreno]', null, [
            'class' => 'form-control',
            'maxlength'=>'18',
            'size'=>'10',
            ]
        )}}
        {{$errors->first('manifestacion[valor_terreno]', '<span class=text-danger>:message</span>')}}
    </div>
</div>

<div class="form-inline">
    <div class="form-group">
        {{Form::label('manifestacion[dem_terreno]','Demérito en terreno')}}
        <div class="input-group">
            {{Form::text('manifestacion[dem_terreno]', null, [
                'class' => 'form-control',
                'maxlength'=>'5',
                'size'=>'6',
                ]
            )}}
            <span class="input-group-addon">%</span>
        </div>
        {{$errors->first('manifestacion[dem_terreno]', '<span class=text-danger>:message</span>')}}


        {{Form::label('manifestacion[valor_construccion]','Valor construcción')}}
        {{Form::text('manifestacion[valor_construccion]', null, [
            'class' => 'form-control',
            'maxlength'=>'18',
            'size'=>'10',
            ]
        )}}
        {{$errors->first('manifestacion[valor_construccion]', '<span class=text-danger>:message</span>')}}
    </div>
</div>

<div class="form-inline">
    <div class="form-group">
        {{Form::label('manifestacion[dem_construccion]','Demérito en construcción')}}
        <div class="input-group">
            {{Form::text('manifestacion[dem_construccion]', null, [
                'class' => 'form-control',
                'maxlength'=>'5',
                'size'=>'6',
                ]
            )}}
            <span class="input-group-addon">%</span>
        </div>
        {{$errors->first('manifestacion[dem_construccion]', '<span class=text-danger>:message</span>')}}


        {{Form::label('manifestacion[cat_total]','C. Cat. Total')}}
        {{Form::text('manifestacion[cat_total]', null, [
            'class' => 'form-control',
            'maxlength'=>'18',
            'size'=>'10',
            ]
        )}}
        {{$errors->first('manifestacion[cat_total]', '<span class=text-danger>:message</span>')}}
    </div>
</div>

<div class="form-inline">
    <div class="form-group">

        {{Form::label('manifestacion[semestre_valuacion]','Semestre de revaluación')}}
        {{Form::text('manifestacion[semestre_valuacion]', null, [
            'class' => 'form-control',
            'maxlength'=>'18',
            'size'=>'10',
            ]
        )}}
        {{$errors->first('manifestacion[semestre_valuacion]', '<span class=text-danger>:message</span>')}}

        {{Form::label('manifestacion[semestre_alta]','Semestre de alta')}}
        {{Form::text('manifestacion[semestre_alta]', null, [
            'class' => 'form-control',
            'maxlength'=>'18',
            'size'=>'10',
            ]
        )}}
        {{$errors->first('manifestacion[semestre_alta]', '<span class=text-danger>:message</span>')}}
    </div>
</div>

