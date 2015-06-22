
/******************************************************************************
 *
 * Purpose: core p.mapper functions (init, user interaction, open popups) 
 * Author:  Armin Burger
 *
 ******************************************************************************
 *
 * Copyright (c) 2003-2010 Armin Burger
 *
 * This file is part of p.mapper.
 *
 * p.mapper is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version. See the COPYING file.
 *
 * p.mapper is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with p.mapper; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 ******************************************************************************/

$.extend(PM,
{
    /**
     * Reset parameters of some DIV's
     */
    resetMapImgParams: function() {
        $("#mapImg").width(PM.mapW).height(PM.mapH);
        $("#mapimgLayer").top(0).left(0).width(PM.mapW).height(PM.mapH).css({clip:'rect(auto auto auto auto)'});
        $('#zoombox, #loading').hidev();
        
        if (PM.Map.mode == 'measure') {
            PM.Draw.resetMeasure();
            PM.Draw.polyline = PM.Draw.toPxPolygon(PM.Draw.geoPolyline);
            if (PM.Draw.polyline.getPointsNumber()>0) {
                PM.Draw.drawPolyline(jg,PM.Draw.polyline);
            }
        }
    },


    //
    // SWAP FUNCTIONS FOR TOOLBAR TD -> USE ALTERNATIVELY TO IMAGE SWAP
    // Changes TD class (default.css -> .TOOLBARTD...) in toolbar
    // 
    
    /**
     * Function for state buttons (CLICKED TOOLS: zoomin, pan, identify, select, measure)
     * set class for active tool button
     */
    setTbTDButton: function(button) {
        if (PM.tbImgSwap != 1) {
            $("td.pm-toolbar-td").addClass('pm-toolbar-td-off').removeClass('pm-toolbar-td-on');
            $('#tb_' + button).removeClass('pm-toolbar-td-off').addClass('pm-toolbar-td-on').removeClass('pm-toolbar-td-over');
        } else {
            $("td.pm-toolbar-td").each(function() {
                //$(this).addClass('TOOLBARTD_OFF').removeClass('TOOLBARTD_ON');
                $(this).find('>img').imgSwap('_on', '_off');
            });
            $('#tb_' + button).find('>img').imgSwap('_off', '_on').imgSwap('_over', '_on');
        }
    },

    /**
     * MouseDown/Up, only set for stateless buttons
     */
    TbDownUp: function(elId, status){
        var but = $('#tb_' + elId);
        if (status == 'd') {
            if (PM.tbImgSwap != 1) {
                but.addClass('pm-toolbar-td-on').removeClass('pm-toolbar-td-off').removeClass('pm-toolbar-td-over');
            } else {
                but.find('>img').imgSwap('_off', '_on').imgSwap('_over', '_on');
            }
        } else {
            if (PM.tbImgSwap != 1) {
                but.addClass('pm-toolbar-td-off').removeClass('pm-toolbar-td-on').addClass('pm-toolbar-td-over');
            } else {
                if (PM.tbImgSwap == 1) but.find('>img').imgSwap('_on', '_off');
            }
        }
    },

    /**
     * Change the color of a button on<->off
     */
    changeButtonClr: function(myObj, myAction) {
        switch (myAction) {
            case 'over':
                myObj.className = 'button_on';
                break;
                
            case 'out':
                myObj.className = 'button_off';
                break;
        }
    },



    /**
     * return root path of application
     */
    getRootPath: function() {
        var theLoc = document.location.href;
        var theLastPos = theLoc.indexOf('?');
        theLoc = theLoc.substr(0, theLastPos);
        
        theLastPos = theLoc.lastIndexOf('/');
        var RootPath = theLoc.substr(0,theLastPos) + '/';
        
        return '/mapper/';
    },

    /** 
     * set the cursor to standard internal cursors
     * or special *.cur url (IE6+ only)
     */
    setCursor: function(rmc, ctype) {	
        if (!rmc) {
            if (PM.Map) {
                var toolType = PM.Map.tool;
            } else {
                var toolType = 'zoomin';
            }
        } else {
            toolType = 'pan';
        }

        // take definition from js_config.php 
        var iC = PM.useInternalCursors;
        // don't use custom cursors for safari & chrome
        if ($.browser.webkit) iC = false;
        
        var rootPath = this.getRootPath();
        var usedCursor = (iC) ? toolType : 'url("' +rootPath + 'images/cursors/zoomin.cur"), default';
        
        switch (toolType) {
            case "zoomin" :
                var usedCursor = (iC) ? 'crosshair' : 'url("' +rootPath + 'images/cursors/zoomin.cur"), default';	
                break;
            
            case "zoomout" :
                var usedCursor = (iC) ? 'e-resize' : 'url(' +rootPath + 'images/cursors/zoomout.cur), default';	
                break;
            
            case "identify" :
                //var usedCursor = (iC) ? 'help' : 'url(' +rootPath + 'images/cursors/identify.cur), default';	
                var usedCursor = 'help';	
                break;
            
            case "auto_identify" :	
                var usedCursor = 'pointer';	
                break;

            case "pan" :
                //var usedCursor = (iC) ? 'move' : 'url(' +rootPath + 'images/cursors/pan.cur), default';	
                var usedCursor = 'move';
                break;
                
            case "select" :
                //var usedCursor = (iC) ? 'help' : 'url(' +rootPath + 'images/cursors/select.cur), default';
                var usedCursor = (iC) ? 'help' : 'help';	            
                break;
                
            case "measure" :
                var usedCursor = (iC) ? 'crosshair' : 'url(' +rootPath + 'images/cursors/measure.cur), default';	
                break;
                
            case "digitize" :
                var usedCursor =  'crosshair';	
                break;
                
            default:
                var usedCursor = 'default';
        }

        if (ctype) usedCursor = ctype;
        $('#mapimgLayer').css({'cursor': usedCursor});
        
    },

    /**
     * Round to a specified decimal
     */
    roundN: function(numin, rf) {
        return ( Math.round(numin * Math.pow(10, rf)) / Math.pow(10, rf) );
    },
    
    /**
     * Show Ajax indicator, 
     * if x/y coordinates provided displayed at mouse click x/y 
     */
    ajaxIndicatorShow: function(x, y) {
        if (x) {
            $('#pmIndicatorContainer').css({top: parseInt(y) + PM.ZoomBox.offsY - 35 +'px', left: parseInt(x) + PM.ZoomBox.offsX - 15 +'px'}).show();
        } else {
            $('#pmIndicatorContainer').css({top:'5px', right:'5px'}).show();
        }
    },

    /**
     * Hide Ajax indicator, 
     */
    ajaxIndicatorHide: function() {
        $('#pmIndicatorContainer').hide();
    },
    
    /**
     * Get the session variable as JSON string
     */
    getSessionVar: function(sessionvar, callfunction) {
        $.ajax({
            url: PM_XAJAX_LOCATION + '/x_getsessionvar.php?' + SID + '&sessionvar=' + sessionvar,
            dataType: "json",
            success: function(response){
                eval(callfunction);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                if (window.console) console.log(errorThrown);
            } 
        });  
    },
    
    /**
     * Set the session variable via JSON string
     */
    setSessionVar: function(sessionvar, val, callfunction) {
        $.ajax({
            url: PM_XAJAX_LOCATION + '/x_setsessionvar.php?' + SID + '&sessionvar=' + sessionvar + '&val=' + val,
            type: "POST",
            dataType: "json",
            success: function(response){
                eval(callfunction);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                if (window.console) console.log(errorThrown);
            } 
        });  
    },
    
    
    /**
     * DIALOGS
     */
    Dlg: {
        
        /** Define if dialog should be transparent on move/resize*/
        transparentOnMoveResize: true,
        /** Opacity if enabled for dialog move/resize */
        moveResizeOpacity: 0.9,
        /** default options for help dialog */
        helpDlgOptions: {width:350, height:500, left:100, top:50, resizeable:true, newsize:true, container:'pmDlgContainer', name:"help"},
        /** default options for download dialog */
        downloadDlgOptions: {width:270, height:250, left:200, top:200, resizeable:false, newsize:true, container:'pmDlgContainer', name:"download"},
        /** default options for print dialog */
        printDlgOptions: {width:350, height:290, left:200, top:200, resizeable:true, newsize:true, container:'pmDlgContainer', name:"print"},
        /** Enable dialog roll up by double click on window bar or using mousewheel*/
        enableRollup: true,
        /** Dlg properties used for rollup */
        dlgProperties: {},
        
        close: function(e, elem, container) {
        	$(elem).parent().parent().hide();
        	$('#' + container + '_MSG').html('');
        	if (!e) {
        		e = window.event;
        	}

        	// IE9 & Other Browsers
        	if (e.stopPropagation) {
        		e.stopPropagation();
           	// IE8 and Lower
        	} else {
        		e.cancelBubble = true;
        	}
        },
        
        /**
         * Create jqDnR Dialog (jquery.jqmodal_full.js)
         */
        createDnRDlg: function(options, title, url) {
            var setOldSize = false;
            if (this.dlgProperties[options.name]) {
                if (this.dlgProperties[options.name].up) {
                    setOldSize = true;
                    this.dlgProperties[options.name].up = false;
                }
            } 
            
            var container = options.container;
            var containerMsg = $('#' + container + '_MSG');
            var dlg = '<div style="height: 100%">';
            dlg += '<div id="' + container + '_TC" class="jqmdTC dragHandle">' + _p(title) + '</div>';
            dlg += '<div id="' + container + '_MSG" class="jqmdMSG"></div>';
            dlg += '<div id="' + container + '_BC" class="jqmdBC" ';
            if (options.resizeable) {
                dlg += '><img src="/mapper/templates/dialog/resize.gif" alt="resize" class="resizeHandle" />';
            } else {
                dlg += 'style="height:0px; border:none">';
            }
            dlg += '</div>';
            dlg += '<input type="image" src="/mapper/templates/dialog/close.gif" onclick="PM.Dlg.close(event, this, \'' + container + '\');" class="jqmdClose jqmClose" />';
            dlg += '</div>';

            var dynwin = $('#' + container);
            // Modified by Thomas RAFFIN (SIRAP)
            // dialog containers auto insertion
            // --> auto create dynwin if doesn't exist 
            // --> put in front of the others (auto calculate z-index)
            if (dynwin.length == 0) {
            	$('<div>').id(container).addClass('jqmDialog').appendTo('body').hide();
            	dynwin = $('#' + container);
            }
        	var maxzindex = 99;
        	$('.jqmDialog').each(function() {
        		if ( ($(this).css('display') != 'none') && ($(this).id() != container) ) {
        			var zindex = parseInt($(this).css('z-index'));
        			if (maxzindex <= zindex) {
        				maxzindex = zindex+1;
        			}
        		}
        	});
        	dynwin.css('z-index', '' + maxzindex); 
            
            var newsize = dynwin.is(':empty') || options.newsize;
            dynwin.html(dlg)
                .jqm({autofire: false, overlay: 0})
                .jqDrag('div.dragHandle');
            if (this.enableRollup) dynwin.find('div.dragHandle').bind("dblclick", function(){PM.Dlg.dlgWinRollup(options.name, $(this))}).mousewheel(function(e){ PM.Dlg.dlgWinRollup(options.name, $(this))});;
            
            if (newsize) dynwin.height(options.height).width(options.width);
            if (options.left) dynwin.css({left:options.left, top:options.top});
            if (setOldSize) dynwin.height(this.dlgProperties[options.name].height);
            if (options.resizeable) dynwin.jqResize('img.resizeHandle');
            //if (url) containerMsg.load(url);
            if (url) $('#' + container + '_MSG').load(url);

            dynwin.show();
            this.adaptDWin(dynwin);
            
            return containerMsg;
        },

        adaptDWin: function(container) {
            var cn = container.id();
            var newMSGh = parseInt($('#' + cn).css('height')) - parseInt($('#' + cn +'_TC').outerHeight()) - parseInt($('#' + cn + '_BC').outerHeight()) ; 
            $('#' + cn + '_MSG').css({height: newMSGh});
        },
        
        dlgWinRollup: function(dlgName, dlgHandle) {
            var dlgContainer = dlgHandle.parent().parent(); 
            if (dlgContainer.height() > dlgHandle.height()) {
                this.dlgProperties[dlgName] = {height:dlgContainer.height(), width:dlgContainer.width()};
                this.dlgProperties[dlgName].up = true;
                dlgContainer.height(dlgHandle.height());
            } else {
                dlgContainer.height(this.dlgProperties[dlgName].height);
                this.dlgProperties[dlgName].up = false;
            }
            
            dlgContainer.find('.jqmdMSG, .jqmdBC').each(function() {
                $(this).toggle();
            });
        },
        
        /**
         * Open help dialog 
         */
        openHelp: function() {
            this.createDnRDlg(this.helpDlgOptions, _p('Help'), 'help.phtml?'+SID);
        },

        /**
         * DOWNLOAD dialog
         * get image with higher resolution for paste in othet programs
         */
        openDownload: function() {
            this.createDnRDlg(this.downloadDlgOptions, _p('Download'), 'downloaddlg.phtml?'+SID );
        },

        /**
         * Open popup dialaog for adding POI 
         */
        openPoi: function(imgxy) {
            var coordsList = imgxy.split('+');
            var mpoint = PM.ZoomBox.getGeoCoords(coordsList[0], coordsList[1], false);
            
            // Round values (function 'roundN()' in 'measure.js')
            var rfactor = 5;
            var px = isNaN(mpoint.x) ? '' : PM.roundN(mpoint.x, rfactor);
            var py = isNaN(mpoint.y) ? '' : PM.roundN(mpoint.y, rfactor);
            
            var inserttxt = prompt(_p('Add location description'), '');
            if (inserttxt) {
                var digitizeurl = PM_XAJAX_LOCATION + 'x_poi.php?' +SID + '&up=' + px + '@@' + py + '@@' + inserttxt; //escape(inserttxt);
                //alert(digitizeurl);
                PM.Map.addPOI(digitizeurl);
            }
        },

        //
        // PRINT functions
        // 
        /**
         * Open the printing dialog
         */
        openPrint: function() {
           this.createDnRDlg(this.printDlgOptions, _p('Print Settings'), 'printdlg.phtml?'+SID);
        },

        /**
         * Show advanced settings in print dialog
         */
        printShowAdvanced: function() {
            $('#pmDlgContainer div.printdlg_advanced').show();
            $('#printdlg_button_advanced').hide();
            $('#printdlg_button_normal').show();
			var height = ($.browser.msie && (parseInt($.browser.version) <= 7.0)) ? $('#printdlg').height() : $('#printdlg').innerHeight();
			$('#pmDlgContainer').height(parseInt(height) + 60);
            this.adaptDWin($('#pmDlgContainer'));
        },

        /**
         * Show advanced settings in print dialog
         */
        printHideAdvanced: function() {
            $('#pmDlgContainer div.printdlg_advanced').hide();
            $('#printdlg_button_normal').hide();
            $('#printdlg_button_advanced').show();
			var height = ($.browser.msie && (parseInt($.browser.version) <= 7.0)) ? $('#printdlg').height() : $('#printdlg').innerHeight();
			$('#pmDlgContainer').height(parseInt(height) + 60);
            this.adaptDWin($('#pmDlgContainer'));
        }
    }

});


