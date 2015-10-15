$(document).ready(function() {

    $("#tocCapas").click(function(){
        $("#tocConsultas").removeClass('pm-tabs-selected');
        $("#tocconsult").hide();
        $("#tocCapas").addClass('pm-tabs-selected');
        $("#toc").show();
    });
    
    $("#tocConsultas").click(function(){
        $("#tocCapas").removeClass('pm-tabs-selected');
        $("#toc").hide();
        $("#tocConsultas").addClass('pm-tabs-selected');
        $("#tocconsult").show();
    });
    
    $(".pm-toolbar-td").mousedown(function(){
        var button = $(this).attr("id"); 
        $("td.pm-toolbar-td").addClass('pm-toolbar-td-off').removeClass('pm-toolbar-td-on');
        $('#' + button).removeClass('pm-toolbar-td-off').addClass('pm-toolbar-td-on').removeClass('pm-toolbar-td-over');
    });

    $(".pm-toolbar-td").click(function(){
        var button = $(this).attr("id");
        var tool = button.substr(3);
        domouseclick(tool); 
    });


    $(".gLayer").click(function(){
        var nombre = $(this).attr("id").substr(7);
        var stFind = 0;
        for (x=0;x<PM.activeLayer.length;x++){
            if(PM.activeLayer[x] == nombre) {
             stFind = 1;
             break;   
            } 
             
        }
    
        if($(this).is(':checked')){
            if(stFind == 0) {
                PM.activeLayer.push(nombre);
            }
        }else{
            if(stFind == 1) {
                PM.activeLayer.splice(x,1);
            }
        }
        //PM.resize_timer = setTimeout("PM.Map.zoompoint(1,'268+228')",300);
    });


    $("#layerform").submit(function(event){
        event.preventDefault();
        var dataString = $(this).serialize();      
        // alert("Hola");  
        
        
        $.ajax
        ({
        type: "GET",
        url: "/getAvaluoCartCorevat34_AA",
        data: dataString,
        dataType: "json",
        cache: false,
        success: function(json)
        {
            
            var tagselect = '';
            var inputext = $("#ClaveCatastral").val();            
            var mapurl = PM_XAJAX_LOCATION + 'consultaalfacorevat';
            var variables = [tagselect,inputext];
            var data = {
                "query":'Clave',
                "mode":"map",
                "zoom_type":"zoomextent",
                "mapW":PM.mapW,
                "mapH":PM.mapH,
                "groups":PM.activeLayer,
                "variables":variables
            };
            PM.Map.updateMap(mapurl, data);

            
        }, 

        error: function(xhr, textStatus, error){
            alert(xhr.statusText);
            alert(textStatus);
            alert(error);
        }

        });
    });





    $("#getT").click(function(event){
        var ids = '';
        var ars = '';
        var mun = '008';
         $('input[type=checkbox]').each(function () {
            if (this.checked && this.id != 'toPDF') {
                var ar = this.id.split('=');
                ids += ids == '' ? ar[0] : ','+ar[0];
                ars += ars == '' ? ar[2] : ','+ar[2];
                mun = ar[3];
            }
        });
        var toPDF = !$('#toPDF').attr('checked') ? 0 : 1;
        var mapurl = PM_XAJAX_LOCATION + 'consultaalfacorevat';
        var variables = [ids,ars,mun,toPDF];
        var data = {
            "query":'Clave',
            "mode":"map",
            "zoom_type":"zoomextent",
            "mapW":PM.mapW,
            "mapH":PM.mapH,
            "groups":PM.activeLayer,
            "variables":variables
        };

            PM.Map.updateMap(mapurl, data);

/*
        if ( !$('#toPDF').attr('checked') ) {
            PM.Map.updateMap(mapurl, data);
        }else{
            alert("Modulo en Construcción");
            return false;
        }
*/        
            
    });



    $("#mpioCalle").change(function(){
        var valor = $(this).val();
        var dataString = 'mpio='+ valor;        
        $.ajax
        ({
        type: "POST",
        url: "/localidadByMpio",
        data: dataString,
        cache: false,
        success: function(html)
        {
        $("#locCalle").html(html);
        } 
        });
    });

    $("#locCalle").change(function(){
        var valor = $(this).val();
        var dataString = 'gidloc='+ valor;        
        $.ajax
        ({
        type: "POST",
        url: "/callesBylocalidad",
        data: dataString,
        cache: false,
        success: function(html)
        {
        $("#calleCalle1").html(html);
        //$("#calleDomicilio2").html(html);
        } 
        });
    });
  
    $("#calleCalle1").change(function(){
        var valor = $(this).val();
        var dataString = 'calle='+ valor;        
        $.ajax
        ({
        type: "POST",
        url: "/callesBycalle",
        data: dataString,
        cache: false,
        success: function(html)
        {
        $("#calleCalle2").html(html);
        //$("#calleDomicilio2").html(html);
        } 
        });
    });
});


