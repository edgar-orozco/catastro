<div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons" data-requisito="{{$requisito->id}}"
     style="display: none;">
    <label class="btn btn-sm btn-default">
        <input type="radio" class="radio-requisito" name="requisitos[{{$tipotramite->id}}][{{$requisito->id}}]"
               value="1" data-tipotramite="{{$tipotramite->id}}" data-requisito="{{$requisito->id}}"> SI
    </label>
    <label class="btn btn-sm btn-default">
        <input type="radio" class="radio-requisito" name="requisitos[{{$tipotramite->id}}][{{$requisito->id}}]"
               value="0" data-tipotramite="{{$tipotramite->id}}" data-requisito="{{$requisito->id}}"> NO
    </label>
</div>
{{$requisito->nombre}} {{$requisito->pivot->original ? 'original' : ''}}
{{$requisito->pivot->original &&  $requisito->pivot->copias ? ' y ' : ''}}
{{$requisito->pivot->copias ? $requisito->pivot->copias. " ".Lang::choice('messages.copias', $requisito->pivot->copias ) : ''}}
{{$requisito->pivot->certificadas ? Lang::choice('messages.certificadas', $requisito->pivot->copias) : ''}}
