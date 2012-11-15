// require rw | function
RW.Popover = function (jqEx, args) {
    this.popover(jqEx);

    // overwrite those options
    this.args = $.extend({
        "width":        'auto',         	// exp: '300px',
        "height":       'auto',         	// exp: "200px"
        "zIndex":       1,			        // zindex of the container which is immediate child of body and also where popover will be put into
        "relative":     'mouse',    		// ["mouse","sender","viewport",element]
        "top":          'auto',         	// number | 'center' | 'below #'
        "bottom":       'auto',         	// number | 'center' | 'above #'
        "left":         'auto',         	// number | 'center' | 'right #'
        "right":        'auto',         	// number | 'center' | 'left #'
        "blocking":     false	      		// true or *css object
    }, args);
}

// all event handles call popover as "this"
// custom events "show" "close" handle will be called by orignal event 
RW.Popover.prototype.bindEvent = function() {
    var onContainer = function(evt, oriEvt){
            var jPop = $(this).children('div');
            $.each(jPop.data(evt.type) || [], function(_,fn){ 
                fn.call(jPop[0], oriEvt || evt);
            });
        };
    
    return function(type, fn) {
        this.container().bind(type, onContainer);
        var q = this.popover().data(type);
        if(!q) {
            this.popover().data(type,[]);
            q = this.popover().data(type);
        }
        q.push(fn);
        return this;
    };
}(); 
 
// singleton, goodguy rule: do not access "this"
RW.Popover.prototype.container = function () {
    var jContainer,     // only one container in the page,
        jBlocker,       // block UI
        oEvt,           // very last event trigger show happened
        oInst,          // the instance being shown
        
        fnReposition = function (evt){
            if (oInst) {
                oInst._position(evt);
                fnShowBlock(true);
            }
        },
        fnMouseLeaveHdl =  function (){
            if( oInst ) oInst._slowUIAct(!oInst.args.slowActOverPopover,true);
        },
        fnMouseEnterHdl =  function (){ // reposition only onMouseEnter container
            if( oInst ) oInst._slowUIAct(!oInst.args.slowActOverPopover,false);
        },
        
        fnShowBlock = function (bShow) {
            if(!oInst.args.blocking) {
                return
            } else if (bShow) {
                var css = {
                    'width': Math.max($(window).width(), $(document).width()),
                    'height': Math.max($(window).height(), $(document).height()),
                    'zIndex': oInst.args.zIndex - 1
                };
                if (typeof oInst.args.blocking === 'object') css = $.extend(oInst.args.blocking, css);
                jBlocker.css(css).show();
            } else {
                jBlocker.hide();
            }
        },
        
        // replace anthingy in container with "intc", show it and bind related event
        fnShow = function(intc,evt){
            if(oInst) fnClose(); // never should happen, but for safe

            oInst = intc;
            oEvt = evt ? {'target':evt.target, 'pageX':evt.pageX, 'pageY':evt.pageY } : null; // light copy required

            jContainer
            .prepend(oInst.popover(true))
            .css($.extend(
            	{"top": "-1000px", "left": "-1000px"},
                {'height': oInst.args.height,'width': oInst.args.width,'zIndex': oInst.args.zIndex}
            ))
            .show();
            oInst._position(oEvt);
            fnShowBlock(true);

            // bind event handle
            if(oInst.args.listenOverPopover) {
                jContainer
                .bind('mouseenter',fnMouseEnterHdl)
                .bind('mouseleave',fnMouseLeaveHdl);
            }

            if(oInst.args.relative === 'mouse' && oEvt) {
                $(oEvt.target).bind('mousemove',fnReposition);
            }
        },
        // reversely, unbind event, empty container and hide it
        fnClose = function() {
            if(oInst.args.listenOverPopover) {
                jContainer
                .unbind('mouseenter',fnMouseEnterHdl)
                .unbind('mouseleave',fnMouseLeaveHdl);
            }

            if(oInst.args.relative === 'mouse' && oEvt) {
                $(oEvt.target).unbind('mousemove',fnReposition);
            }
            
            jContainer
            .hide()
            .children().not('iframe')
                .each(function(){
                    if (this.parentNode) this.parentNode.removeChild(this);
                });
            fnShowBlock(false);

            oInst = oEvt = null;
        };
    
    return function(doElse){
        // create single one container
        if (!jContainer) {
            jBlocker = $('<div style="position:absolute;top:0px;left:0px;margin:0;border:0;padding:0;background-color:#000000"></div>')
                .css({opacity: 0.66})
                .appendTo(document.body)
                .addClass('popover-sender')
                .hide();
                
            jContainer = $('<div style="position:absolute;margin:0;border:0;padding:0;background-color:transparent" class="popover-container"></div>')
                .appendTo(document.body)
                .hide()
                // onResize container, reposition. work for IE only. not important
                .bind('resize',function(){
                    jContainer
                        .children('iframe')
                        .css({
                            'width': jContainer.width(),
                            'height': jContainer.height()
                        });
                 
                    fnReposition(oEvt);
                });
                
            // fix select leaking on IE by an underneath iframe. when ie6 die? 
            if ($.browser.msie && ($.browser.version < 7)) {
                $('<iframe style="position:absolute;top:0;left:0;z-index:-1;filter:mask();" frameborder="0" src="javascript:\'\'"></iframe>')
                    .appendTo(jContainer);
            }
 
            // on window resize, reposition. !IMPORTANT
            $(window).bind('resize scroll', function(){fnReposition(oEvt);} );

            $('body').click(function(evt){
                if(!oInst) return;
                var jClk = $(evt.target).parents().andSelf();
                if ( jClk.filter('.popover-close').length
                    || !jClk.filter('.popover-container,.popover-sender').length) {
                    oInst.close(evt);
                }
            });
            
        }
        
        if (doElse) {
            if(doElse.get && doElse.get === 'event') {
                return oEvt;

            } else if(doElse.get && doElse.get === 'instance') {
                return oInst;

            // show container with passed in instance and event
            } else if(doElse.set && doElse.set[0]) {
                fnShow(doElse.set[0], doElse.set[1]);

            // close container
            } else if(doElse.set && oInst){
                fnClose();
            }
        } 
        
        return jContainer;
    }
}();
 