var PM = {
    scale: null,
    resize_timer: null,
    useCustomCursor: true,
    scaleSelectList: [100000, 250000, 500000, 1000000, 2500000, 5000000, 10000000, 25000000],
    enableRightMousePan: true,
    queryResultLayout: 'table',
    queryTreeStyle: {treeview: {collapsed: true, unique: true}},
    zsliderVertical: true,
    autoIdentifyFollowMouse: false,
    useInternalCursors: false,
    suggestLaunchSearch: true,
    measureUnits: {distance:" [km]", area:" [km&sup2,]", factor:1000},
    measureObjects: {line: {color:"#FF0000", width:2}}, 
    contextMenuList: false,
    exportFormatList: ['XLS', 'CSV', 'PDF'],
    scaleBarOptions: {divisions:2, subdivisions:2 ,resolution:96, minWidth:120, maxWidth:160, abbreviateLabel:true},
    categoriesClosed: [],
    tocTreeviewStyle: {collapsed:true, persist:false},
    minx_geo: null,
    maxy_geo: null,
    xdelta_geo: null,
    ydelta_geo: null,
    Custom: {
        queryResultAddList: []
    },
    Draw: {},
    Form: {},
    Init: {},
    Layout: {},
    Locales: {list:[]},
    Map: {
        mode: 'map',
        zoom_type: 'zoomrect',
        zoom_factor: 1,
        maction: 'box',
        tool: 'zoomin',
        forceRefreshToc: false,
        zoomJitter: 10,
        bindOnMapRefresh: function(bindData, bindFunction) {
			var data, fct;
			
			if ($.isFunction(bindData) ) {
				fct = bindData;
				data = null;
			} else {
				fct = bindFunction;
				data = bindData;
			}
            //$("#mapUpdateForm").bind("reset", bindData, bindFunction);
            $("#pm_mapUpdateEvent").bind("change", data, fct);
        }
    },
    Plugin: {},
    Query: {},
    Toc: {},
    UI: {},
    ZoomBox: {},
    Util: {}
};



$.extend(PM.Init,
{


     /**
     * Initialize function; called by 'onload' event of map.phtml
     * initializes several parameters by calling other JS function
     */
    main: function() {      
        // initialization of toolbar, menu, slider HOVER's (and others)
        this.toolbar();
        
        // Add properties to mapImg
        $("#mapImg").load(function(){PM.resetMapImgParams();}).mouseover(function(){PM.ZoomBox.startUp();});
        $('#refMapImg').mouseover( function() {PM.ZoomBox.startUpRef();} );
        
    },

    domElements: function() {
        $('<div>').id('mapToolArea').appendTo('.ui-layout-center');
    },


    /**
     * Initialize toolbar hover's
     */
    toolbar: function() {
        if (PM.tbImgSwap != 1) {
            $('td.pm-toolbar-td').each(function() {            
                $(this).hover(
                    function(){ if (! $(this).hasClass("pm-toolbar-td-on")) $(this).addClass("pm-toolbar-td-over"); },
                    function(){ $(this).removeClass("pm-toolbar-td-over"); }
                );
            });
        } else {
             $('td.pm-toolbar-td').each(function() {            
                $(this).hover(
                    function(){ if (!$(this).find('>img').src().match(/_on/)) $(this).find('>img').imgSwap('_off', '_over'); },
                    function(){ $(this).find('>img').imgSwap('_over', '_off'); }
                );
            });
        }
    },

    /**
     * Initialize buttons
     */
    cButton: function(but) {
        $("#" + but).hover(
            function(){ $(this).addClass("button_on").removeClass("button_off"); },
            function(){ $(this).addClass("button_off").removeClass("button_on"); }
        );
    },

    cButtonAll: function() {
        $("[name='custombutton']").each(function() {            
            $(this).hover(
                function(){ $(this).addClass("button_on").removeClass("button_off"); },
                function(){ $(this).addClass("button_off").removeClass("button_on"); }
            );
        });
    },

    cLayerOnOff: function() {
        PM.resize_timer = setTimeout("PM.Map.zoompoint(1,'" + imgxy + "')",300);    
    }

});


