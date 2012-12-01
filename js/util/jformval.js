/*
 * $('myform').formval(options) // mostly likely options can handle all the case, please see inline doc
 * $.formval.addMothod() to add extra validation method, see seperated add-mothod.js file
 *
 * Distributed under MIT license.
 *
 * jformval 1.0
 *
 * You do can call $('myform').formval('method name', arg1 ...), where method name see below
 * But, i never need to
 *
 *    isValid
 *    isEnabled
 *    isDirty
 *    enable
 *    disable
 *    focus
 *    validate
 *    setError(element, message)
 *    setChange(element)
 *    submit
 *    ajaxSubmit(cb*)
 *    ajaxUpload(cb*)
 *    destroy
 **/
(function( $, undefined ) {

	var FormVal = function (jForm, options) {
    this._options = {
      "rules": {/*
                    "input-name" : {
                      required: true,
                      minlength: #,
                      maxlength: #,
                      rangelength:  [#, #],
                      max: #,
                      min: #,
                      range: [#, #],
                      email: true,
                      url: true,
                      date: "M d, Y",
                      number: true,
                      digits: true,
                      creditcard: true
                      zipUS: true,
                      postalCA: true,
                      phoneUS: true,
                      pattern: /js regexp literal/,
                      custom: function(element){return when error ? {error:1,message:"..."} : ''; },
                      remote: function(element){
                        return {
                          'type': "get"* | "post"
                          'url': url to send ,
                          'data': {nm:val, ....} or [{name:...,value:...},]
                          'custom': function(oJson) {return when error ? {error:1,message:"..."} : ''; }
                        }
                      }
                    }
      */},
      "messages": {/*       "input-name" : {
                      required: "my required message"
                      ...
                    }
      */},
      "datepicker": {/*
                    input-name: true | options for datepaicker
      */},
      "autocomplete": {/*
                    input-name: true | options for autocomplete
      */},
      "onSuccess" : false,    // form will be submit when pass validation, UNLESS callback
      "onError" : false,      // callback when validation error occur
      "onChange" : false      // callback for any user interaction
    }

	  this._jForm = $(jForm);     // the form we are going to deal with

    // init widget early, since they likely change the values
	  $.each(options.datepicker || {}, function(name, ops){
	    this._init_datepicker(name, ops);
	  }.bind(this));
	  $.each(options.autocomplete || {}, function(name, ops){
	    this._init_autocomplete(name, ops);
	  }.bind(this));

    // form loaded with errors
	  this._jForm.find("dd.has-error").each(function(_,el){
	    this.setError(
	      $(el).find(':input')[0],
	      $(el).find('.error').html()
	    );
	  }.bind(this));

	  // capture the form submit from now on
	  this.enable();

	  // if loaded with error, do validate to show them
	  $.isEmptyObject(this._options.rules) || this.validate();

    // init event callback
    $.each({'success':'onSuccess','change':'onChange','error':'onError'}, function(evt, opEvt){
      if (options[opEvt] && typeof options[opEvt] == 'function') {
        this._jForm.unbind(evt).bind(evt, options[opEvt]);
      }
    }.bind(this));

    $.extend(true, this._options, options);

    /* dom class mean rule. A little odd, but someone just like it */
    var simpleTrue = 'required email url number digits crditcard zipUS postalCA phoneUS'.split(/\s+/);
    this._jForm.find(":text, textarea").each(function(_, ele){
      var inter = {};
      $.each($.trim($(ele).attr('class')).split(/\s+/), function(_, cls){
        if (cls && $.inArray(cls, simpleTrue) !== -1) {
          inter[cls] = true;
        }
      })
      $.isEmptyObject(inter) || (this._options.rules[ele.name]
        ? $.extend(true, this._options.rules[ele.name], inter)
        : this._options.rules[ele.name] = inter
      );
    }.bind(this));
	}

	// force an error
	FormVal.prototype.setError = function(elInput, errMsg) {
	  var elName = $(elInput).attr('name'),
	    or = {},om = {};
	  or[elName] = {'seterror' : 1};
    om[elName] = {'seterror' : errMsg};

	  $.extend(true, this._options.rules, or);
	  $.extend(true, this._options.messages, om);
	  return this;
	}

	// user interaction will call this; if you call this, it means you set the value
	FormVal.prototype.setChange = function(elInput) {
	  var cfm = this._serializeForm();

	  // do nothing if unchanged
	  if (cfm === this._currentFmValue) return;
	  this._currentFmValue = cfm;

	  // seterror got one chance ONLY
	  var elName = $(elInput).attr('name');
	  this._options.rules[elName] && delete this._options.rules[elName].seterror;

	  // remove current container error, and one for submit as well
	  $(elInput).parents("dd")
	  .add(this._jForm.find(":submit").parents("dd"))
	    .removeClass("has-error");

	  // check if dirty
	  this._initFmValue !== cfm ? this._jForm.addClass('dirty') : this._jForm.removeClass('dirty');

	  // fire change event
	  this._jForm.trigger('change', elInput);

	  return this;
	}

	FormVal.prototype._init_datepicker = function(name, options) {
		this._jForm.find(':input[name='+name+']')
		.datepicker($.extend({
			dateFormat: 'M dd, yy',
			showOtherMonths: true,
			selectOtherMonths: true,
			onSelect: function(dateText, inst){this.setChange(inst)}.bind(this)
		}, options))
    .each(function(){
      !options.keepBlank && $(this).datepicker('setDate', new Date())
    })

		.attr('readonly', 'readonly');

		return this;
	}

  FormVal.prototype._init_autocomplete = function(name, options) {
		return this;
	}

	FormVal.prototype.ajaxUpload = function(cb) {
	  var iframeId = 'ajax-target-' + Math.random(),
      that = this;

    RW.blockUI && RW.blockUI(true);

	  $('<iframe src="about:blank" id="'+iframeId+'" name="'+iframeId+'" frameborder="0" scrolling="no" border="0" height="1" width="1"></iframe>')
    .appendTo(document.body)
    .bind("load", function(){
      var elContent = this.contentDocument ||
              (this.contentWindow ? this.contentWindow.document : null) ||
              window.frames[iframeId].document;

      if (elContent.location.href == 'about:blank') return;

      RW.unblockUI && RW.unblockUI();
      var tryJson = elContent.body.innerHTML.match(/\{.*\}/),
        oJson = tryJson ? $.parseJSON(tryJson[0]) : false;

      cb && cb(oJson);

      (function(){
        that.enable();
        $('iframe#'+iframeId).remove();
      }).later(500);
    });

	  this._jForm.attr("target", iframeId);
	  return this.submit();
	}

	// formval will drive form from now on
	FormVal.prototype.enable = function (){
    if (this._isEnabled) return;

    // call this whenever form being interacted
	  var fn = function(evt) {
      var jEl = $(evt.target);
      // change form
      if (evt.type=='keyup' && jEl.is(':text, :password, textarea')
        || evt.type=='change' && jEl.is('select, :file')
        || evt.type=='click' && jEl.is(':checkbox, :radio')) {
        this.setChange(jEl[0]);
      }

      // mark as focus
      if ( 'focus mouseenter mouseover'.split(' ').indexOf(evt.type) != -1
        && (jEl.parents('dd').length || jEl.is('dd')) )
      {
        this._jForm.find('dd.focus').removeClass('focus');
        jEl.parents('dd').addClass('focus').length || jEl.addClass('focus');
      }

      // all in or out checkbox
      if (evt.type=='click' && jEl.is('.checkbox.all')) {
        this.setChange(
          jEl.parents('dd').find('.zf-form-set :checkbox').attr(
            'checked', jEl.is(':checked') ? 'checked' : false
          )[0]
        );
      }
    }.bind(this),
    slowFn = fn.slow(300);

	  // handle all user interaction with form and input fields
	  this._jForm
	    .bind('submit.formval', this.validate.bind(this).release(false))
	    .bind("keyup.formval click.formval", slowFn)
	    .find('dd')
	      .bind("mouseenter.formval",fn)
	      .end()
	    .find('select, :file')
	      .bind("change.formval", slowFn)
	      .end()
	    .find(':input')
	      .bind("focus.formval",fn);

	  // record form value
	  this._initFmValue = this._currentFmValue = this._serializeForm();
	  this._isEnabled = true;
    this.focus();
	  return this;
	}

  FormVal.prototype.isEnabled = function() {
    return this._isEnabled;
  }

	// no validation any more
	FormVal.prototype.disable = function() {
	  this._jForm
	    .unbind('submit.formval keyup.formval click.formval')
	    .find('dd')
	      .unbind("mouseenter.formval")
	      .end()
	    .find('select, :file')
	      .unbind("change.formval")
	      .end()
	    .find(':input')
	      .unbind("focus.formval");

	  this._isEnabled = false;
	  return this;
	}

	// valid when typing
	FormVal.prototype._validOnChange = function() {
    this._jForm.bind('change', function(evt, el){

	    this._jInputValidOnChange = $(el);
	    this.validate();

	  }.bind(this).slow(2000));
	}

	FormVal.prototype.focus = function (){

	  // pay more attention for error field
	  var jErr = this._jForm.find('.has-error :input'),
	    jEl = jErr.length ? jErr.eq(0) : this._jForm.find(':input').not(':hidden').eq(0),
	    top = jEl.offset() ? jEl.offset().top : 1,  // when form not on screen
	    scTop = $(document).scrollTop();

	  // if element out of viewport, animate
	  if(top < scTop || scTop + $(window).height() < top){
	    $('html,body').animate({scrollTop: top - 30}, 'slow', 'swing', function(){jEl.trigger('focus')});
	  } else {
	    jEl.trigger('focus');
	  }

	  return this;
	}

	// Check if the form has been changed since enable
	FormVal.prototype.isDirty = function(){
	  return this._initFmValue !== this._serializeForm();
	}

	//do NOT forget: before submit, disable the form validation
	FormVal.prototype.submit = function() {
		this.disable()._jForm.trigger('submit');
		return this;
	}

	FormVal.prototype.ajaxSubmit = function(cb) {
    RW.blockUI && RW.blockUI();
    $.ajax({
      url: this._jForm.attr('action'),
      type: this._jForm.attr('method'),
      data: this._jForm.serialize(),
      dataType: 'json',
      success: function(oJson) {
        RW.unblockUI && RW.unblockUI();
        cb && cb(oJson);
      }.bind(this)
    });
		return this;
	}

	// do validation, fire the result
	FormVal.prototype.validate = function() {
	  // json call on hold
	  this._jsonQueue = [];

	  // start to check each rule
	  $.each(this._options.rules, function (name, rule) {
	    var jInput = this._jForm.find(':input[name='+name+']'),

	      // ONLY NON-empty value, [{name:..., value:...},{name:..., value:...}]
	      nameValues = $.grep(
	        jInput.serializeArray().concat(
            $.map(jInput.filter('input[type=file]'), function(el){
              return {name: name, value: $(el).val()};
            })
          ),
	        function(pair){return $.trim(pair.value) && (!jInput.is('select') || pair.value != "0") }
	      );

	    // any broken rule will leave msg here
	    rule.errorMsg = false;

      // check require first, NOTE: when require==false, empty input will pass the validation
      if(rule.required !== undefined && !nameValues.length) {
        if (rule.required) {
          rule.errorMsg = (this._options.messages[name] ? this._options.messages[name].required : null)
                || "This field is required.";
        }
        return; // define required false will bypass the rest
	    }

      $.each(rule, function(criteria, expect){
        if((FormVal.methods[criteria])) {
          var check = FormVal.methods[criteria].call(this, nameValues[0] ? nameValues[0].value : null, expect, jInput[0], nameValues);
          if (check && check.error) {
            rule.errorMsg = (this._options.messages[name] ? this._options.messages[name][criteria] : null)
                    || check.message
                    || "Please fix this field.";
            return false; // break loop;
          }
        }
      }.bind(this));

	  }.bind(this));  // end of each rule check

	  // if any error
	  var isRuleBroken = false;
	  $.each(this._options.rules, function (_, rule) {if(rule.errorMsg){isRuleBroken=true;return false;}});

	  if(isRuleBroken) {
	    this._afterFailure();

	  } else if (this._jsonQueue.length){
	    this._shiftJsonQueue(); // not done yet, need json validation

	  } else {
	    this._afterSuccess();
	  }
	}

	FormVal.prototype._hasSetError = function() {
	  var hasSetError = false;

    // seterror always take priority
    $.each(this._options.rules, function (name, rule) {
      if (rule.seterror) {
        rule.errorMsg = this._options.messages[name].seterror;
        hasSetError = true;
      }
	  }.bind(this));

	  return hasSetError;
	}

	FormVal.prototype._shiftJsonQueue = function(){
	  var isBroken = false, fnResponse, queueOut = 0;

    fnResponse = function(i, oResponse) {
      var qu = this._jsonQueue[i],
        name = qu.name,
        resp = (qu.custom && typeof qu.custom == 'function')
          ? qu.custom(oResponse, this._jForm.find(':input[name='+name+']')[0])
          : oResponse;

      if(resp && resp.error) {
        this._options.rules[name].errorMsg = resp.message
                      || (this._options.rules[name].message ? this._options.rules[name].message.remote : '')
                      || 'Failed to remote check';
        isBroken = true;
      }

      queueOut++;
      if (this._jsonQueue.length == queueOut) {
        delete this._jsonQueue;
        isBroken ? this._afterFailure() : this._afterSuccess();
      }
    }

    RW.blockUI && RW.blockUI(true);
    $.each(this._jsonQueue, function(i, qu){
      $.ajax({
        url: qu.url || document.location.pathname,
        type: qu.type || "GET",
        data: qu.data,
        dataType: qu.dataType || 'json',
        success: fnResponse.bind(this, i)
      });
    }.bind(this));
	}

	FormVal.prototype._afterSuccess = function() {
    if (this._hasSetError()) return this._afterFailure();
	  this._jForm.find("dd").removeClass("has-error");
    this._isValid = this._serializeForm();


    // make form action url salty
    if (this._jForm.attr('action').match('__s_h=')) {
      if (this._options.onSuccess === false ) {
        RW.blockUI && RW.blockUI(true);
        this.submit();
      } else {
        this._jForm.trigger('success');
      }
    } else {
      RW.blockUI && RW.blockUI(true);
      $.ajax({
        url: '/json/common/signurl',
        data: {
          "url": this._jForm.attr('action') || (window.location.pathname + window.location.search),
          "json": '__s_h'
        },
        success: function(o) {
          o && o.salty && this._jForm.attr('action', o.salty);

          if (this._options.onSuccess === false ) {
            this.submit();
          } else {
            RW.unblockUI && RW.unblockUI();
            this._jForm.trigger('success');
          }

        }.bind(this),
        error: function(_, desc) {
          RW.unblockUI && RW.unblockUI();
          alert('Failed: ' + desc);
        }
      });
    }

	  return this;
	}

	FormVal.prototype._afterFailure = function() {
    RW.unblockUI && RW.unblockUI();
    this._hasSetError();  // take care all set error
	  this._jForm.find("dd").removeClass("has-error");
    this._jForm.trigger('error');
    this._isValid = false;

	  // mark all error fields
	  $.each(this._options.rules, function(name, rule){
	    if(rule.errorMsg) {
	    	this._jForm
	    	.find("dd#"+name+"-element")
	    		.addClass("has-error")
	    		.find(".error")
	    			.html(rule.errorMsg);
	    }
	  }.bind(this));

	  // if do valid on change on mark input on changing
	  if (this._jInputValidOnChange) {
	    this._jForm.find(':submit').attr('disabled','disabled');

	    // to show error message in focused and error
	    var validNm = this._jInputValidOnChange.attr('name');
	    if (this._jInputValidOnChange.parents("dd").is(".focus")
	      && this._options.rules[validNm] && this._options.rules[validNm].errorMsg ) {
	      this._jInputValidOnChange.trigger('focus');
	    }
	  } else {
	    this.focus();
	  }

	  return this;
	}

  FormVal.prototype.isValid = function() {
    return this._isValid === this._serializeForm();
  }

	// include file input in serialized form value
	FormVal.prototype._serializeForm = function() {
	  return $.param(
	    this._jForm.serializeArray().concat(
	      $.map(this._jForm.find('input[type=file]'), function(el){
	        return {
	          name: $(el).attr('name'),
	          value: $(el).val()
	        };
	      })
	    )
	  );
	}

  // take a jquery namespace
	$.fn.formval = function(options){
    // deal with one form only
		if ( this.length != 1 || !this.is('form')) return this;

		var args = Array.prototype.slice.call(arguments, 1),
      inst = this.data('formval'),
      ret;

    if (typeof options == 'object') {
      inst ? inst.enable() : this.data('formval', new FormVal(this, options));

    } else if (inst && inst[options]) {
      ret = inst[options].apply(inst, args);
      if (ret !== inst) return ret;  // return the result if not instance itself
    }

    return this;
	};

  FormVal.methods = {};
  FormVal.addMethod = function (name, method) {
    FormVal.methods[name] = method;
  }
	$.formval = FormVal;

  /* method added here are bit special, otherwise are in seperated add-method file */
  $.formval.addMethod('seterror',
    function(value, expect, element, multivalues) {
      return {
        error: 1,   // always error, that is why call set error
        message: "Please fix this field."
      };
    }
  );

  $.formval.addMethod('custom',
    function(value, expect, element) {
      return expect(element); // calll provided function, expecting {error: .., message: ...}
    }
  );

  $.formval.addMethod('remote',
    function(value, expect, element) {
      var ajaxsetup = expect(element);
      // allow to skip remote check at runtime
      ajaxsetup && this._jsonQueue.push($.extend({'name': element.name}, ajaxsetup));
    }
  );

})(jQuery);