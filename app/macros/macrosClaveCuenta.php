<?php
/**
 * Este macro provee de un control con input mask para formato de clave catastral o cuenta catastral
 */
Form::macro('claveCuenta', function ($tipo=null) {

    $out = '';
    $out .= HTML::script('js/jquery/jquery.mask.min.js');
    $out .= HTML::script('js/macros/controlClaveCuenta.js');
    $out .= <<<EoF

    <!-- Inputs de clave o cuenta -->
        <div class="control-clave-cuenta">
            <div class="form-group">
                <div class="input-group">

                    <!-- Select clave o cuenta -->
                    <div class="input-group-btn">
                        <button type="button"
                                class="btn btn-default dropdown-toggle"
                                data-tipobusqueda="cuenta"
                                data-toggle="dropdown" aria-expanded="false">
                            <span class="dropdown-label">Cuenta</span>
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu tipo-busqueda" role="menu">
                            <li><a href="javascript:void(0);" class="opcion-buqueda" data-tipo="cuenta">Cuenta</a>
                            </li>
                            <li><a href="javascript:void(0);" class="opcion-busqueda" data-tipo="clave">Clave</a></li>
                        </ul>
                    </div>
EoF;
    $out .= Form::text('clave', null, ['class'=>'form-control clave-catastral', 'style'=>'text-transform: uppercase;'] );
    $out .= <<<EoF
                </div>
            </div>
        </div>
    <!-- //Inputs de clave o cuenta -->
EoF;

    return $out;
});
