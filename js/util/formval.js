// require rw | function
/*  new RW.FormVal('.myform', {
        required: 1,
        regexp: /js regexp literal/,
        minlen: #, min string len
        maxlen: #, max string len
        helperCb: function(jInput){return when error ? {error:1,message:"..."} : ''; }, 
        jsonCb: function(jInput){
            return {
                'get or post':'url',
                'data': {nm:val, ....} or [{name:...,value:...},]
                'helperCb': function(oJson) {return when error ? {error:1,message:"..."} : ''; }
            }
        },
        message: {
            required: "...", optional nice to have
            regexp: "...", optional nice to have
            minlen: "...", optional nice to have
            maxlen: "...", optional nice to have
        }
    }
*/
RW.FormVal = function (jForm, oRules) {
    // the form we are going to deal with
    this._jForm = $(jForm);
    if (!this._jForm.is('form') || this._jForm.length != 1) return null;
            
    // the form will be validate again these rule
    this._rules = {};
    
    // form loaded with errors
    this._jForm.find(".field-container.has-error").each(function(_,el){
        this.setError(
            $(el).find(':input')[0],
            $(el).find('.field-error').html()
        );
    }.bind(this));
    
    // capture the form submit from now on
    this.initialize();

    // at this moment, rule are all loaded error
    $.isEmptyObject(this._rules) ? this.focus() : this._validate(); 

    // combine rules
    $.extend(true, this._rules, oRules);
}

// force an error
RW.FormVal.prototype.setError = function(elInput, errMsg) {
    var elName = $(elInput).attr('name'),
        o = {};
    o[elName] = {
        'seterror' : 1,
        'message' : {'seterror' : errMsg }
    };        
    $.extend(true, this._rules, o);
    return this;
}

// user interaction will call this; if you call this, it means you set the value
RW.FormVal.prototype.setChange = function(elInput) {
    var cfm = this._serializeForm();

    // do nothing if unchanged
    if (cfm === this._currentFmValue) return;
    this._currentFmValue = cfm;
    
    // seterror got one chance ONLY
    var elName = $(elInput).attr('name');
    this._rules[elName] && delete this._rules[elName].seterror;

    // remove current container error, and one for submit as well
    $(elInput).parents(".field-container")
    .add(this._jForm.find(":submit").parents(".field-container"))
        .removeClass("has-error");
    
    // check if dirty
    this._initFmValue !== cfm ? this._jForm.addClass('dirty') : this._jForm.removeClass('dirty');

    // fire formval_change event
    this._jForm.trigger('formval_change', elInput);

    return this;    
}

// custom events "success", "formval_change" and any standard events
RW.FormVal.prototype.bindEvent = function(types, fn) {
    this._jForm.bind(types, fn);
    return this;
}

// return RE literal, welcome contribution
RW.FormVal.getRE = function(type) {
  var allPatterns = {
    "float": /^-?(\d+\.?\d*|\d*\.\d+)$/,
    "number": /^[-+]?\d+$/,
    "email": /^[\w.%+-]+@([\w-]+\.)+[A-Za-z]{2,4}$/,
    "phone": /^\d+\s+(\(\d+\)\s+)?[\d-]{6,}(\s+ext.*)?$/,
    "url": /^https?:\/(\/[\w.-]+)+\/?(\?\w+=?[\w%.{}-]*(&\w+=?[\w%.{}-]*)*)?$/    
  };   
  
  return allPatterns[type];
} 
RW.FormVal.prototype.getRE = RW.FormVal.getRE;

RW.FormVal.ajaxUpload = function (formSel, cb) {
    var iframeId = 'ajax-target-' + new Date().getTime().toString();
    
    $('<iframe src="about:blank" id="'+iframeId+'" name="'+iframeId+'" frameborder="0" scrolling="no" border="0" height="1" width="1"></iframe>')
        .appendTo(document.body)
        .bind("load", function(){
            var elContent = this.contentDocument ||
                          (this.contentWindow ? this.contentWindow.document : null) ||
                          window.frames[iframeId].document,
                oResponse;

            if (elContent.location.href == 'about:blank') return;

            try {
                oJSON = $.parseJSON(elContent.body.innerHTML.match(/\{.*\}/)[0]);
                cb(oJSON);
                (function(){$('iframe#'+iframeId).remove()}).later(500);

            } catch(err) {}
        });
    
    $(formSel).attr("target", iframeId);
}

RW.FormVal.prototype.ajaxUpload = function(cb) {
    RW.FormVal.ajaxUpload(this._jForm, cb);
    return this;
}