RW.Popover.prototype.popover = function (jqEx) {
    //  create popover
    if(!this._jPopover && jqEx){
        this._jPopover = $(jqEx);

        // in DOM, later detach it
        if(this._jPopover.parents('body').length) {
            this._jPopover.data('delayDetach', true).hide();
        // not in dom, wrap it with <div>  
        } else if (typeof jqEx === 'string'){
            this._jPopover = $('<div class="popbd">'+jqEx+'</div>');
        }
        
    // signaled, detach from dom just before show
    } else if(this._jPopover.data('delayDetach') && jqEx === true) {
        this._jPopover.each(function(){
            if (this.parentNode) this.parentNode.removeChild( this );
        }).removeClass('hidden').removeData('delayDetach').css('display','block');

    }

    return this._jPopover;
}

// jSel: the trigger to show;  bStayOpen: default the tigger toggle the popover
RW.Popover.prototype.clickShow = function (jSel, bStayOpen) {
    $(jSel)
    .addClass('popover-sender') // for position
    .click(function (evt){

        (!bStayOpen && this.isOpen()) ? this.close(evt) : this.show(evt);
        return false;

    }.bind(this));
    return this;
}
 
RW.Popover.prototype.clickClose = function (jSel) {
    $(jSel).addClass('popover-close');
    return this;
}

