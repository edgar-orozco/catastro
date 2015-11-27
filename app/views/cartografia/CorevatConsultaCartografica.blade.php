<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es"><head>
 <meta http-equiv="Content-Script-Type" content="text/javascript">

 <title>DGCEF-Tabasco</title>

    <link rel="shortcut icon" href="/cartografia/images/favicon.png" type="image/png">

    {{ HTML::script('/cartografia/javascript/jquery_merged.js') }}
    {{ HTML::script('/cartografia/javascript/custom_corevat.js') }}
    {{ HTML::script('/js/jquery/jquery-ui.js') }}
    {{ HTML::script('/cartografia/javascript/zoombox.js') }}
    {{ HTML::script('/cartografia/javascript/pm.map.js') }}
    {{ HTML::script('/cartografia/javascript/pm.pmapper.js') }}

    {{ HTML::style('/js/jquery/jquery-ui.css') }}
    {{ HTML::style('/cartografia/templates/default.css') }}
    {{ HTML::style('/cartografia/templates/layout.css') }}
    {{ HTML::style('/cartografia/templates/jquery.treeview.css') }}
    {{ HTML::style('/cartografia/templates/toc.css') }}
    {{ HTML::style('css/bootstrap.css') }}

    {{ HTML::style('/cartografia/templates/dialog.css') }}
    <!--[if lt IE 7]>
    {{ HTML::style('/cartografia/templates/ie6.css') }}
    <![endif]-->
 

 {{ HTML::style('/cartografia/templates/custom.css') }}


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
        PM.activeLayer = ['manzanas','predios','construcciones','entidades','municipios','localidades','carreteras','calles','rios','hipsografico','predio_ubicado_1','orange','green','blue','cafe','pink'];
        // PM.activeLayer = ['predios'];

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
                <img src="/cartografia/images/logos/estado-logo.png" alt="Estado"/>
            </div>
            <div class="img-cont spf">
                <img src="/cartografia/images/logos/logo-spf.png" alt="SPF"/>
            </div>
            <div class="img-cont catastro">
                <img src="/css/images/main/logo-header.png" alt="Catastro">
            </div>
        </div>

        Sistema Catastral y Registral del Estado de Tabasco
</div>

<div class="ui-layout-root" id="uiLayoutRoot" style="position: absolute; top: 76px; bottom: 10px; left: 10px; right: 10px;">
    
<div class="ui-layout-north-west" id="uiLayoutNorthWest" style="position: absolute; top: 0px; height: 32px; width: 220px; margin-bottom: 6px; margin-right: 6px;">
Avalúos según Valor Concluido
</div>

    <div class="ui-layout-north" id="uiLayoutNorth" style="position: absolute; top: 0px; height: 32px; margin-bottom: 6px; right: -1px; left: 228px;">
        <div style="float:left; margin-left: 5px; margin-top: 5px">
            <a href="{{URL::to('/')}}"> <img src="/cartografia/images/buttons/default/home_off.gif" alt="Menú Principal" title="Menú Principal"/></a>
        </div>
        <div style="float:left; margin-left: 5px; margin-top: 5px">
            &nbsp 
        </div>
        <div style="float:left; margin-left: 5px; margin-top: 5px">
            <a href="{{URL::to('/users/logout')}}"> <img src="/cartografia/images/buttons/default/exit_off.png" alt="Salir" title="Salir del Sistema"/></a>
        </div>


<!--

         @if ( isset($avaluo) )
            {{"Si Existe"}} 
        @else
            {{"NO Existe"}} 
        @endif
 
 -->   

   </div>
    
    <div class="ui-layout-west" id="uiLayoutWest" style="position: absolute; left: 0px; width: 220px; height: 509px; margin-right: 6px; top: 40px;">
        <!-- Legend/TOC -->
        <div id="tocContainer">