$.extend(PM.Layout,
{
    
    resizeTimer: null,
    
    resizeTimeoutThreshold: 1000,
        
    /**
     * Resize the map zone in dependency to the parent element
     * called by 'onresize' event of ui element containing the map
     */
    resizeMapZone: function() {
        var mapParent = $('#map').parent();
        PM.mapW = mapParent.width();
        PM.mapH = mapParent.height();    
        $('#map, #mapimgLayer, #mapImg').width(PM.mapW).height(PM.mapH); 
        var loadimg = $('#loadingimg');
        $('#loading').left(PM.mapW/2 - loadimg.width()/2).top(PM.mapH/2 - loadimg.height()/2 ).showv();
        var mapurl = PM_XAJAX_LOCATION + 'loadmap';
        //alert(mapurl);
        var data = {
            "zoom_type":"zoompoint",
            "mapW":PM.mapW,
            "mapH":PM.mapH,
            "groups":PM.activeLayer
        };
        
        // avoid multiple resize events 
        clearTimeout(this.resizeTimer);
        PM.Map.updateMap(mapurl, data);
    }
    
});


/*  Prototype JavaScript framework, version 1.4.0
 *  (c) 2005 Sam Stephenson <sam@conio.net>
 *
 *  Prototype is freely distributable under the terms of an MIT-style license.
 *  For details, see the Prototype web site: http://prototype.conio.net/
/*--------------------------------------------------------------------------*/
function _$() {
    var elements = new Array();

    for (var i = 0; i < arguments.length; i++) {
        var element = arguments[i];
        if (typeof element == 'string')
            element = document.getElementById(element);

        if (arguments.length == 1)
            return element;

        elements.push(element);
    }

    return elements;
}



    /**
     * Mouse click button functions (for toolbar)
     */
function domouseclick(button) {
                
        switch (button) {
            case 'home':
                PM.Map.zoomfullext();
                break;
            
            case 'zoomin':
                PM.Map.mode = 'map';
                PM.Map.zoom_type = 'zoomrect';
                PM.Map.maction = 'box';
                PM.Map.tool = 'zoomin';
                break;
            case 'zoomout':
                PM.Map.mode = 'map';
                PM.Map.zoom_type = 'zoompoint';
                PM.Map.zoom_factor = -2;
                PM.Map.maction = 'click';
                PM.Map.tool = 'zoomout';
                break;
            case 'identify':
                PM.Map.mode = 'query';
                PM.Map.maction = 'click';
                PM.Map.tool = 'identify';
                break;
            case 'pan':
                PM.Map.mode = 'map';
                PM.Map.zoom_type = 'zoompoint';
                PM.Map.zoom_factor = 1;
                PM.Map.maction = 'pan';
                PM.Map.tool = 'pan';
                break;
            default:
                $("td.pm-toolbar-td").addClass('pm-toolbar-td-off').removeClass('pm-toolbar-td-on');
                $('#td_zoomin').removeClass('pm-toolbar-td-off').addClass('pm-toolbar-td-on').removeClass('pm-toolbar-td-over');
        }
        
        // Set cursor appropriate to selected tool 
        if (PM.useCustomCursor) {
            PM.setCursor(false, false);
        }
}

/**
 * Generic number functions
 */
Number.prototype.roundTo=function(precision){return parseFloat(parseFloat(this).toFixed(precision));};



/**
 * DOM generic functions
 */
function objL(obj) {	
    return parseInt(obj.style.left || obj.offsetLeft);
}

function objT(obj) {
    return parseInt(obj.style.top || obj.offsetTop);
}

function objW(obj) {
	return parseInt( obj.style.width || obj.clientWidth );
}

function objH(obj) {		
    return parseInt( obj.style.height || obj.clientHeight);    
}

function hideObj(obj) {
    obj.style.visibility = 'hidden';
}

function showObj(obj) {
    obj.style.visibility = 'visible';
}

function _p($string)
{
    return $string;
}