// capture the form submit and do validate
RW.FormVal.prototype.initialize = function (){
    var fn = this._onFormInteract.bind(this);

    // listen on form
    this._jForm
        .bind('submit.formval',function(evt){
                evt.preventDefault();
                this._validate.bind(this).later(1);
                return false;
            }.bind(this))
        .bind("keyup.formval click.formval",fn)
        .find('select, :file')
            .bind("change.formval",fn)
            .end()
        .find(':text, :password, textarea, select, :checkbox, :radio, :submit')
            .bind("focus.formval blur.formval",fn);
        
    // record form value
    this._initFmValue = this._currentFmValue = this._serializeForm();
    
    return this;
}

// no validation any more
RW.FormVal.prototype.deinitialize = function() {
    this._jForm
        .unbind('submit.formval keyup.formval click.formval')
        .find('select')
            .unbind("change.formval")
            .end()
        .find(':text, :password, textarea, select, :checkbox, :radio, :submit')
            .unbind("focus.formval blur.formval");
            
    return this;
}

// valid when typing
RW.FormVal.prototype.validOnChange = function() {
    this._jForm
        .unbind('submit.formval')
        .find(':submit')
            .attr('disabled','disabled');
            
    var fnSlowValidate = this._validate.bind(this).slow(2000);        
    return this.bindEvent('formval_change', function(evt, el){
        this._jInputValidOnChange = $(el);
        fnSlowValidate();
    }.bind(this));
}

RW.FormVal.prototype.focus = function (){
    // pay more attention for error field
    var jErr = this._jForm.find('.has-error :input'),
        jEl = jErr.length ? jErr.eq(0) : this._jForm.find(':input').not(':hidden').eq(0),
        top = jEl.offset().top, 
        scTop = $(document).scrollTop();
    
    // if element out of viewport, animate
    if(top < scTop || scTop + $(window).height() < top){
        $('html,body').animate({scrollTop: top - 30}, 'slow', 'swing', function(){jEl.trigger('focus')});
    } else {
        jEl.trigger('focus');
    }
   
    return this;
}

// Check if the form has been changed since initialize
RW.FormVal.prototype.isDirty = function(){
    return this._initFmValue !== this._serializeForm();
}

// do validation, fire the result
RW.FormVal.prototype._validate = function() {
    // json call on hold
    this._jsonQueue = [];
    
    // start to check each rule
    $.each(this._rules, function (name, rule) {
        var // find the input to which rule apply
            jInput = this._jForm.find(':input[name='+name+']'),
            
            // ONLY NON-empty value, [{name:..., value:...},{name:..., value:...}]
            nameValues = $.grep(
                jInput.not('.inactive').serializeArray(),
                function(pair){return !!$.trim(pair.value)}
            ),
            
            // response from helpCb
            helperMsg;
        
        // any broken rule will leave msg here
        rule.errorMsg = false;

        /* RULE server error */
        if(rule.seterror) {
            rule.errorMsg = (rule.message ? rule.message.seterror : '') || 'server error';

        /* RULE required */
        } else if(rule.required && !nameValues.length) {
            rule.errorMsg = (rule.message ? rule.message.required : '') || ("Please enter your " + jInput.parents('.field-container').find('.field-label').text().toLowerCase());

        /* RULE regexp */
        } else if (nameValues.length && rule.regexp &&
            $.grep(nameValues, function(oPair){return rule.regexp.test(oPair.value)===false;}).length) {
            rule.errorMsg = (rule.message ? rule.message.regexp : '') || "Format is wrong";      
      
        /* RULE minlen for string or multi selector */
        } else if (nameValues.length && rule.minlen
            && jInput.is(':text, :password, textarea') 
            && jInput.val().length < rule.minlen) {
            rule.errorMsg = (rule.message ? rule.message.minlen : '') || ("Length has to >= " + rule.minlen);

        /* RULE maxlen for string or multi selector */
        } else if(nameValues.length && rule.maxlen 
            && jInput.is(':text, :password, textarea') 
            && jInput.val().length > rule.maxlen) {
            rule.errorMsg = (rule.message ? rule.message.maxlen : '') || ("Length has to <= " + rule.maxlen);      
            
        /* RULE helperCb */
        } else if (rule.helperCb && (helperMsg = rule.helperCb(jInput)) && helperMsg.error){
            rule.errorMsg = helperMsg.message || (rule.message ? rule.message.helperCb : '') || 'Failed to helper check';      

        /* RULE jsonCb, on hold in this._jsonQueue */
        } else if (rule.jsonCb && (params = rule.jsonCb(jInput))) {
            this._jsonQueue.push($.extend({'name': name}, params));
        }
    }.bind(this));  // end of each rule check

    // Result, if any error
    var isRuleBroken = false;
    $.each(this._rules, function (name, rule) { if(rule.errorMsg){isRuleBroken=true;return false;}});

    if(isRuleBroken) {
        this._afterFailure();

    // if need json validation
    } else if (this._jsonQueue.length){
        this._shiftJsonQueue();

    // happy end
    } else {
        this._afterSuccess();
    }

}