<!--               
            <form id="layerform" >
                <label for="ClaveCatastral" >Clave Catastral</label>
                <input type="text" id="ClaveCatastral" name="ClaveCatastral" value="" >
                <input type="submit" value="Buscar" >
            </form>
 -->

            <span></span>
            <div class="panel panel-default">
                  <div class="panel-body">
                      <ul class="list-group"> 
                        <li class="list-group-item">
                            <label>
                                <input class="chk0" id="0=chk=0-1000=008" type="checkbox">
                                <span style="color:#E465CC;">0 - 1M</span>
                            </label>
                        </li>

                        <li class="list-group-item">
                            <label>
                                <input class="chk0" id="1=chk=1001-2000=008" type="checkbox">
                                 <span style="color:#DD672E;">1M - 2M</span>
                            </label>
                        </li>


                        <li class="list-group-item">
                            <label>
                                <input class="chk0" id="2=chk=2001-3000=008" type="checkbox">
                                <span style="color:#2D9449;">2M - 3M</span>
                            </label>
                        </li>

                        <li class="list-group-item">
                            <label>
                                <input class="chk0" id="3=chk=3001-4000=008" type="checkbox">
                                <span style="color:#329CD4;">3M - 4M</span>
                            </label>
                        </li class="list-group-item">

                        <li class="list-group-item">
                            <label>
                                <input class="chk0" id="4=chk=4001-5000=008" type="checkbox">
                                <span style="color:#C82323;">4M - 5M</span>
                            </label>
                        </li>

                        <li class="list-group-item">
                            <label>
                                <input class="chk0" id="5=chk=5001-6000=008" type="checkbox">
                                <span style="color:#9C6868;">5M - 6M</span>
                            </label>
                        </li>



                    </ul> 


                    <div class="list-group">
                            <label style="font-weight: normal;">
                                <input class="chkPDF" id="toPDF" type="checkbox">
                                <span>PDF</span>
                            </label>
                        <button type="button" class="btn btn-default btn-xs center pull-right list-group-item" id='getT'>Filtrar</button>
                    </div>

                    
              </div>

            </div>
        </div>
                    
        <!-- Reference Map -->
        <div id="refmap" class="refmap" style="width:197px; height:91px">
                <img id="refMapImg" src="/cartografia/images/reference.png" width="197" height="91" alt="">
                <div id="refsliderbox" class="sliderbox" style="visibility: hidden;"></div>
                <div id="refbox" class="refbox" style="left: 24px; top: 13px; width: 148px; height: 61px; visibility: visible;"></div>
                <div id="refcross" class="refcross" style="visibility: hidden;"><img id="refcrossimg" src="/cartografia/images/refcross.gif" alt=""> </div>
                <div id="refboxCorner"></div>
            </div>
    </div>

    <div class="ui-layout-south" id="uiLayoutSouth" style="position: absolute; bottom: 0px; height: 32px; margin-top: 8px; right: -1px; left: 228px;">
            <div class="legal">
                <p><b>Gobierno del Estado de Tabasco © Derechos Reservados 2013 - 2018 </b><br>
                    Dirección General de Tecnologías de Información y Comunicaciones</p>
            </div>
            <div class="foot_logo">
                <div class="img-cont">
                    <img src="/cartografia/images/logos/estado-logo.png" alt="Estado">
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
                <div id="mapimgLayer" style="width: 1117px; height: 509px; cursor: url(/cartografia/images/cursors/zoomin.cur), default; top: 0px; left: 0px; clip: rect(auto auto auto auto);">
                        <img id="mapImg" src="/cartografia/images/mapa.png" style="overflow: hidden; width: 1117px; height: 509px;" alt="">
                </div>
                <div id="measureLayer" class="measureLayer"><div style="font-size: 0px;">A</div></div>
                <div id="measureLayerTmp" class="measureLayer"><div style="font-size: 0px;"></div></div>
                <div id="zoombox" class="zoombox" style="visibility: hidden;"></div>
                <div id="helpMessage" style="display: none;"></div>
                <div id="iqueryContainer"></div>
                <div id="loading" style="left: 508.5px; top: 204.5px; visibility: hidden;"><img id="loadingimg" src="/cartografia/images/loading.gif" alt="loading"></div>
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
                  <img id="img_home" src="/cartografia/images/buttons/default/reload_off.gif" alt="Visualización completa" title="Visualización completa">
                </td>
              </tr>
              <tr>
                <td class="pm-tsepv" style="height: 1px; width: 1px;">
                </td>
              </tr>
              <tr>
                <td id="tb_zoomin" class="pm-toolbar-td pm-toolbar-td-on">
                  <img id="img_zoomin" src="/cartografia/images/buttons/default/zoomin_off.gif" alt="Acercar" title="Acercar">
                </td>
              </tr>
              <tr>
                <td id="tb_zoomout" class="pm-toolbar-td pm-toolbar-td-off">
                  <img id="img_zoomout" src="/cartografia/images/buttons/default/zoomout_off.gif" alt="Alejar" title="Alejar">
                </td>
              </tr>
              <tr>
                <td id="tb_pan" class="pm-toolbar-td pm-toolbar-td-off">
                  <img id="img_pan" src="/cartografia/images/buttons/default/pan_off.gif" alt="Mover" title="Mover">
                </td>
              </tr>
              <tr>
                <td class="pm-tsepv" style="height: 1px; width: 1px;">
                </td>
              </tr>
              <tr>
                <td id="tb_identify" class="pm-toolbar-td pm-toolbar-td-off">
                  <img id="img_identify" src="/cartografia/images/buttons/default/identify_off.gif" alt="Identificar" title="Identificar">
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div id="mapToolArea" style="display: none;"></div>
    </div>        

<!-- ======================= ADAPT END ======================== -->
</div>

<div style="visibility:hidden"><img id="pmMapRefreshImg" src="/cartografia/images/pixel.gif" alt=""></div>
<div style="visibility:hidden"><img src="/cartografia/images/pixel.gif" alt=""></div>

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