<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es"><head>
 <meta http-equiv="Content-Script-Type" content="text/javascript">

 <title>DGCEF-Tabasco</title>

    <link rel="shortcut icon" href="/mapper/images/favicon.png" type="image/png">

    {{ HTML::script('/mapper/javascript/jquery_merged.js') }}
    {{ HTML::script('/mapper/javascript/custom.js') }}
    {{ HTML::script('/js/jquery/jquery-ui.js') }}
    {{ HTML::script('/mapper/javascript/zoombox.js') }}
    {{ HTML::script('/mapper/javascript/pm.map.js') }}
    {{ HTML::script('/mapper/javascript/pm.pmapper.js') }}

    {{ HTML::style('/js/jquery/jquery-ui.css') }}
    {{ HTML::style('/mapper/templates/default.css') }}
    {{ HTML::style('/mapper/templates/layout.css') }}
    {{ HTML::style('/mapper/templates/jquery.treeview.css') }}
    {{ HTML::style('/mapper/templates/toc.css') }}
    {{ HTML::style('css/bootstrap.css') }}

    {{ HTML::style('/mapper/templates/dialog.css') }}
    <!--[if lt IE 7]>
    {{ HTML::style('/mapper/templates/ie6.css') }}
    <![endif]-->
 

 {{ HTML::style('/mapper/templates/custom.css') }}


    <script type="text/javascript">
        PM.msVersion = '<?php echo ms_GetVersion() ?>';

        var SID = '';
        var PM_XAJAX_LOCATION  = '/cartografia/xajax/';

        PM.mapW = 600;
        PM.mapH = 500;
        PM.refW = 197;
        PM.refH = 91;
        PM.extent = [313761.97060415,1891919.6349885,784318.26239461,2077443.6209991];
        PM.s1 = 1402386;
        PM.s2 = 1000;

        PM.dgeo_x = 366225.7561717;
        PM.dgeo_y = 185523.98601058;
        PM.dgeo_c = 1;

        PM.layerAutoRefresh = 1;
        PM.tbThm = 'default';
        PM.activeLayer = ['manzanas','predios','construcciones','entidades','municipios','localidades','carreteras','calles','rios','hipsografico'];

        // Query layers: modify query results in js
        PM.modifyQueryResultsFunctions = [];

	$(document).ready(function() {
        var mrgH = 6;
        var mrgV = 6;
        var lcW = 220;
        var barH = 32;
        $('#uiLayoutRoot').css({position:'absolute',  top:76, bottom:10, left:10, right:10});
        $('#uiLayoutEast').css({position:'absolute', width:0});
        $('#uiLayoutWest').css({position:'absolute', left:0, width:lcW, height:'100%', 'margin-right':mrgH});
        $('#uiLayoutNorth').css({position:'absolute', top:0, height:barH, 'margin-bottom':mrgV, 'right':-1});
        $('#uiLayoutNorthWest').css({position:'absolute', top:0, height:barH, width:lcW, 'margin-bottom':mrgV, 'margin-right':mrgH});
        $('#uiLayoutSouth').css({position:'absolute', bottom:0, height:barH, 'margin-top':mrgV+2, 'right':-1});
        $('#uiLayoutSouthWest').css({position:'absolute', bottom:0, height:barH, width:lcW, 'margin-top':mrgV+2, 'margin-right':mrgH});
        $('#toc, #toclegend, #tocconsult').css({top:10});   // make some space for tabs


        resizeContainers();

        $(window).resize(function(){
            resizeContainers();
        });        

        $('#uiLayoutCenter').bind('resize', function(){
            PM.Layout.resizeMapZone();
        });

    var icons = {
      header: "ui-icon-circle-arrow-e",
      activeHeader: "ui-icon-circle-arrow-s"
    };
    $( "#consulta" ).accordion({
      icons: icons,
      heightStyle: "content"
    });


 	});

        function resizeContainers() {
            //var rootElem = $(window);
            var rootElem = $('#uiLayoutRoot'); 
            var rootH = rootElem.height();
            var rootW = rootElem.width();
            var northH = $('#uiLayoutNorth').outerHeight({margin:true, border:true});
            var southH = $('#uiLayoutSouth').outerHeight({margin:true});
            var heightRefMap = $('#refmap').height();
            var topToc = 16;
            
            var mH = rootH - northH - southH;
            var heightToc = mH-heightRefMap-topToc;
            
            $('#uiLayoutCenter').css({position:'absolute'})
                                .height(mH)
                                .width(rootW - $('#uiLayoutWest').outerWidth({margin:true}) - $('#uiLayoutEast').outerWidth({margin:true}) - 1);
            $('#uiLayoutCenter').css('top',northH);                                
            $('#uiLayoutCenter').css('left', $('#uiLayoutWest').outerWidth({margin:true}));

            $('#uiLayoutWest').height(mH).css('top',northH);
            $('#uiLayoutNorth, #uiLayoutSouth').css('left',$('#uiLayoutWest').outerWidth({margin:true}));
            $('#toc').height(heightToc);

            PM.Layout.resizeMapZone();
            $('#loading').hidev();
                                
        }
        
    
	</script>

