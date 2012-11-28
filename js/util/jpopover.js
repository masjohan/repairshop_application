(function( $, undefined ) {

Popover = function (jqEx, options) {
	// overwrite those options
	this.args = $.extend(true, {
		'containerCss' : {
			"width"		: '',     	// exp: '300px',
			"height"	: '',     	// exp: "200px"
			"zIndex"	: 2	    	// zindex of the container
		},
		'innerCss' : {
			"backgroundColor": "#fff",
      "border": "1px solid #666666",
      "padding": "10px"
		},
		'position' : {
			"of" 		: 'mouse',  	// ["mouse"|"trigger"|element|window, http://jqueryui.com/demos/position/]
			"my" 		: 'left top',
			"at" 		: 'left top',
			"offset" 	: '0 0',
			"collision"	: 'fit fit'
		},
    'trigger' : {
      "click" 	 : "",
      "hover"		 : "",
      "hoverdelay" : ""
    },
    'events' : {
      "show": false,        // function(evt){ "this" }
      "hide": false
    },
    'hideOnClick': ''         // selector
	}, options);

	this._popover(jqEx);

  this.args.trigger.click && this._clickShow(this.args.trigger.click);
	this.args.trigger.hover && this._hoverShow(this.args.trigger.hover, {"show_over": true});
	this.args.trigger.show && this._hoverShow(this.args.trigger.hoverdelay, {"show_over": true, "show_slow": true});

	this.args.events.show && this._bindEvent('show', this.args.events.show);
	this.args.events.hide && this._bindEvent('hide', this.args.events.hide);

  this.args.hideOnClick && $(this.args.hideOnClick).addClass('popover-close');
}

Popover.prototype.option = function(name, value) {
	if ( value === undefined ) {
		return this.args[name];
	} else {
		this.args[name] = value;
	}
}

// all event handles call popover as "this"
// custom events "show" "close" handle will be called by orignal event
Popover.prototype._bindEvent = function() {
	var onContainer = function(evt, oriEvt){
		var jPop = $(this).children('div');
		$.each(jPop.data(evt.type) || [], function(_,fn){
			fn.call(jPop[0], oriEvt || evt);
		});
	};

	return function(type, fn) {
		// once for container
		if (!this._container().data(type)) {
			this._container().bind(type, onContainer).data(type, true);
		}

		var q;
		while(!(q = this._popover().data(type))) {
			this._popover().data(type,[]);
		}
		q.push(fn);
		return this;
	};
}();

// singleton, goodguy rule: do not access "this"
Popover.prototype._container = function () {
	var jContainer,   // only one container in the page,

		oEvt,       // very last event trigger show happened
		oInst,      // the instance being shown

		fnReposition = function (evt){
			oInst && oInst._position(evt);
     	},
     	fnMouseLeaveHdl =  function (){
     		oInst && oInst._slowUIAct(!oInst.args.slowActOverPopover,true);
     	},
     	fnMouseEnterHdl =  function (){ // reposition only onMouseEnter container
     		oInst && oInst._slowUIAct(!oInst.args.slowActOverPopover,false);
     	},

    // replace anthingy in container with "intc", show it and bind related event
    fnShow = function(intc,evt){
      if(oInst) fnClose(); // never should happen, but for safe

      oInst = intc;
      oEvt = evt ? {'target':evt.target, 'pageX':evt.pageX, 'pageY':evt.pageY } : null; // light copy required

      jContainer
      .prepend(oInst._popover(true))
      .css($.extend(
        {'height':'auto', 'width':'auto', 'zIndex':'auto'},
        oInst.args.containerCss,
        {"top": "-1000px", "left": "-1000px"}
      ))
      .show();
      oInst._position(oEvt);

      // bind event handle
      if(oInst.args.listenOverPopover) {
        jContainer
        .bind('mouseenter',fnMouseEnterHdl)
        .bind('mouseleave',fnMouseLeaveHdl);
      }

      if(oInst.args.position.relative === 'mouse' && oEvt) {
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

      if(oInst.args.position.relative === 'mouse' && oEvt) {
        $(oEvt.target).unbind('mousemove',fnReposition);
      }

      jContainer.hide().children().detach();
      oInst = oEvt = null;
    };

   return function(doElse){
     // create single one container
     if (!jContainer) {
       jContainer = $('<div id="popover-container" style="position:absolute;margin:0;border:0;padding:0"></div>')
         .appendTo(document.body)
         .hide()
         // onResize container, reposition. work for IE only. not important
         .bind('resize',function(){
           fnReposition(oEvt);
         });

       // on window resize, reposition. !IMPORTANT
       $(window).bind('resize scroll', function(){fnReposition(oEvt);} );

       $('body').click(function(evt){
         if(!oInst) return;
         var jClk = $(evt.target).parents().andSelf();
         if ( jClk.is('.popover-close') || !jClk.is('#popover-container, .popover-trigger')) {
           oInst.hide(evt);
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

Popover.prototype._popover = function (jqEx) {
   //  create popover
   if(!this._jPopover && jqEx){
     this._jPopover = $(jqEx);

     // in DOM, later detach it
     if(this._jPopover.parents('body').length) {
       this._jPopover = this._jPopover.wrap('<div class="popbd" />').parent()
              .css(this.args.innerCss)
              .data('delayDetach', true).hide();
     // not in dom, wrap it with <div>
     } else if (typeof jqEx === 'string'){
       this._jPopover = $('<div class="popbd">'+jqEx+'</div>');
     }

   // signaled, detach from dom just before show
   } else if(this._jPopover.data('delayDetach') && jqEx === true) {
     this._jPopover.each(function(){
       if (this.parentNode) this.parentNode.removeChild( this );
     }).removeClass('hidden').removeData('delayDetach').css('display','block').children().css('display','block');

   }

   return this._jPopover;
}

Popover.prototype.getTrigger = function() {
  var lastShowEvt = this._container({'get': 'event'});
  return lastShowEvt ? lastShowEvt.target : null;
}

// jSel: the trigger to show;  bStayOpen: default the tigger toggle the popover
Popover.prototype._clickShow = function (jSel) {
  $(jSel).addClass('popover-trigger');

  $(document).on("click", jSel, function (evt){
    if (this.isOpen()) {
      if(this.getTrigger() === evt.target) {
        this.hide(evt);
        return;
      }
    }
    this.show(evt);
  }.bind(this).release(false));
}

//  options {
//   show_over: boolean, keep the popover open when over popover
//   show_slow: boolean, 500ms slow down. when opener and popover far apart, but still show_over
// }
Popover.prototype._hoverShow = function (jSel, options) {
	var fnShow, fnClose;

	if(options && (options.show_over || options.show_slow)) {
		fnShow = this._slowUIAct.bind(this,!options.show_slow,false);
		fnClose = this._slowUIAct.bind(this,!options.show_slow,true);

	} else {
		fnShow = this.show.bind(this);
		fnClose = this.hide.bind(this);
	}

	// if listen mouse enter/leave container
	this.args.listenOverPopover = !!(options && options.show_over);

	// if slow handle mouse enter/leave container
	this.args.slowActOverPopover = this.args.listenOverPopover && options.show_slow;

	$(jSel)
	.addClass('popover-trigger')
	.bind('mouseenter',fnShow)
	.bind('mouseleave',fnClose);
}

// when listen on enter/leave popover
Popover.prototype._slowUIAct =(function() {
	var fn = function (evt, bClosing){
			bClosing === true ? this.hide(evt) : this.show(evt);
  	},
  	fnHalfSec = fn.slow(500),
  	fnMillSec = fn.slow(10);

  return function(bQuick, bClosing, evt){
     (bQuick ? fnMillSec : fnHalfSec)
     .call( this,
       evt ? {'target':evt.target, 'pageX':evt.pageX, 'pageY':evt.pageY} : null, // light copy required
       bClosing
     );
  }
})();

// if this is open; when bPopover, if any popover open
Popover.prototype.isOpen = function() {
	return this._container({'get': 'instance'}) === this;
}

Popover.prototype.show = function (evt) {
	// "this" already open
	if(this.isOpen()){
		var lastShowEvt = this._container({'get': 'event'});
		// must be called programatically, do reposition
		if(!evt) return this._position(lastShowEvt);
		// not twice
		if(lastShowEvt && lastShowEvt.target === evt.target) return this._position(evt);
	}

	// close anything opened
	Popover.hide(evt);

	// show time
	this._container({'set': [this, evt]}).trigger('show', evt);
	return this;
}

Popover.prototype.hide = function(evt) {
	// can only close "this"
	if (this.isOpen()) {
		// send event before close
		this._container().trigger('hide', evt);
		this._container({'set': [null, null]});
	}
	return this;
}

// only ["viewport",element] without evt
Popover.prototype._position = function (evt) {
	var of, posi = this.args.position;
  if ( typeof posi.of === 'function' ){
    of = posi.of(evt);
  } else if (posi.of === 'trigger') {
		of = {"of": $(evt.target).parents('.popover-trigger').andSelf()};
	} else if (posi.of === 'mouse') {
		of = {"of": evt};
	} else {
		of = {};
	}

	this._container().position($.extend({}, posi, of));
	return this;
}

Popover.hide = function(evt) {
	var inst = Popover.prototype._container({'get': 'instance'});
	inst && inst.hide(evt);
}

Popover.isOpen = function() {
	return !!Popover.prototype._container({'get': 'instance'});
}

// take this space of "popover"
$.popover = Popover;
$.extend($.ui, { popover: Popover });

// extends jquery method
$.fn.popover = function(options){
	/* do nothing if empty */
	if ( !this.length ) return this;

	var args = Array.prototype.slice.call(arguments, 1),
		fnCallInst = function(el){
	     	var inst = $.data(el, 'popover-inst');
	     	return inst && inst[options] && inst[options].apply(inst, args);
	   	};

   	return (typeof options == 'string' && $.inArray(options, ['isOpen', 'getTrigger']) != -1)  //(options == 'isDisabled' || options == 'getDate' || options == 'widget')
		? fnCallInst(this[0])
		: this.each(function(){
      return typeof options == 'object'
        ? $.data(this, 'popover-inst', new Popover(this, options))
        : fnCallInst(this);
		});
};

})(jQuery);