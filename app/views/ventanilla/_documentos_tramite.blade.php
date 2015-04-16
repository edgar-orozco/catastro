@if(count($documentos))
<table class="table table-responsive">
    @foreach($documentos as $doc)
        <tr>
            <td>
                <a href="{{$doc->documento->path."/".$doc->documento->archivo}}" target="_blank">
                    <span class="glyphicon glyphicon-file"></span> &nbsp;
                    {{$doc->documento->descripcion}}
                </a>
            </td>
            <td align="right">
                <a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn-borrar" data-documento_id="{{$doc->id}}">
                    <span class="glyphicon glyphicon-trash danger"></span>
                </a>
            </td>
        </tr>
    @endforeach
</table>
@else
    {{ Form::file('documento['.$requisito->id.']', ['class'=>'form-control upload-inputs', 'data-requisito_id'=>$requisito->id]) }}
    {{Form::hidden('requisito_ids[]',$requisito->id) }}
@endif