RW.FormVal.prototype._shiftJsonQueue = (function(){
    var fnResponse;
    
    return function() {
        // create singleton response function used only here
        if (!fnResponse) {
            fnResponse = (function(oResponse) {
                // remove first from queue
                var qu = this._jsonQueue.shift(),
                    name = qu.name,
                    resp = qu.helperCb 
                        ? qu.helperCb(oResponse, this._jForm.find(':input[name='+name+']')) 
                        : oResponse;
                    
                if(resp && resp.error) {
                    this._rules[name].errorMsg = resp.message 
                        || (this._rules[name].message ? this._rules[name].message.jsonCb : '') 
                        || 'Failed to ajax check';
                    this._afterFailure();
                } else {
                    this._shiftJsonQueue();
                }
            }).bind(this);
        }
        
        // start with the queue head
        if (this._jsonQueue.length) {
            var qu = this._jsonQueue[0];
            $.ajax({
                url: qu.post || qu.get,
                type: qu.post ? "post" : "get",
                data: qu.data,
                dataType: qu.dataType || 'json',
                success: fnResponse
            });
        } else {
            this._afterSuccess();
        }    
    }
})();

RW.FormVal.prototype._afterSuccess = function() {
    this._jForm.find(".field-container").removeClass("has-error");

    if (this._jInputValidOnChange) {
        this._jForm.find(':submit').removeAttr('disabled');

    } else {
        var hdls = this._jForm.data('events');

        if (hdls && hdls.success) {
            this._jForm.trigger('success');
        } else {
            this.submit();
        }
    }

    return this;
}

// do NOT forget: before submit, disable the form validation
RW.FormVal.prototype.submit = function() {
    this.deinitialize();
    this._jForm.trigger('submit');
    return this;
}

RW.FormVal.prototype._afterFailure = function() {
    this._jForm.find(".field-container").removeClass("has-error");
    
    // mark all error fields
    $.each(this._rules,function(name, rule){
        if(rule.errorMsg) this._jForm.find(':input[name='+name+']')
            .parents(".field-container").addClass("has-error");
    }.bind(this));

    // if do valid on change on mark input on changing
    if (this._jInputValidOnChange) {
        this._jForm.find(':submit').attr('disabled','disabled');
        
        // to show error message in focused and error
        var validNm = this._jInputValidOnChange.attr('name');
        if (this._jInputValidOnChange.parents(".field-container").is(".focus")
            && this._rules[validNm] && this._rules[validNm].errorMsg ) {
            this._jInputValidOnChange.trigger('focus');
        }
    } else {
        this.focus();
    }

    return this;
}

RW.FormVal.prototype._onFormInteract = function(evt) {
    var jEl = $(evt.target),
        jContainer = jEl.parents('.field-container');
    
    // click on error prompt icon, focus the field
    if(evt.type=='click' && jEl.is('.error-icon')) {
        jContainer.find(':input').eq(0).trigger('focus');
        
    // change form, turn off this field error
    } else if (evt.type=='keyup' && jEl.is(':text, :password, textarea') 
            || evt.type=='change' && jEl.is('select, :file')
            || evt.type=='click' && jEl.is(':checkbox, :radio')) {
        this.setChange(jEl[0]);

    // focus has-error field, show error
    } else if (evt.type=='focus' && jEl.is(':input')) {
        if (jContainer.addClass('focus').is(".has-error")) {
            jContainer
            .addClass('show-error') // deprecated  
            .find(".field-error")
                .html(this._rules[jEl.attr('name')].errorMsg || "unkown error");
        }

        this._jForm.trigger('formval_focus', [jEl[0]]);

    // blur has-error field, hide error
    } else if (evt.type=='blur' && jEl.is(':input')) {
        jContainer.removeClass('focus show-error');
        this._jForm.trigger('formval_blur', [jEl[0]]);
    }
}

// include file input in serialized form value
RW.FormVal.prototype._serializeForm = function() {
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