</head>

<body>

<!-- ======================= ADAPT START ======================== -->

<div class="ui-layout-header" id="uiLayoutHeader">
        <div class="logos">
            <div class="img-cont estatal">
                <img src="/mapper/images/logos/estado-logo.png" alt="Estado"/>
            </div>
            <div class="img-cont spf">
                <img src="/mapper/images/logos/logo-spf.png" alt="SPF"/>
            </div>
            <div class="img-cont catastro">
                <img src="/css/images/main/logo-header.png" alt="Catastro">
            </div>
        </div>

        Sistema Catastral y Registral del Estado de Tabasco
</div>

<div class="ui-layout-root" id="uiLayoutRoot" style="position: absolute; top: 76px; bottom: 10px; left: 10px; right: 10px;">
    
<div class="ui-layout-north-west" id="uiLayoutNorthWest" style="position: absolute; top: 0px; height: 32px; width: 220px; margin-bottom: 6px; margin-right: 6px;">
  <ul class="pm-tabs">
    <li style="width: 32%;">
      <div id="tocCapas" class="pm-tabs-selected">
        Capas
      </div>
    </li>
    <li style="width: 32%;">
      <div id="tocConsultas">
        Consultas
      </div>
    </li>
  </ul>
</div>

    <div class="ui-layout-north" id="uiLayoutNorth" style="position: absolute; top: 0px; height: 32px; margin-bottom: 6px; right: -1px; left: 228px;">
        <div style="float:left; margin-left: 5px; margin-top: 5px">
            <a href="{{URL::to('/')}}"> <img src="/mapper/images/buttons/default/home_off.gif" alt="Menú Principal" title="Menú Principal"/></a>
        </div>
        <div style="float:left; margin-left: 5px; margin-top: 5px">
            &nbsp
        </div>
        <div style="float:left; margin-left: 5px; margin-top: 5px">
            <a href="{{URL::to('/users/logout')}}"> <img src="/mapper/images/buttons/default/exit_off.png" alt="Salir" title="Salir del Sistema"/></a>
        </div>
   </div>
    
    <div class="ui-layout-west" id="uiLayoutWest" style="position: absolute; left: 0px; width: 220px; height: 509px; margin-right: 6px; top: 40px;">
        <!-- Legend/TOC -->
        Capas de Información
        <div id="tocContainer">
              <form id="layerform" method="get" action="">
                <!-- Capas -->    
                <div id="toc" class="TOC treeview" style="height: 402px; top: 10px; overflow: auto;">
                <ul>
                    <li id="licat_cat_catastro" class="toccat open">
                        <div class="toccat-hitarea open-hitarea collapsable-hitarea"></div>
                        <span class="vis cat-label" id="spxg_cat_catastro">Límites Catastrales</span>
                        <ul>
                            <li id="ligrp_Manzanas" class="tocgrp">
                                <div class="tocgrp-hitarea open-hitarea collapsable-hitarea"></div>
                                <input type="checkbox" class = "gLayer"  name="groupscbx" value="Manzanas" id="gLayer_manzanas" checked/>
                                <span class="vis" > <img src="/mapper/images/legend/Manzanas_i0.png"/> </span>
                                <span class="vis" id="spxg_Manzanas"> <span class="grp-title vis">Manzanas </span> </span>
                            </li>
                            <li id="ligrp_Predios" class="tocgrp">
                                <div class="tocgrp-hitarea open-hitarea collapsable-hitarea"></div>
                                <input type="checkbox" class = "gLayer"  name="groupscbx" value="Predios" id="gLayer_predios" checked/>
                                <span class="vis" > <img src="/mapper/images/legend/Predios_i0.png"/> </span>
                                <span class="vis" id="spxg_Predios"> <span class="grp-title vis">Predios </span> </span>
                            </li>
                            <li id="ligrp_Construcciones" class="tocgrp">
                                <div class="tocgrp-hitarea open-hitarea collapsable-hitarea"></div>
                                <input type="checkbox" class = "gLayer"  name="groupscbx" value="Construcciones" id="gLayer_construcciones" checked/>
                                <span class="vis" > <img src="/mapper/images/legend/Construcciones_i0.png"/> </span>
                                <span class="vis" id="spxg_Construcciones"> <span class="grp-title vis">Construcciones </span> </span>
                            </li>
                        </ul>
                    </li>

                    <li id="licat_cat_admin" class="toccat open ">
                        <div class="toccat-hitarea open-hitarea collapsable-hitarea"></div>
                        <span class="vis cat-label" id="spxg_cat_admin">Límites Administrativos</span>
                        <ul>
                            <li id="ligrp_Entidades" class="tocgrp">
                                <div class="tocgrp-hitarea open-hitarea collapsable-hitarea"></div>
                                <input type="checkbox" class = "gLayer"  name="groupscbx" value="Entidades" id="gLayer_entidades" checked/>
                                <span class="vis" > <img src="/mapper/images/legend/Entidades_i0.png"/> </span>
                                <span class="vis" id="spxg_Entidades"> <span class="grp-title vis">Entidades </span> </span>
                            </li>
                            <li id="ligrp_Municipios" class="tocgrp">
                                <div class="tocgrp-hitarea open-hitarea collapsable-hitarea"></div>
                                <input type="checkbox" class = "gLayer"  name="groupscbx" value="Municipios" id="gLayer_municipios" checked/>
                                <span class="vis" > <img src="/mapper/images/legend/Municipios_i0.png"/> </span>
                                <span class="vis" id="spxg_Municipios"> <span class="grp-title vis">Municipios </span> </span>
                            </li>
                            <li id="ligrp_Localidades" class="tocgrp">
                                <div class="tocgrp-hitarea open-hitarea collapsable-hitarea"></div>
                                <input type="checkbox" class = "gLayer"  name="groupscbx" value="Localidades" id="gLayer_localidades" checked />
                                <span class="vis" > <img src="/mapper/images/legend/Localidades_i0.png"/> </span>
                                <span class="vis" id="spxg_Localidades"> <span class="grp-title vis">Localidades </span> </span>
                            </li>
                        </ul>
                    </li>
                    
                    <li id="licat_cat_infrastructure" class="toccat open">
                        <div class="toccat-hitarea open-hitarea collapsable-hitarea"></div>
                        <span class="vis cat-label" id="spxg_cat_infrastructure">Infraestructura</span>
                        <ul>
                            <li id="ligrp_Carreteras" class="tocgrp">
                                <div class="tocgrp-hitarea open-hitarea collapsable-hitarea"></div>
                                <input type="checkbox" class = "gLayer"  name="groupscbx" value="Carreteras" id="gLayer_carreteras" checked>
                                <span class="vis" > <img src="/mapper/images/legend/Carreteras_i0.png"/> </span>
                                <span class="vis" id="spxg_Carreteras"> <span class="grp-title vis">Carreteras </span> </span>
                            </li>
                            <li id="ligrp_Vialidades" class="tocgrp">
                                <div class="tocgrp-hitarea open-hitarea collapsable-hitarea"></div>
                                <input type="checkbox" class = "gLayer"  name="groupscbx" value="Vialidades" id="gLayer_calles" checked/>
                                <span class="vis" > <img src="/mapper/images/legend/Calles_i0.png"/> </span>
                                <span class="vis" id="spxg_Vialidades"> <span class="grp-title vis">Vialidades </span> </span>
                            </li>
                        </ul>
                    </li>
                    
                    <li id="licat_cat_nature" class="toccat open">
                        <div class="toccat-hitarea open-hitarea collapsable-hitarea"></div>
                        <span class="vis cat-label" id="spxg_cat_nature">Recursos naturales</span>
                        <ul>
                            <li id="ligrp_Rios" class="tocgrp">
                                <div class="tocgrp-hitarea open-hitarea collapsable-hitarea"></div>
                                <input type="checkbox" class = "gLayer"  name="groupscbx" value="Rios" id="gLayer_rios" checked/>
                                <span class="vis" > <img src="/mapper/images/legend/rivers_i0.png"/> </span>
                                <span class="vis" id="spxg_Rios"> <span class="grp-title vis">Rios </span> </span>
                            </li>
                            <li id="ligrp_Hipso" class="tocgrp">
                                <div class="tocgrp-hitarea open-hitarea collapsable-hitarea"></div>
                                <input type="checkbox" class = "gLayer"  name="groupscbx" value="Hipso" id="gLayer_hipsografico" checked/>
                                <span class="vis" > <img src="/mapper/images/legend/Hipso_i0.png"/> </span>
                                <span class="vis" id="spxg_Hipso"> <span class="grp-title vis">Hipsográfico </span> </span>
                            </li>
                        </ul>
                    </li>

                    <li id="licat_cat_raster" class="toccat open">
                        <div class="toccat-hitarea open-hitarea collapsable-hitarea "></div>
                        <span class="vis cat-label" id="spxg_cat_raster">Datos raster</span>
                    </li>
                </ul>
                </div>                
                <!-- Consultas -->    
                <div id="tocconsult" class="TOC" style="height: 402px; display: none; top: 10px; overflow: auto;">
                    <div id="consulta">
                      <h3>Clave Catastral</h3>
                      <div style="padding:1em;">
                        <div id="consClave">
                            <table width="100%" class="pm-searchcont pm-toolframe" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                <tr>
                                  <td id="searchitems" class="pm_search_inline">
                                    <table id="searchitems_container1" class="pm-searchitem" border="0" cellspacing="0" cellpadding="0">
                                      <tbody>
                                        <tr id="searchitems_municipios1">
                                          <td class="pm-searchdesc">
                                                <p>Municpio</p>
                                                <select id="mpioClave" name="D3" size="1" style="width: 100%;">
                                                    <option value="000"> Seleccione... </option>
                                                    @foreach($municipios as $municipio => $nombre)
                                                        <option value="{{$municipio}}"> {{$nombre}} </option>
                                                    @endforeach
                                                </select>                                  
        
                                            <p>Clave Catastral</p>
                                            <input type="text" id="txtClave" name="numero_mzna" placeholder="000-0000-000000"  false="" autocomplete="off" class="ac_input">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <br />
                                            <input type="button" value="Buscar" size="20" onclick="PM.Map.submitSearch('Clave')" onmouseover="PM.changeButtonClr(this,'over')" onmouseout="PM.changeButtonClr(this,'out')" class="button_off">
                                          </td>
                                        </tr>
                                    </table>
                                  </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                     </div>
                      <h3>Número de Cuenta</h3>
                      <div style="padding:1em;">
                        <div id="consCuenta">
                            <table width="100%" class="pm-searchcont pm-toolframe" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                <tr>
                                  <td id="searchitems" class="pm_search_inline">
                                    <table id="searchitems_container1" class="pm-searchitem" border="0" cellspacing="0" cellpadding="0">
                                      <tbody>
                                        <tr id="searchitems_municipios1">
                                          <td class="pm-searchdesc">
                                                <p>Municpio</p>
                                                <select id="mpioCuenta" name="D4" size="1" style="width: 100%;">
                                                    <option value="000"> Seleccione... </option>
                                                    
                                                    @foreach($municipios as $municipio => $nombre)
                                                        <option value="{{$municipio}}"> {{$nombre}} </option>
                                                    @endforeach
                                                </select>                                  
        
                                            <p>Número de Cuenta</p>
                                            <input type="text" id="txtCuenta" name="numero_cta"  placeholder="00-[R|U]-000000" false="" autocomplete="off" class="ac_input">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <br />
                                            <input type="button" value="Buscar" size="20" onclick="PM.Map.submitSearch('Cuenta')" onmouseover="PM.changeButtonClr(this,'over')" onmouseout="PM.changeButtonClr(this,'out')" class="button_off">
                                          </td>
                                        </tr>
                                    </table>
                                  </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                     </div>
                      <h3>Calle</h3>
                      <div style="padding:1em;">
                        <div id="consCalle">
                            <table width="100%" class="pm-searchcont pm-toolframe" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                <tr>
                                  <td id="searchitems" class="pm_search_inline">
                                    <table id="searchitems_container1" class="pm-searchitem" border="0" cellspacing="0" cellpadding="0">
                                      <tbody>
                                        <tr id="searchitems_municipios1">
                                          <td class="pm-searchdesc">
                                                <p>Municipio</p>
                                                <select id="mpioCalle" name="mpioDomicilio" size="1" style="width: 100%;">
                                                    <option value="000"> Seleccione... </option>
                                                    
                                                    @foreach($municipios as $municipio => $nombre)
                                                        <option value="{{$municipio}}"> {{$nombre}} </option>
                                                    @endforeach
                                                </select>                                  
                                                <p>Localidad</p>
                                                <select id="locCalle" name="locDomicilio" size="1" style="width: 100%;">
                                                    <option value="000"> Seleccione... </option>
                                                </select>                                  
                                                <p>Sobre la calle</p>
                                                <select id="calleCalle1" name="calleDomicilio1" size="1" style="width: 100%;">
                                                    <option value="000"> Seleccione... </option>
                                                </select>                                  
                                                <p>Cerca de la calle</p>
                                                <select id="calleCalle2" name="calleDomicilio2" size="1" style="width: 100%;">
                                                    <option value="000"> Seleccione... </option>
                                                </select>                                  
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <br />
                                            <input type="button" value="Buscar" size="20" onclick="PM.Map.submitSearchCalle()" onmouseover="PM.changeButtonClr(this,'over')" onmouseout="PM.changeButtonClr(this,'out')" class="button_off">
                                          </td>
                                        </tr>
                                    </table>
                                  </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                     </div>
                    </div>                
                </div>
              </form>
            </div>
                    
        <!-- Reference Map -->
        <div id="refmap" class="refmap" style="width:197px; height:91px">
                <img id="refMapImg" src="/mapper/images/reference.png" width="197" height="91" alt="">
                <div id="refsliderbox" class="sliderbox" style="visibility: hidden;"></div>
                <div id="refbox" class="refbox" style="left: 24px; top: 13px; width: 148px; height: 61px; visibility: visible;"></div>
                <div id="refcross" class="refcross" style="visibility: hidden;"><img id="refcrossimg" src="/mapper/images/refcross.gif" alt=""> </div>
                <div id="refboxCorner"></div>
            </div>
            </div>

    <div class="ui-layout-south" id="uiLayoutSouth" style="position: absolute; bottom: 0px; height: 32px; margin-top: 8px; right: -1px; left: 228px;">
            <div class="legal">
                <p><b>Gobierno del Estado de Tabasco © Derechos Reservados 2013 - 2018</b><br>
                    Dirección General de Tecnologías de Información y Comunicaciones</p>
            </div>
            <div class="foot_logo">
                <div class="img-cont">
                    <img src="/mapper/images/logos/estado-logo.png" alt="Estado">
                </div>
            </div>
    </div>
    <div class="ui-layout-south-west" id="uiLayoutSouthWest" style="position: absolute; bottom: 0px; height: 32px; width: 220px; margin-top: 8px; margin-right: 6px;">
        <!-- Coordinates -->
        <!-- <div id="showcoords" class="showcoords1"><div id="xcoord">X: 581085</div><div id="ycoord">Y: 2028310</div></div>  -->
    </div> 

    <div class="ui-layout-east" id="uiLayoutEast" style="position: absolute; width: 0px;">
    </div>

    <div class="ui-layout-center" id="uiLayoutCenter" style="position: absolute; height: 509px; width: 1117px; top: 40px; left: 228px;">
        <!-- Map Zone -->
        <div id="map" class="baselayout" style="width: 1117px; height: 509px;">
                <!-- MAIN MAP -->
                <div id="mapimgLayer" style="width: 1117px; height: 509px; cursor: url(/mapper/images/cursors/zoomin.cur), default; top: 0px; left: 0px; clip: rect(auto auto auto auto);">
                        <img id="mapImg" src="/mapper/images/mapa.png" style="overflow: hidden; width: 1117px; height: 509px;" alt="">
                </div>
                <div id="measureLayer" class="measureLayer"><div style="font-size: 0px;"></div></div>
                <div id="measureLayerTmp" class="measureLayer"><div style="font-size: 0px;"></div></div>
                <div id="zoombox" class="zoombox" style="visibility: hidden;"></div>
                <div id="helpMessage" style="display: none;"></div>
                <div id="iqueryContainer"></div>
                <div id="loading" style="left: 508.5px; top: 204.5px; visibility: hidden;"><img id="loadingimg" src="/mapper/images/loading.gif" alt="loading"></div>
        </div>
                
        <!-- ToolBar -->
              
        <div id="toolBar" class="pm-toolframe" style="height: 190px;">
          <table class="pm-toolbar">
            <tbody>
              <tr>
                <td class="pm-tsepspace" style="height: 15px; width: 15px;">
                </td>
              </tr>
              <tr>
                <td id="tb_home" class="pm-toolbar-td pm-toolbar-td-off">
                  <img id="img_home" src="/mapper/images/buttons/default/reload_off.gif" alt="Visualización completa" title="Visualización completa">
                </td>
              </tr>
              <tr>
                <td class="pm-tsepv" style="height: 1px; width: 1px;">
                </td>
              </tr>
              <tr>
                <td id="tb_zoomin" class="pm-toolbar-td pm-toolbar-td-on">
                  <img id="img_zoomin" src="/mapper/images/buttons/default/zoomin_off.gif" alt="Acercar" title="Acercar">
                </td>
              </tr>
              <tr>
                <td id="tb_zoomout" class="pm-toolbar-td pm-toolbar-td-off">
                  <img id="img_zoomout" src="/mapper/images/buttons/default/zoomout_off.gif" alt="Alejar" title="Alejar">
                </td>
              </tr>
              <tr>
                <td id="tb_pan" class="pm-toolbar-td pm-toolbar-td-off">
                  <img id="img_pan" src="/mapper/images/buttons/default/pan_off.gif" alt="Mover" title="Mover">
                </td>
              </tr>
              <tr>
                <td class="pm-tsepv" style="height: 1px; width: 1px;">
                </td>
              </tr>
              <tr>
                <td id="tb_identify" class="pm-toolbar-td pm-toolbar-td-off">
                  <img id="img_identify" src="/mapper/images/buttons/default/identify_off.gif" alt="Identificar" title="Identificar">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div id="mapToolArea" style="display: none;"></div>
    </div>        

<!-- ======================= ADAPT END ======================== -->
</div>

<div style="visibility:hidden"><img id="pmMapRefreshImg" src="/mapper/images/pixel.gif" alt=""></div>
<div style="visibility:hidden"><img src="/mapper/images/pixel.gif" alt=""></div>

<!-- Dialog Result Query -->
<!-- MANDATORY form element for update events; DO NOT REMOVE! -->
<form id="pm_updateEventForm" action="">
                    <p><input type="hidden" id="pm_mapUpdateEvent" value=""></p>
                </form>


<script type="text/javascript">
    // use jQuery for intitialization 
    $(document).ready(function() {
        PM.Init.main();
    });
    
    
</script>

</body>
</html>