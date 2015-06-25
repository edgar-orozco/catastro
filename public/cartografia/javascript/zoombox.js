
/******************************************************************************
 *
 * Purpose: functions related to map navigation and mouse events  
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

$.extend(PM.ZoomBox,
{
    mouseDrag: false,
    maction: null,
    rightMouseButton: false,
    downX: 0, 
    downY: 0,
    upX: 0,
    upY: 0,
    moveX: 0, 
    moveY: 0,
    refmapClick: false,
    mapcL: 0,
    mapcT: 0, 
    mapcL: 0, 
    mapcR: 0,
    isIE: (document.all) ? true : false,
    m_offsX: 0,
    m_offsY: 0,
    theMapImg: null,
    theMapImgLay: null,
    mapElem: null, 
    refElem: null,
    oMap: null,
    rMap: null,
    rBox: null,
    sBox: null,
    rCross: null,
    zb: null, 
    xCoordCont: null,
    yCoordCont: null,
    rBoxMinW: 8,  // Minimal width until to show refBox; below threshold switches to refCross
    rOffs: 13,    // offset for reference map cross, depends on image size
    showCoordinates: true,
    coordsDisplayRfactor: 0,
    coordsDisplayReproject: false,
    coordsDisplayUnits: '',
    enableWheelZoom: true,
    wheelZoomGoogleStyle: false,
    wheelZoomPointerPosition: true,
    enableKeyNavigation: true,
    combinedSelectIquery: false,
    
    
    /**
     * Start-up function added to mouseover event for map 
     */
    startUp: function() {
        this.theMapImg = $('#mapImg');
        this.theMapImgLay = $('#mapimgLayer');
        this.zb = $('#zoombox');
        this.mapElem = document.getElementById('map');
        this.refElem = document.getElementById('refmap');
        this.oMap = $('#map');
        this.rMap = $('#refmap');
        this.rBox = $("#refbox");
        this.sBox = $("#refsliderbox");
        this.rCross = $("#refcross");
        this.xCoordCont = $('#xcoord');
        this.yCoordCont = $('#ycoord');
        this.refmapClick = false;

        // Events
        this.mapElem.onmousedown = PM.ZoomBox.doMouseDown; 
        this.mapElem.onmouseup   = PM.ZoomBox.doMouseUp;
        this.mapElem.onmousemove = PM.ZoomBox.doMouseMove; 
        this.mapElem.ondblclick  = PM.ZoomBox.doMouseDblClick;
        
        // Enables actions for mouse wheel
        if (this.enableWheelZoom) {
            this.oMap.mousewheel(function(e){ PM.ZoomBox.omw(e); });
        }
        
        this.mapElem.oncontextmenu = PM.ZoomBox.disableContextMenu;

        this.setCursorMinMax('map');

    },
    
    /**
     * For mouse over reference map
     */
    startUpRef: function() {
        this.refElem = document.getElementById('refmap');
        this.rMap = $('#refmap');
        this.rBox = $("#refbox");
        this.sBox = $("#refsliderbox");
        this.rCross = $("#refcross");
        
        clearTimeout(PM.Query.iquery_timer);  // necessary for iquery mode
        this.refmapClick = true;

        this.refElem.onmousedown = this.doMouseDown; 
        this.refElem.onmouseup   = this.doMouseUp;
        this.refElem.onmousemove = this.doMouseMove;   
    
        // Enables actions for mouse wheel
        if (this.enableWheelZoom) {
            this.rMap.mousewheel(function(e){ PM.ZoomBox.omw(e); });
        }
        
        this.setCursorMinMax('refmap');
    },
    
    /**
     * Initialize keyboard navigation
     */
    initKeyNavigation: function() {
        if (this.enableKeyNavigation) {
			// keypress event doesn't work in safari & chrome
        	if ($.browser.webkit) {
        		document.onkeydown = PM.ZoomBox.kp;
        	} else {
            	if (document.all) document.onkeydown = PM.ZoomBox.kp;
                document.onkeypress = PM.ZoomBox.kp;
        	}
        }
    },
        
    /** 
     * Min and max values for mouse
     */
    setCursorMinMax: function (elem) {
        // MAP
        if (elem == 'map') {
            //var oMap = $('#map');
            this.mapcL = this.oMap.offset()['left'] + 1;
            this.mapcT = this.oMap.offset()['top'] + 1;
            this.mapcR = this.mapcL + PM.mapW;
            this.mapcB = this.mapcT + PM.mapH;
            var curelem = this.oMap;
        // REFERENCE MAP
        } else {
            //var rMap = $('#refmap');
            this.mapcL = this.rMap.offset()['left'] ; 
            this.mapcT = this.rMap.offset()['top'];
            this.mapcR = this.mapcL + PM.refW ;
            this.mapcB = this.mapcT + PM.refH ;
            var curelem = this.rMap;
        }
        
        this.offsX = curelem.offset()['left'] + 1;
        this.offsY = curelem.offset()['top'] + 1;
        
    },
    
    /**
     * Check position of mouse
     */
    checkCursorPosition: function(cX, cY) {
        if (cX >= this.mapcL && cX <= this.mapcR && cY >= this.mapcT && cY <= this.mapcB) {
            return true;
        } else {
            return false;
        }
    },
    
    /**
     * Mouse down
     */
    doMouseDown: function(e) {
        e = (e)?e:((event)?event:null);
        
        try {
            if (PM.enableRightMousePan) {
                if (e.button == 2) {
                    PM.ZoomBox.rightMouseButton = true;
                    //PM.setCursor(true, false);
                } else {
                    PM.ZoomBox.rightMouseButton = false;
                }
            }
        } catch(err) {
        	if (window.console) console.log(err);
        }
        
        PM.ZoomBox.mouseDrag = true;
        PM.ZoomBox.getDownXY(e);
        
        var downX = PM.ZoomBox.downX;
        var downY = PM.ZoomBox.downY;
        
        if (PM.ZoomBox.refmapClick) {
            if (downX < 1 || downY < 1 || downX > PM.refW || downY > PM.refH) {        // Don't go ouside of map
                return false;
            } else {
                PM.ZoomBox.moveRefBox('shift');
            }
        }

        return false;
    },
    
    
    /**
     * Mouse UP
     */
    doMouseUp: function(e) {
        e = (e)?e:((event)?event:null);
        
        PM.ZoomBox.mouseDrag = false;
        PM.ZoomBox.getUpXY(e);
        
        var upX = PM.ZoomBox.upX;
        var upY = PM.ZoomBox.upY;
        var downX = PM.ZoomBox.downX;
        var downY = PM.ZoomBox.downY;

        // Click in main map
        if (!PM.ZoomBox.refmapClick) {

            maction = PM.Map.maction;

            if (PM.ZoomBox.rightMouseButton) {
                maction = 'pan';
                //PM.Map.zoom_type = 'zoompoint';
            }
            
            if (maction == 'measure') {
                PM.Draw.measureDrawSymbols(e, upX, upY, 0);

            } else if (maction == 'pan'){
                var diffX = upX - downX;
                var diffY = upY - downY;
                // pan with click
                if (diffX == 0 && diffY == 0) {
                    var newX = upX;
                    var newY = upY;
                // pan with drag
                } else {
                    var newX = (PM.mapW / 2) - diffX ;
                    var newY = (PM.mapH / 2) - diffY;
                }
                
                PM.Map.zoombox_apply(newX, newY, newX, newY);
                
                //Reset after right-mouse pan
                PM.ZoomBox.maction = PM.Map.maction;
                PM.ZoomBox.rightMouseButton = false;
                //PM.setCursor(false, false);
            
            } else if (maction == 'click'){
                PM.Map.zoombox_apply(downX, downY, downX, downY);
                    
            } else if (maction == 'move'){
                // do nothing
                return false;

            } else {
                //alert(downX +', '+ downY +', '+ upX +', '+ upY);
                PM.Map.zoombox_apply(Math.min(downX,upX), Math.min(downY,upY), Math.max(downX,upX), Math.max(downY,upY));
            }

        // Click in reference map
        } else {
            
            if (upX < 1 || upY < 1 || upX > PM.refW || upY > PM.refH) {   // Don't go ouside of map
                //alert(upX + ' ref out');
                return false;
            } else {
                //alert(upX +', '+ upY +', '+ upX +', '+ upY);
                PM.Map.zoombox_apply(upX, upY, upX, upY);
            }
        }
        
        return false;    
 
    },
    
    /**
     * Mouse MOVE
     */
    doMouseMove: function(e) {
        e = (e)?e:((event)?event:null);
        
        PM.ZoomBox.getMoveXY(e);
        /* * Draw a zoombox when mouse is pressed and zoom-in or select function are active
           * move map layer when pan function is active
           * do nothing for all others    
           */

        var moveX = PM.ZoomBox.moveX;
        var moveY = PM.ZoomBox.moveY;
        
        // Actions in MAIN MAP
        if (!PM.ZoomBox.refmapClick) {
            maction = PM.Map.maction;
            
            if (PM.ZoomBox.rightMouseButton) {
                maction = 'pan';
            }
            
            // Display coordinates of current cursor position
            if (PM.ZoomBox.showCoordinates) PM.ZoomBox.displayCoordinates();        
                
            switch (maction) {
                //# zoom-in, select
                case 'box':
                    if (PM.ZoomBox.mouseDrag == true) { 
                        PM.ZoomBox.startZoomBox(e, moveX, moveY);
                    } else if (PM.Map.mode == 'nquery') {
                        try {
                            if (PM.ZoomBox.combinedSelectIquery) {
                                clearTimeout(PM.Query.iquery_timer);
                                PM.Query.iquery_timer = setTimeout("PM.Query.applyIquery(" + moveX + "," + moveY + ")", 300);
                            }
                        } catch(e) {
                            return false;
                        }
                    }
                    break;
        
                //# zoom-out, identify
                case 'click':
                    hideObj(_$('zoombox'));
                    break;
        
                //# pan with drag
                case 'pan':
                    hideObj(_$('zoombox'));
                    PM.ZoomBox.startPan(e, moveX, moveY);
                    break;
        
                //# measure & digitize
                case 'measure':
                case 'digitize':
                    showObj(_$('measureLayer'));
                    showObj(_$('measureLayerTmp'));
                    PM.Draw.redrawAll(moveX , moveY);                
                    break;
                    
                //# move
                case 'move':
                    if (PM.Map.mode == 'iquery') {    //# iquery
                        if(PM.Query.follow){
                            PM.Query.timer_c = 0;
                            clearTimeout(PM.Query.timer_t); // 
                            clearTimeout(PM.Query.iquery_timer);
                            $('#iqueryContainer').hidev();
                            timedCount(moveX, moveY);
                        } else{
                            clearTimeout(PM.Query.iquery_timer);
                            PM.Query.iquery_timer = setTimeout("PM.Query.applyIquery(" + moveX + "," + moveY + ")", 300);
                        }
                    }    
                    break;
                    
                default:
                    try {
                        var fct = maction + '_mmove';
                        if ($.isFunction(PM.Map[fct])) {
                            eval('PM.Map.' + fct + '(e, moveX, moveY)');
                        }
                    } catch(err) {
	                	if (window.console) console.log(err);
                    }
                    break;
            }
            
        // Actions in REFERENCE MAP
        } else {
            hideObj(_$('zoombox'));
            if (PM.ZoomBox.mouseDrag) {
                PM.ZoomBox.moveRefBox('move');
            }
        }
        
        return false;    
    },
    
    /**
     * For DOUBLE CLICK 
     * currently only used for measure function: end measure, calculate polygon area
     */
    doMouseDblClick: function(e) {
        PM.ZoomBox.getUpXY(e);
        maction = PM.Map.maction;
        if (maction == 'measure' || maction == 'digitize') {
            PM.Draw.measureDrawSymbols(e, PM.ZoomBox.upX, PM.ZoomBox.upY, 1);
        } else {
            try {
                var fct = maction + '_mdblclick';
                if ($.isFunction(PM.Map[fct])) {
                    eval('PM.Map.' + fct + '(e)');
                }
                return false;
            } catch(e) {
            	if (window.console) console.log(e);
            } 
        }
    },  
    
    

    /**
     * For MouseDown
     */
    getDownXY: function(e) {
        if (document.all) {
            eX = event.clientX;
            eY = event.clientY;
        } else {
            eX = e.pageX;
            eY = e.pageY;
        }
        // subtract offsets    
        this.downX = eX - this.offsX;
        this.downY = eY - this.offsY;

        return false;	
    },
    
    /**
     * For MouseUp
     */
    getUpXY: function(e) {
        if (document.all) {
            eX = event.clientX;
            eY = event.clientY;
        } else {
            eX = e.pageX;
            eY = e.pageY;
        }

        if (!this.refmapClick) {
            this.upX = Math.min(eX - this.offsX, PM.mapW);
            this.upY = Math.min(eY - this.offsY, PM.mapH);
        } else {
            this.upX = eX - this.offsX;
            this.upY = eY - this.offsY;
        }

        return false;
    },
    
    /**
     * For MouseMove
     */
    getMoveXY: function(e) {
        if (document.all) {
            moveX = event.clientX;
            moveY = event.clientY;
        } else {
            moveX = e.pageX;
            moveY = e.pageY;
        }
        // subtract offsets from left and top
        this.moveX = moveX - this.offsX;
        this.moveY = moveY - this.offsY;             
    },
    
    /**
     * DRAG ZOOM BOX (ZOOM IN, SELECT)
     */
    startZoomBox: function(e, moveX, moveY) {
        if (this.mouseDrag == true) {
            if (this.checkCursorPosition(moveX + this.offsX, moveY + this.offsY)) {
                var boxL = Math.min(moveX, this.downX);
                var boxT = Math.min(moveY, this.downY);
                var boxW = Math.abs(moveX - this.downX);
                var boxH = Math.abs(moveY - this.downY);

                this.zb.css({'visibility':'visible','left':boxL+'px','top':boxT+'px'}).width(boxW+"px").height(boxH+"px");  
            }
        }
        return false;
    },

    /**
     * PAN
     */
    startPan: function (e, moveX, moveY) {
        if (this.mouseDrag == true) {  
            if (this.checkCursorPosition(moveX + this.offsX, moveY + this.offsY)) {
                var mapL = moveX - this.downX;
                var mapT = moveY - this.downY;
                
                var clipT = 0;
                var clipR = PM.mapW;
                var clipB = PM.mapH;
                var clipL = 0;
                
                this.theMapImgLay.top(mapT+"px").left(mapL+"px");
            }
        }
        return false;
    },
    
    /**
     * FUNCTIONS FOR REFERENCE MAP RECTANGLE
     */
    setRefBox: function(boxL, boxT, boxW, boxH) {
        var rBox = PM.ZoomBox.rBox ? PM.ZoomBox.rBox : $("#refbox");
        var sBox = PM.ZoomBox.sBox ? PM.ZoomBox.sBox : $('#refsliderbox');
        var rCross = PM.ZoomBox.rCross ? PM.ZoomBox.rCross : $("#refcross");
        
        rBox.left(boxL + "px")
            .top(boxT + "px")
            .width(boxW + "px") //Math.max(4, boxW);
            .height(boxH + "px"); //Math.max(4, boxH);

        if (boxW < this.rBoxMinW) {
            rBox.hidev();
            rCross.showv();
            this.setRefCross(rCross, boxL, boxT, boxW, boxH);
        } else {
            rCross.hidev();
            rBox.showv();
        }

        sBox.hidev();

    },
    
    /**
     * MOVE RECTANGLE WITH MOUSE PAN
     */
    moveRefBox: function(moveAction) {
        var boxL = this.rBox.ileft();
        var boxT = this.rBox.itop();
        var boxW = this.rBox.iwidth();
        var boxH = this.rBox.iheight();
        
        if (moveAction == 'shift') {
            var newX = this.downX; 
            var newY = this.downY;        
        } else {
            var newX = this.moveX; 
            var newY = this.moveY; 
        }
        
        boxLnew = newX - (boxW / 2) - 1; 
        boxTnew = newY - (boxH / 2) - 1;
        
        if (boxLnew < 0 || boxTnew < 0 || (boxLnew + boxW) > PM.refW || (boxTnew + boxH) > PM.refH) {
            return false;
        } else {
            this.rBox.left(boxLnew+"px");
            this.rBox.top(boxTnew+"px");
            //window.status = (boxLnew + boxW + ' - ' + PM.refW);
            
            if (boxW < this.rBoxMinW) {
                this.setRefCross(this.rCross, boxLnew, boxTnew, boxW, boxH);
            }
        }
    },


    /**
     * Change position of reference cross
     * => symbol used when refbox below threshold
     */
    setRefCross: function(rCross, boxL, boxT, boxW, boxH) {	
        boxcX = parseInt(boxL) + parseInt((boxW / 2));
        boxcY = parseInt(boxT) + parseInt((boxH / 2));
        rCross.left(Math.round((boxcX - this.rOffs))+"px");
        rCross.top(Math.round((boxcY - this.rOffs))+"px");    
    },
    

    /**
     * Avoid pan etc.. via keyboard arrows in input type text etc...
     */

    doKP: function(e) {
        var doKP = true;
        var target = null;
        // all browsers:
        if (typeof(e.target) != 'undefined') {
            target = e.target;
        // IE only:
        } else if (typeof(e.srcElement) != 'undefined') {
            target = e.srcElement;
        }
        if (target) {
            if (target.type == 'text' || target.type == 'textarea') {
                doKP = false;
            }
        }
        return doKP;
    },
    
    /**
     * KEYBOARD FUNCTIONS
     * original script taken from http://ka-map.maptools.org/
     */
    kp: function(e) {
        try {
            e = (e)? e : ((event) ? event : null);
        } catch(e) {};
        if(e) {
            // Avoid pan etc.. via keyboard arrows in input type text etc...
            if (PM.ZoomBox.doKP(e)) {
            //var charCode = (e.keyCode) ? e.keyCode : e.charCode;
            //var charCode = (e.keyCode) ? e.keyCode : e.charCode;
            //console.log(e.keyCode);
				var nStep = 16;
				switch(e.keyCode){        
					case 63232://safari up arrow
					case 38://up arrow
						PM.Map.arrowpan('n');
						break;
					case 63233://safari down arrow
					case 40://down arrow
						PM.Map.arrowpan('s');
						break;
					case 63234://safari left arrow
					case 37:// left arrow
						PM.Map.arrowpan('w');
						break;
					case 63235://safari right arrow
					case 39://right arrow
						PM.Map.arrowpan('e');
						break;
					case 63276://safari pageup
					case 33://pageup
						PM.Map.gofwd();
						break;
					case 63277://safari pagedown
					case 34://pagedown
						PM.Map.goback();
						break;
					case 63273://safari home (left)
					case 36://home
						PM.Map.zoomfullext();
						break;
					case 63275://safari end (right)
					case 35://end
						break;
					case 43: // +
					//if (!navigator.userAgent.match(/Opera|Konqueror/i))  
						PM.Map.zoompoint(2, '');
						break;
					case 45: // -
						PM.Map.zoompoint(-2, '');
						break;
					case 46:// DEL: delete last point in editing mode
						if (PM.Map.maction == 'measure') {
							PM.Draw.delLastPoint();  
						} else { 	
							try {
								var fct = maction + '_delKeyPress';
								if ($.isFunction(PM.Map[fct])) {
									eval('PM.Map.' + fct + '()');
								}
							} catch(e) {
								if (window.console) console.log(e);
							}
						}
						break;
					case 27:// ESC: clear measure/digitize
						if (PM.Map.maction == 'measure') {
							PM.Draw.resetMeasure();
						} else { 	
							try {
								var fct = maction + '_EscKeyPress';
								if ($.isFunction(PM.Map[fct])) {
									eval('PM.Map.' + fct + '()');
								}
							} catch(e) {
								if (window.console) console.log(e);
							}
						}
						break;
					default:
						b=false;
				}
            }
        }
    },


    /**
     * MOUSEWHEEL FUNCTIONS (zoom in/out)
     * only works with IE
     */
    omw: function (e) {
        e = (e)?e:((event)?event:null);
        if(e) {
            try { 
                var imgxy = (PM.ZoomBox.refmapClick ? '' : (PM.ZoomBox.wheelZoomPointerPosition ? PM.ZoomBox.moveX + "+" + PM.ZoomBox.moveY : ''));
                var wInv = PM.ZoomBox.wheelZoomGoogleStyle ? -1 : 1;
            } catch(e) {
                var imgxy = '';
                var wInv = 1;
            }
            var wD = (e.wheelDelta ? e.wheelDelta : e.detail*-1) * wInv;
            
            clearTimeout(PM.resize_timer);
            if (wD < 0) {
                PM.resize_timer = setTimeout("PM.Map.zoompoint(-2,'" + imgxy + "')",300);  
                return false;
            } else if (wD > 0) {
                PM.resize_timer = setTimeout("PM.Map.zoompoint(2,'" + imgxy + "')",300);  
                return false;
            }
        }
    },
    
    /**
     * Disable right mouse context menu
     */
    disableContextMenu: function(e) {
        e = (e)?e:((event)?event:null);
        return false;
    },
    
    //
    // Resize map image while zooming with slider
    // called from sliderMove() in slider.js
    //
    /**
     * resize MAP
     */
    resizeMap: function(sizeFactor) {
        //alert(sizeFactor);
        var theMapImg = PM.ZoomBox.theMapImg;
        var theMapImgLay = PM.ZoomBox.theMapImgLay;
        var oldW = PM.mapW;
        var oldH = PM.mapH;
        var newW = oldW * sizeFactor;
        var newH = oldH * sizeFactor;
        
        var newLeft = (oldW - newW) / 2;
        var newTop  = (oldH - newH) / 2;
        
        theMapImg.width(newW+"px").height(newH+"px");
        theMapImgLay.left(newLeft+"px").top(newTop+"px");
        
        if (sizeFactor > 1) {
            var diffW = parseInt((newW - oldW) / 2);
            var diffH = parseInt((newH - oldH) / 2);
            clipT = diffH;
            clipR = diffW + oldW;
            clipB = diffH + oldH;
            clipL = diffW;

            var clipRect = 'rect(' + clipT + 'px ' 
                                   + clipR + 'px '
                                   + clipB + 'px ' 
                                   + clipL + 'px)'; 
            //window.status = clipRect;
            theMapImgLay.css('clip', clipRect).width(newW+"px").height(newH+"px");
        } 
    },

    /**
     * resize REFBOX
     */
    resizeRefBox: function(sizeFactor) {         
        var rBox = PM.ZoomBox.rBox ? PM.ZoomBox.rBox : $("#refbox");
        var sBox = PM.ZoomBox.sBox ? PM.ZoomBox.sBox : $("#refsliderbox");
        
        sBox.showv();
        //if (rBox.ileft() > 0) {
            var refBoxBorderW = 1; //refZoomBox.css('border-width');  // adapt to border width in CSS

            var oldRefW    = rBox.iwidth();
            var oldRefH    = rBox.iheight();
            var oldRefLeft = rBox.ileft();
            var oldRefTop  = rBox.itop();
            
            var newRefW = Math.round(oldRefW / sizeFactor);
            var newRefH = Math.round(oldRefH / sizeFactor);
            
            var newRefLeft = parseInt(oldRefLeft + ((oldRefW - newRefW) / 2) + refBoxBorderW);
            var newRefTop  = parseInt(oldRefTop + ((oldRefH - newRefH) / 2) + refBoxBorderW);
            
            sBox.left(newRefLeft+"px")
                .top(newRefTop+"px")
                .width(newRefW+"px")
                .height(newRefH+"px");
                
            window.status = newRefLeft + ',' + newRefTop + ',' + newRefW  + ',' + newRefH ;
        //}
    },
    
    // 
    // Functions for coodinates diplay 
    //
    /**
     * Get map coordinates for mouse move
     */
    getGeoCoords: function(mouseX, mouseY) {
        // if mouseX or mouseY are strings --> convert to integer
        mouseX = parseInt(mouseX);
        mouseY = parseInt(mouseY);
        var x_geo = PM.minx_geo + (((mouseX + 1)/PM.mapW) * PM.xdelta_geo);
        var y_geo = PM.maxy_geo - (((mouseY + 1)/PM.mapH) * PM.ydelta_geo);

        // Get mouse position in MAP coordinates 
        var mpoint = new Object();
        mpoint.x = x_geo;
        mpoint.y = y_geo;
        
        return  mpoint;
    },


    /**
     * Display map coordinates for mouse move
     */
    displayCoordinates: function() {
        var mpoint = this.getGeoCoords(this.moveX, this.moveY);
        
        // reproject coords if defined
        if (this.coordsDisplayReproject) {
            mpoint = this.transformCoordinates(this.coordsDisplaySrcPrj, this.coordsDisplayDstPrj, mpoint);
        } 
        
        // Round values (function 'roundN()' in 'measure.js')
        var px = isNaN(mpoint.x) ? '' : mpoint.x.roundTo(this.coordsDisplayRfactor);
        var py = isNaN(mpoint.y) ? '' : mpoint.y.roundTo(this.coordsDisplayRfactor);
        
        // Display in DIV  
        PM.ZoomBox.xCoordCont.html('X: ' + px + this.coordsDisplayUnits);
        PM.ZoomBox.yCoordCont.html('Y: ' + py + this.coordsDisplayUnits);
    },
    
    
    /**
     * transform map coordinates from src projection to destination projection
     */
    transformCoordinates: function(srcPrjStr, dstPrjStr, pnt) {
        var p4pnt = new Proj4js.Point(pnt.x, pnt.y);
        var srcPrj = new Proj4js.Proj(srcPrjStr);
        var dstPrj   = new Proj4js.Proj(dstPrjStr);
    
        return Proj4js.transform(srcPrj, dstPrj, p4pnt);
    }
    
    


});


