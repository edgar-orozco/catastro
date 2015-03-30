


<ul class="timeline">


    @foreach($tramite->actividades() as $actividad)

        @if(!$actividad->tipoActividad)
            <li class="{{{$ff ? 'timeline-inverted' : ''}}}">
                <div class="timeline-badge info"><i class="glyphicon {{$ff ? 'glyphicon-hand-right' : 'glyphicon-hand-left'}}"></i></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">
                            @if($actividad->departamento)
                                {{$actividad->departamento->descripcion}}
                            @endif

                        </h4>
                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{$actividad->created_at->format("d M Y H:i")}}</small></p>
                    </div>
                    <div class="timeline-body">



                    </div>
                </div>
            </li>

        @elseif($actividad->tipoActividad && $actividad->tipoActividad->nombre == 'Iniciar trámite')

            <li class="{{{$ff ? 'timeline-inverted' : ''}}}">
                <div class="timeline-badge success"><i class="glyphicon glyphicon-record"></i></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">
                            @if($actividad->departamento)
                                {{$actividad->departamento->descripcion}}
                            @endif
                        </h4>
                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{$actividad->created_at->format("d M Y H:i")}}</small></p>
                    </div>
                    <div class="timeline-body">
                        <p>{{$actividad->tipoActividad->presente}}</p>
                        <p>{{$actividad->observaciones}}</p>

                    </div>
                </div>
            </li>



        @elseif($actividad->tipoActividad && $actividad->tipoActividad->nombre == 'Finalizar trámite')
            <li class="">
                <div class="timeline-badge success"><i class="glyphicon glyphicon-thumbs-up"></i></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">
                            @if($actividad->departamento)
                                {{$actividad->departamento->descripcion}}
                            @endif
                        </h4>
                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{$actividad->created_at->format("d M Y H:i")}}</small></p>
                    </div>
                    <div class="timeline-body">

                        <p>{{$actividad->tipoActividad->presente}}</p>

                    </div>
                </div>
            </li>

        @elseif($actividad->tipoActividad &&
        ($actividad->tipoActividad->nombre == 'Devolver con observaciones' || $actividad->tipoActividad->nombre == 'Finalizar con observaciones')
        )

            <li class="">
                <div class="timeline-badge danger"><i class="glyphicon glyphicon-thumbs-down"></i></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">
                            @if($actividad->departamento)
                                {{$actividad->departamento->descripcion}}
                            @endif
                        </h4>
                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{$actividad->created_at->format("d M Y H:i")}}</small></p>
                    </div>
                    <div class="timeline-body">
                        <p>{{$actividad->tipoActividad->presente}}</p>
                        <p>{{$actividad->observaciones}}</p>

                    </div>
                </div>
            </li>

        @else

            <li class="{{{$ff ? 'timeline-inverted' : ''}}}">
                <div class="timeline-badge info"><i class="glyphicon {{$ff ? 'glyphicon-hand-right' : 'glyphicon-hand-left'}}"></i></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">
                            @if($actividad->departamento)
                                {{$actividad->departamento->descripcion}}
                            @endif

                        </h4>
                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{$actividad->created_at->format("d M Y H:i")}}</small></p>
                    </div>
                    <div class="timeline-body">

                        <p>
                            @if($actividad->tipoActividad)
                                {{$actividad->tipoActividad->presente}}
                            @endif
                        </p>

                    </div>
                </div>
            </li>


        @endif

    <?php $ff = !$ff ?>
    @endforeach

</ul>