//  options {
//   show_over: boolean, keep the popover open when over popover
//   show_slow: boolean, 500ms slow down. when opener and popover far apart, but still show_over
// }
RW.Popover.prototype.hoverShow = function (jSel, options) {
    var fnShow, fnClose;

    if(options && (options.show_over || options.show_slow)) {
        fnShow = this._slowUIAct.bind(this,!options.show_slow,false);
        fnClose = this._slowUIAct.bind(this,!options.show_slow,true);

    } else {
        fnShow = this.show.bind(this);
        fnClose = this.close.bind(this);
    }

    // if listen mouse enter/leave container
    this.args.listenOverPopover = !!(options && options.show_over);
    
    // if slow handle mouse enter/leave container
    this.args.slowActOverPopover = this.args.listenOverPopover && options.show_slow; 
    
    $(jSel)
    .addClass('popover-sender')
    .bind('mouseenter',fnShow)
    .bind('mouseleave',fnClose);

    return this;
}

// when listen on enter/leave popover
RW.Popover.prototype._slowUIAct =(function() {
    var fn = function (evt, bClosing){ 
            bClosing === true ? this.close(evt) : this.show(evt); 
        },
        fnHalfSec = fn.slow(500),
        fnMillSec = fn.slow(10);
    
    return function(bQuick,bClosing,evt){
        (bQuick ? fnMillSec : fnHalfSec)
        .call( this, 
            evt ? {'target':evt.target, 'pageX':evt.pageX, 'pageY':evt.pageY} : null, // light copy required
            bClosing
        );
    }
})();

// if this is open; when bPopover, if any popover open
RW.Popover.prototype.isOpen = function() {
    return this.container({'get': 'instance'}) === this;
}

RW.Popover.prototype.show = function (evt) {
    // "this" already open
    if(this.isOpen()){
        var lastShowEvt = this.container({'get': 'event'});
        // must be called programatically, do reposition 
        if(!evt) return this._position(lastShowEvt); 
        // not twice
        if(lastShowEvt && lastShowEvt.target === evt.target) return this._position(evt);
    }
    
    // close anything opened
    RW.Popover.close(evt); 

    // show time
    this.container({'set': [this, evt]}).trigger('show', evt);
    return this;
}
 
RW.Popover.prototype.close = function(evt) {
    // can only close "this"
    if (this.isOpen()) {
        // send event before close
        this.container().trigger('close', evt);
        this.container({'set': [null, null]});
    }
    return this;
}

RW.Popover.close = function(evt) {
    var inst = RW.Popover.prototype.container({'get': 'instance'});
    inst && inst.close(evt);
}

RW.Popover.isOpen = function() {
    return !!RW.Popover.prototype.container({'get': 'instance'});
}

