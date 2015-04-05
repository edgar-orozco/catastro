//<script type="text/javascript">

/*************************************************************
 *                                                           *
 *          JavaScript configuration settings                *
 *                                                           *
 *************************************************************/


/**
 * Set to true if cursor shall change according to active tool (default: true)
 */
PM.useCustomCursor = true;


/**
 * Define scale selection list: 
 * ==> adapt to scale range of your data
 * ==> set empty array for disabling function 
 * values can be numbers or numbers containing 1000-separators [. , ' blank]
 */
//PM.scaleSelectList = []; 
//PM.scaleSelectList = [5000, 10000, 25000, 50000, 100000, 250000, 500000, 1000000, 2500000]; 
//PM.scaleSelectList = [100000, 250000, 500000, 1000000, 2500000, 5000000, 10000000, 25000000]; 
//PM.scaleSelectList = ["100.000", "250.000", "500.000", "1.000.000", "2.500.000", "5.000.000", "10.000.000", "25.000.000"];
//PM.scaleSelectList = ["100,000", "250,000", "500,000", "1,000,000", "2,500,000", "5,000,000", "10,000,000", "25,000,000"];
//PM.scaleSelectList = ["100'000", "250'000", "500'000", "1'000'000", "2'500'000", "5'000'000", "10'000'000", "25'000'000"];
PM.scaleSelectList = ["100 000", "250 000", "500 000", "1 000 000", "2 500 000", "5 000 000", "10 000 000", "25 000 000"];


/**
 * Enable pan mode if right mouse button is pressed
 * independent of selected tool (default: true)
 */
PM.enableRightMousePan = true;

/** 
  * Invert wheel zoom action to follow Google behaviour 
  */ 
PM.ZoomBox.wheelZoomGoogleStyle = true; 

/**
 * Define query result layout: tree or table (default: table)
 */
//PM.queryResultLayout = 'tree';
PM.queryResultLayout = 'table';

/**
 * Define tree style for queryResultLayout = 'tree'
 * css: "red", "black", "gray"; default: none; styles defined in /templates/treeview.css
 * treeview:
 *   @option String|Number speed Speed of animation, see animate() for details. Default: none, no animation
 *   @option Boolean collapsed Start with all branches collapsed. Default: true
 *   @option Boolean unique Set to allow only one branch on one level to be open
 *         (closing siblings which opening). Default: true
 */
//PM.queryTreeStyle = {css: "red", treeview: {collapsed: true, unique: true}};
PM.queryTreeStyle = {treeview: {collapsed: true, unique: true, persist:false}};


/**
 * Close categories tree in array on startup
 * same as setting category in config.xml as 
 *   <category name="cat_nature" closed="true">
 * (default: all categories open)
 */
//PM.categoriesClosed = ['cat_nature'];


/**
 * Define style of treeview for TOC 
 * default: {collapsed:true, persist:false} 
 */
PM.tocTreeviewStyle = {collapsed:true, persist:false, animated:'fast'};


/**
 * Define if zoom slider is vertical (default: true)
 */
PM.zsliderVertical = true;


/**
 * Decide if auto-identify shall show pop-up element at mouse pointer (default: false)
 */
PM.autoIdentifyFollowMouse = false;


/**
 * Define if internal (default) cursors should be used for mouse cursors (default: false)
 */
PM.useInternalCursors = false;


/**
 * Define if select a SUGGEST row will directly launch the search (default: true)
 */
PM.suggestLaunchSearch = true;


/**
 * Units for measurement (distance, area)
 */
//var pmMeasureUnits = {distance:" [m]", area:" [m&sup2;]", factor:1}; 
PM.measureUnits = {distance:" [km]", area:" [km&sup2;]", factor:1000};

/**
 * Lines and polygon styles for measurement
 */
PM.measureObjects = {line: {color:"#FF0000", width:2}}; 


/**
 * Sample for reprojecting ETRS89 LAEA dislay coordinates to lonlat WGS84 
 * requires loading of "proj4js" plugin in config_default.xml
 */
/*
Proj4js.defs["EPSG:3035"]="+proj=laea +lat_0=52.00000000 +lon_0=10.0000000 +x_0=4321000 +y_0=3210000 +ellps=GRS80 +units=m +no_defs ";
PM.ZoomBox.coordsDisplayReproject = true;
PM.ZoomBox.coordsDisplaySrcPrj = "EPSG:3035";
PM.ZoomBox.coordsDisplayDstPrj = "EPSG:4326";
PM.ZoomBox.coordsDisplayRfactor = 4;
*/


/**
 * Definitions of context menus
 * parameters for styles are: menuStyle, itemStyle, itemHoverStyle
 * for details see http://www.trendskitchens.co.nz/jquery/contextmenu/
 */
