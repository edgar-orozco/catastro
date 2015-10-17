
{{DiffFormatter::alias('es_mx', 'es');}}

<ul class="timeline">


    @foreach($tramite->actividades() as $actividad)


        <li class="{{{$ff ? 'timeline-inverted' : ''}}}">

            @if($actividad->tipoActividad && $actividad->tipoActividad->nombre == 'Iniciar trámite')
                <div class="timeline-badge success"><i class="glyphicon glyphicon-record"></i></div>
            @elseif($actividad->tipoActividad && $actividad->tipoActividad->nombre == 'Finalizar trámite')
                <div class="timeline-badge success"><i class="glyphicon glyphicon-thumbs-up"></i></div>
            @elseif($actividad->tipoActividad &&
                ($actividad->tipoActividad->nombre == 'Devolver con observaciones' || $actividad->tipoActividad->nombre == 'Finalizar con observaciones')
            )
                <div class="timeline-badge danger"><i class="glyphicon glyphicon-thumbs-down"></i></div>
            @else
                <div class="timeline-badge info">
                    <i class="glyphicon {{$ff ? 'glyphicon-hand-right' : 'glyphicon-hand-left'}}"></i>
                </div>
            @endif

            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">
                        @if($actividad->departamento)
                            {{$actividad->departamento->descripcion}}
                        @endif
                    </h4>
                    <p>
                        <small class="text-muted">
                            <i class="glyphicon glyphicon-time"></i> {{LocalizedCarbon::instance($actividad->created_at)->diffForHumans()}} el {{$actividad->created_at->format("d M Y H:i")}}</small>
                    </p>

                </div>
                <div class="timeline-body">
                    @if($actividad->tipoActividad)
                        <p>{{$actividad->tipoActividad->presente}}</p>
                    @endif

                    @if($actividad->tipoActividad && mb_strtolower($actividad->tipoActividad->presente) == 'se inicia subtrámite')
                        <p> <a href="{{URL::to('tramites/proceso/'.$actividad->subtramiteAsociado()->id)}}">Ir al trámite asociado</a> </p>
                    @endif
                    @if($actividad->tipoActividad && $actividad->tipoActividad->nombre == 'Iniciar trámite' && $tramite->padre_id)
                        <p>Este trámite es un subtrámite.</p> <p> <a href="{{URL::to('tramites/proceso/'.$tramite->padre_id)}}">Ir al trámite de origen</a> </p>
                    @endif

                    @if($actividad->observaciones)
                        <p>{{ nl2br( e($actividad->observaciones) ) }}</p>
                    @endif
                    @if($actividad->comentarios)
                        <hr>
                        <p>{{ nl2br( e($actividad->comentarios) ) }}</p>
                    @endif
                    @if($actividad->tipoActividad && $actividad->tipoActividad->getter)
                        <hr>
                        <div class="contenido-actividad">
                            <iframe frameborder="0" style="width: 100%;" src="{{URL::to($actividad->tipoActividad->getter)}}?tramite_id={{$tramite->id}}&actividad_id={{$actividad->id or null}}&departamento_id={{ $actividad->departamento->id or null}}" class="iframe-contenido-actividad"></iframe>
                        </div>
                    @endif
                </div>
            </div>
        </li>



    <?php $ff = !$ff ?>
    @endforeach

</ul>