// only ["viewport",element] without evt
RW.Popover.prototype._position = function (evt) {
    var docScrollTop = $(document).scrollTop(), 
    	docScrollLeft = $(document).scrollLeft(),
    	winHeight = $(window).height(),
    	winWidth = $(window).width(),
    	h = this.container().height(),
        w = this.container().width(),
        t, l;	// find out
 
    // relative to a dom element or sender who triggered the show,
    if(typeof this.args.relative == 'object' || (this.args.relative == 'sender' && evt)) {
            // the element to which position will be relative to
        var jRelative = typeof this.args.relative === 'object' ?
                $(this.args.relative):
                $(evt.target).parents('.popover-sender').andSelf(),
            // top,lefe,height,width
            relPosition = {
                height: jRelative.height(),
                width: jRelative.width(),
                top: jRelative.offset().top + parseInt($.curCSS(jRelative[0], "borderTopWidth", true)) + parseInt($.curCSS(jRelative[0], "paddingTop", true)),
                left: jRelative.offset().left + parseInt($.curCSS(jRelative[0], "borderLeftWidth", true)) + parseInt($.curCSS(jRelative[0], "paddingLeft", true))
            },
            matchPosi;

        if(this.args.offset) {
        	relPosition.top += this.args.offset.top;
        	relPosition.left += this.args.offset.left;
        }

        if( typeof this.args.top == 'number') {
            t = relPosition.top + this.args.top;
        } else if( typeof this.args.bottom == 'number'){
            t = relPosition.top + relPosition.height - h - this.args.bottom;
        } else if( this.args.top == 'center' || this.args.bottom == 'center'){
            t = relPosition.top + relPosition.height * 0.5 - h * 0.5;
        } else if( matchPosi = this.args.top.match(/^below\s*(-?\d+)/) ){
            t = relPosition.top + relPosition.height + parseInt(matchPosi[1]);
        } else if( matchPosi = this.args.bottom.match(/^above\s*(-?\d+)/) ){
            t = relPosition.top - h - parseInt(matchPosi[1]);
        } else {
            t = relPosition.top + relPosition.height + 1 + h > docScrollTop + winHeight
            	? relPosition.top  - h - 1
            	: relPosition.top + relPosition.height + 1;
        }

        if( typeof this.args.left == 'number') {
            l = relPosition.left + this.args.left;
        } else if( typeof this.args.right == 'number'){
            l = relPosition.left + relPosition.width - w - this.args.right;
        } else if( this.args.left == 'center' || this.args.right == 'center'){
            l = relPosition.left + relPosition.width * 0.5 - w * 0.5;
        } else if( matchPosi = this.args.left.match(/^right\s*(-?\d+)/) ){
            l = relPosition.left + relPosition.width + parseInt(matchPosi[1]);
        } else if( matchPosi = this.args.right.match(/^left\s*(-?\d+)/) ){
            l = relPosition.left - w - parseInt(matchPosi[1]);
        } else {  
            l = relPosition.left + relPosition.width + 1 + w > docScrollLeft + winWidth
            	? relPosition.left -w - 1
            	: relPosition.left + relPosition.width + 1
        }

     // relative to viewport
    } else if(this.args.relative == 'viewport'){


        if( typeof this.args.top == 'number') {
            t = docScrollTop + this.args.top;
        } else if( typeof this.args.bottom == 'number'){
            t = docScrollTop + winHeight - h - this.args.bottom;
        } else if( this.args.top == 'center' || this.args.bottom == 'center'){
            t = docScrollTop + winHeight * 0.5 - h * 0.5;
        } else {
            t = docScrollTop + 10;
        }
     
        if( typeof this.args.left == 'number') {
            l = docScrollLeft + this.args.left;
        } else if( typeof this.args.right == 'number'){
            l = docScrollLeft + winWidth - w - this.args.right;
        } else if( this.args.left == 'center' || this.args.right == 'center'){
            l = docScrollLeft + winWidth * 0.5 - w * 0.5;
        } else {  
            l = docScrollLeft + 10;
        }

    // relative to mouse, only top/left effective and try stay within viewport
    } else if(this.args.relative == 'mouse' && evt){

        if (typeof this.args.top !== 'number') this.args.top = 10;
        if (typeof this.args.left !== 'number') this.args.left = 10;
        
        if(evt.pageY <= docScrollTop + winHeight * 0.5) {
            t = evt.pageY + this.args.top;
        } else {
            t = evt.pageY - this.args.top - h;   
        }
        
        if(evt.pageX <= docScrollLeft + winWidth * 0.5) {
            l = evt.pageX + this.args.left;
        } else {
            l = evt.pageX - this.args.left - w;   
        }
    }

    this.container().css({"top": t + "px", "left": l + "px"});
    return this;
}

RW.blockUI = function(){
    $('<img src="/static/images/throbber_128.gif" width="128" height="128" style="position:absolute;left:-128px">')
    .bind('load',function(){
        RW.blockUI.blocker = new RW.Popover(
            $('<div id="uiblocker" style="color:#ffffff;"><br>Processing<span class="popover-close">&nbsp;</span>...</div>')
                .prepend($(this).css({"position":"static","left":"auto"})),
            {
                'top':'center',
                'left':'center',
                'relative': 'viewport',
                'zIndex': 15,
                'blocking': true
            }
        );
    })
    .appendTo(document.body);
    
    return function() {
        if(RW.blockUI.blocker) RW.blockUI.blocker.show();
    }
}();

RW.unblockUI = function() {
    if(RW.blockUI.blocker) RW.blockUI.blocker.close();
}