PM.contextMenuList = [     
    {bindto: 'li.tocgrp',        
     menuid: 'cmenu_tocgroup',
     menulist: [   
        {id:'info',   imgsrc:'info-b.png', text:'Layer Info',  run:'PM.Custom.showGroupInfo'},
        {id:'open',   imgsrc:'transparency-b.png', text:'Transparency',   run:'PM.Plugin.Transparency.cmOpenTranspDlg'},
        {id:'email',  imgsrc:'zoomtolayer-b.png',  text:'Zoom To Layer',  run:'PM.Map.zoom2group' }], 
     styles: {menuStyle: {width:'auto'}}
    },
    {bindto: 'li.toccat',
     menuid: 'cmenu_toccat',
     menulist: [
        {id:'layerson',  imgsrc:'layerson-b.png', text:'Layers On',  run:'PM.Toc.catLayersSwitchOn'},
        {id:'layersoff', imgsrc:'layersoff-b.png', text:'Layers Off',  run:'PM.Toc.catLayersSwitchOff'},
        {id:'info',   imgsrc:'info-b.png', text:'Info',  run:'PM.Custom.showCategoryInfo'} ], 
     styles: {menuStyle: {width:'auto'}}
    }
];


/**
 * Layout of scalebar (from plugin)
 */
PM.scaleBarOptions = {divisions:2, subdivisions:2 ,resolution:96, minWidth:120, maxWidth:160, abbreviateLabel:true};


/**
 * Toolbar elements
 * toolbarid: Id to use for toolbar <div>, CSS definition via 'layout.css'
 * options: orientation: "v"=vertical, "h"=horizontal
 *          css: additional CSS styles, overwriting the ones in 'layout.css'
 *          theme: image directories under /images/buttons/
 * buttons: stateless buttons: add "run:'scriptToExecuteOnClick'"
 *          space/separator: need to be defined with increasing number at the end, dimension: in px
 */
PM.buttonsDefault = {
    toolbarid:'toolBar',
    options: {orientation:'v',
              css:{height:'440px'},
              theme:'default',
              imagetype:'gif'
             }, 
    buttons: [
        {tool:'space1',        dimension: 15},
        {tool:'home',          name:'Zoom To Full Extent', run:'PM.Map.zoomfullext'},
        {tool:'back',          name:'Back', run:'PM.Map.goback'},
        {tool:'fwd',           name:'Forward', run:'PM.Map.gofwd'},
        {tool:'zoomselected',  name:'Zoom To Selected', run:'PM.Map.zoom2selected'},
        {tool:'separator1',    dimension:1},
        {tool:'zoomin',        name:'Zoom in'},
        {tool:'zoomout',       name:'Zoom out'},
        {tool:'pan',           name:'Pan'},
        {tool:'separator2',    dimension:1},
        {tool:'identify',      name:'Identify'},
        {tool:'select',        name:'Select'},
        {tool:'auto_identify', name:'Auto Identify'},
        {tool:'separator3',    dimension: 1},
        {tool:'measure',       name:'Measure'},
        //{tool:'coordinates',       name:'Coordinates'},
        {tool:'separator4',    dimension: 1},
        {tool:'transparency',  name:'Transparency', run:'PM.Plugin.Transparency.openTransparencyDlg'},
        {tool:'reload',        name:'Refresh Map', run:'PM.Map.clearInfo'}
    ]
};

/**
 * Tool link elements
 */
PM.linksDefault = {
    containerid:'toolLinkContainer',
    links: [
        {linkid:'link', name:'Link', run:'PM.UI.showMapLink', imgsrc:'link-w.png'},
        {linkid:'print', name:'Print', run:'PM.Dlg.openPrint', imgsrc:'print-w.png'},
        {linkid:'download', name:'Download', run:'PM.Dlg.openDownload', imgsrc:'download-w.png'},
        {linkid:'help', name:'Help', run:'PM.Dlg.openHelp', imgsrc:'help-w.png'},
        {linkid:'home', name:'Home', run:'http://www.pmapper.net', target:'_new', imgsrc:'home-w.png'}
        //{linkid:'layers', name:'Layers', run:'PM.Plugin.Layerselect.openDlg', imgsrc:'layers-bw.png'}
        
    ]
};


/**
 * Tabs used for swapping between TOC and legend (legStyle=swap)
 */

PM.tocTabs = {
    tabid: 'pmTocTabulators',
    options: {
        mainClass: 'pm-tabs'
    },
    tabs: [
        {tabid:'layers', name:'Layers', run:'PM.Toc.swapToLayerView', imgsrc:null, active:true},
        {tabid:'legend', name:'Legend', run:'PM.Toc.swapToLegendView', imgsrc:null},
        {tabid:'consult', name:'Consulta', run:'PM.Toc.swapToConsultView', imgsrc:null}
    ]
};



//</script>
