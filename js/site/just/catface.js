// require popover | util/json.net.js | util/md5.js | util/modernizr-1.5.js

RW.CatFace = function() {
	if (!window._cf_ini) {
	    // for developing
	    _cf_ini={
	    	'_base':'/CatFaceServices.asmx/',
	    	'_UserGuid':'9f1858976bba42bead3b420b2efe258b'
	    };
	    // for product
	    // return null;
	} 

	// catface CSS
	$('head').append('<style type="text/css"> \
			span.segment{background-color:#ddffdd;} \
			span.segment:hover{background-color:#88ff88;} \
			#catpan.loading {background:url(/static/images/throbber_32x32.gif) no-repeat scroll center center transparent;} \
			#catpan .error {color:red} \
	</style>');
		
	// controller panel
    this.catpan = new RW.Popover('<div id="catpan" style="height:32px;" class="loading"><span class="UserName">=^.^=</span></div>', {
    	"relative": 'viewport',
    	"bottom": 	0,
    	"left": 	0,
        'zIndex': 	11,
        "width": $(window).width() * 0.7
    })
    .bindEvent('click', function(evt){
    	evt.preventDefault();
    	var jClk = $(evt.target);
    	
    	// float pan click
    }.bind(this))
    .show();
	
	// controller panel
	this.catface = new RW.Popover('content', {
        "top":      'auto',
        "left":		0,
        'zIndex':   11
    });
	
	this.catface.popover().css({"padding": "3px", "border": "1px solid #999999"});
	this.catface.container().css({"opacity": 0.9, "background-color":"#ffffff"});
		
	this.listenBody($(document.body).addClass('popover-sender'));
	
	// for each iframe from same domain listen on their body too
//	$('iframe').each(function(_, ele){
//		if (this._countEle(ele) == 'iframe') {
//			var doc = ele.contentDocument ||
//			(ele.contentWindow ? ele.contentWindow.document : null) ||
//			(ele.name ? window.frames[ele.name].document : null);
//			
//			if(doc) this.listenBody(
//				$(doc.body).addClass('popover-sender'), $(ele).offset()
//			);
//		}
//	}.bind(this));
	
	this.sendUserRequest();
}

/* size of each chunk */
RW.CatFace.chunkSize = 1000;

RW.CatFace.prototype.sendUserRequest = function() {
	this.send({
		MsgType: 'UserRequest',
		UserGuid: _cf_ini._UserGuid
	}, this.onUserResponse.bind(this));
}

RW.CatFace.prototype.onUserResponse = function(o) {
	if (!o.MsgType || o.MsgType != 'UserResponse') return;
	var jUserName = this.catpan.popover().find('#catpan').removeClass('loading').find('.UserName');
	
	jUserName.text(o.UserName);
	if (o.AllowAutoLogin) {
		this.SessionGuid = o.SessionGuid;
		this.sendCheckDocumentNeedUpload();
	} else {
		$('<span class="login">, please enter password <input type="password" style="width:70px" /></span>')
		.insertAfter(jUserName)
		.find('input')
		.keyup(this.sendUserLoginRequest.bind(this).slow(1000));
	}
}

RW.CatFace.prototype.sendUserLoginRequest = function() {
	this.send({
		MsgType: 'UserLoginRequest',
		UserGuid: _cf_ini._UserGuid,
		Password: this.catpan.popover().find('#catpan .login input').val()
	}, this.onUserLoginResponse.bind(this));
}

RW.CatFace.prototype.onUserLoginResponse = function(o) {
	if (!o.MsgType || o.MsgType != 'UserLoginResponse') return;
	var jUserName = this.catpan.popover().find('#catpan').removeClass('loading').find('.UserName');
	
	if (o.Sucess) {
		jUserName.text(o.UserName).next().remove();
		this.sendCheckDocumentNeedUpload();
	} else {
		jUserName.next().find('input').val('');
	}
}

RW.CatFace.prototype.sendCheckDocumentNeedUpload = function() {
	if (!this._dryHTML) this._dryHTML = this.dryHTML().join("");
	this.send({
		MsgType: 'CheckDocumentNeedUpload',
		SessionGuid: this.SessionGuid,
		MD5String: RW.md5(this._dryHTML),
		Url: document.location.href
	}, this.onCheckDocumentNeedUploadResponse.bind(this));
}

RW.CatFace.prototype.onCheckDocumentNeedUploadResponse = function(o) {
	if (!o.MsgType || o.MsgType != 'CheckDocumentNeedUploadResponse') return;
	if (o.NeedUpload) {
		this.sendUploadDocument();
	} else {
		this.SessionGuid = o.SessionGuid;
		this.sendClientPull();
	}
}

RW.CatFace.prototype.sendUploadDocument = function(sequence) {
	if (!this._dryHTML) this._dryHTML = this.dryHTML().join("");
	if (!sequence) sequence = 0;
	var s = this._dryHTML.substr(sequence * RW.CatFace.chunkSize, RW.CatFace.chunkSize);
	this.send({
		MsgType: "UploadDocument",
		MD5String: RW.md5(s),
		HtmlDocChunks: s,
		Url: document.location.href,
		ToBeContinue: (sequence + 1) * RW.CatFace.chunkSize < this._dryHTML.length ? 1 : 0,
		SeqId: sequence
	}, this.onUploadDocumentResponse.bind(this));
}

RW.CatFace.prototype.onUploadDocumentResponse = function(o) {
	if (!o.MsgType || o.MsgType != 'UploadDocumentResponse') return;
	if (o.PleaseContinue) {
		this.sendUploadDocument(parseInt(o.ReceivedSeqId) + 1);
	} else {
		this.SessionGuid = o.SessionGuid;
		this.sendClientPull();
	}
}

RW.CatFace.prototype.sendClientPull = function() {
	if (!this._fnOnPullResp) this._fnOnPullResp = this.onClientPullResponse.bind(this);
//	if (!this._fnPullAgain) this._fnPullAgain = RW.CatFace.prototype.sendClientPull.bind(this).slow(5000);

	this.send({
		MsgType: "ClientPullMsg",
		SessionGuid: this.SessionGuid
	}, this._fnOnPullResp, this._fnPullAgain);
}

RW.CatFace.prototype.onClientPullResponse = function(o) {
	RW.log("onClientPullResponse:" + RW.JSON.stringify(o));

	if (!o.MsgType || o.MsgType != 'ClientPullResponse') return;
	
	if (o.NextPingInterval) {
		// this._fnPullAgain = RW.CatFace.prototype.sendClientPull.bind(this).slow(o.NextPingInterval * 1000);
	}
	
	if (o.MsgList) for(var i in o.MsgList) {
		var msg = o.MsgList[i];
		if (msg.MsgType == 'DocSegMsg') {
			this.insertSegment(msg.SegStartPos, msg.SegEndPos, msg.SegId);
		}
	}
}

RW.CatFace.prototype.insertSegment = function(start, end, segId) {
	function getParentIdx(toDoc) {
		var pairTag = {}, t_parts;
		for (var i = 0; i < toDoc.length; i++) {
			t_parts = toDoc[i].match(/<(\/?)([a-z]+)(\/?)>/);
			
			if (typeof pairTag[t_parts[2]] != 'number') pairTag[t_parts[2]] = 0;
			
			if (t_parts[3] == '/') {
				;
			} else if (t_parts[1] == '/') {
				pairTag[t_parts[2]] -= 1; 
			} else {
				pairTag[t_parts[2]] += 1;
			}
			
			if (pairTag[t_parts[2]] == 1) return i;
		}
	}
	
	function getParentEle(toDoc, idx) {
		var t_idx, pairTag = {}, sibling = 0, stops=[], t_parts;
		
		for (var i = idx; i < toDoc.length; i++) {
			t_parts = toDoc[i].match(/<(\/?)([a-z]+)(\/?)>/);
			
			if (typeof pairTag[t_parts[2]] != 'number') pairTag[t_parts[2]] = 0;
			
			if (i == idx) {
				t_idx = t_parts[2];
			} else if (t_parts[3] == '/') {
				;
			} else if (t_parts[1] == '/') {
				pairTag[t_parts[2]] -= 1;
				if (t_parts[2] == t_idx ) sibling++;
			} else {
				pairTag[t_parts[2]] += 1;
			}
			
			if (pairTag[t_parts[2]] == 1) {
				stops.unshift(t_idx + (t_idx == 'body' ? '' : (':nth-child('+ (sibling + 1) +')')));

				t_idx = t_parts[2];
				pairTag[t_parts[2]] = 0;				
				sibling = 0;
			}
		}
		
		stops.unshift(t_idx);	// html
		
		return $(stops.join('>'));
	}
	
	var toDoc = this._dryHTML.substr(0,start).match(/<\/?[a-z]+\/?>/g).reverse(),
		parentIdx = getParentIdx(toDoc),
		re = new RegExp("(.*?</?[a-z]+/?>){" + (toDoc.length - parentIdx) + "}");
		parentOffset = this._dryHTML.match(re)[0].length,
		start -= parentOffset,
		end -= parentOffset,
		jParent = getParentEle(toDoc, parentIdx),
		_countEle = this._countEle,
		fromLeft = 0,
		reBuildHtml = [],

		fnMarkSeg = function(ele, tag) {
			fromLeft += typeof tag == 'string' ? (tag.length + 2) : 0;
		    $.each($(ele).contents(), function(){
		    	if (this.nodeType === 1) {
		        	var this_tag = _countEle(this);
		        	if (this_tag == 'iframe') {
		    			var doc = this.contentDocument ||
		                	(this.contentWindow ? this.contentWindow.document : null);
		        		if(!doc) return;
		
		        		leafsTxt.push('<iframe>');
		        		fnDryHTML($(doc).children('html')[0], 'html');
		        		leafsTxt.push('</iframe>');
		
		        	} else if (/\/$/.test(this_tag)) {
		        		fromLeft += this_tag.length + 2;
		        	} else if ($(this).is('span.segment')) {
		        		fnMarkSeg(this);
		        	} else if (this_tag) {
		        		fnMarkSeg(this, this_tag);
		        	}
		        	if (tag === true) reBuildHtml.push($(this).outerHTML());
	            	
		        } else if (this.nodeType === 3) {
		            var txt = $.trim((this.textContent || this.data || "")).replace(/\s+/g, ' ');
		            if (txt){
		            	fromLeft += txt.length;
	            		var chars = txt.split('');
		            	if (fromLeft > start) {
		            		chars[start + txt.length - fromLeft] = '<span class="segment '+segId+'">' + chars[start + txt.length - fromLeft];
		            		start = Number.MAX_VALUE;
		            	}
		            	if (fromLeft > end) {
		            		chars[end + txt.length - fromLeft] += '</span>';
		            		end = Number.MAX_VALUE;
		            	}
		            	if (tag === true) reBuildHtml.push(chars.join(''));
		            }		            
		        }
		    });
			fromLeft += typeof tag == 'string' ? (tag.length + 3) : 0;
		};
		
	fnMarkSeg(jParent[0], true);
	
	jParent.html(reBuildHtml.join(' '));
}

RW.CatFace.prototype.listenBody = function(bd, offset) {
	$(bd)
	.click(function(evt){
		evt.preventDefault();
		var jOver = $(evt.target);
		if (jOver.is('.popover-container, iframe') || jOver.parents('.popover-container').size()) return;
		
		
		if(jOver.is('span.segment')) {
			this.catface.args.width = jOver.width()+ 8;
			this.catface.args.relative = jOver;
			this.catface.args.offset = offset;
			this.catface.popover().html(jOver.html());
			this.catface.show(evt);
		} else {
			this.catpan.show();
		}
	}.bind(this));
}

RW.CatFace.prototype.send = function(data, cb, cbComp) {
//	new RW.JSONNET(_cf_ini._base, 'jsonp', data.MsgType, data, cb, {'complete': cbComp});

	$.ajax({
		'cache': true,
		'type': 'GET',
		'url': 'http://localhost/FacturalCAT/rec_post.php',
		'data': data,
		'success': cb,
		"complete": cbComp,
		'dataType': 'jsonp',
		'timeout': 5000
	});
}

RW.CatFace.prototype.getSelText = function () {
	var txt = '';
	if (window.getSelection) {
		txt = window.getSelection();
	} else if (document.getSelection) {
		txt = document.getSelection();
    } else if (document.selection) {
        txt = document.selection.createRange().text;
    } else return;
	document.aform.selectedtext.value =  txt;
}

RW.CatFace.prototype.getSelectionHTML = function () {
    var userSelection;
    if (window.getSelection) {
        // W3C Ranges
        userSelection = window.getSelection ();
        // Get the range:
        if (userSelection.getRangeAt)
            var range = userSelection.getRangeAt (0);
        else {
            var range = document.createRange ();
            range.setStart (userSelection.anchorNode, userSelection.anchorOffset);
            range.setEnd (userSelection.focusNode, userSelection.focusOffset);
        }
        // And the HTML:
        var clonedSelection = range.cloneContents ();
        var div = document.createElement ('div');
        div.appendChild (clonedSelection);
        return div.innerHTML;
    } else if (document.selection) {
        // Explorer selection, return the HTML
        userSelection = document.selection.createRange ();
        return userSelection.htmlText;
    } else {
        return '';
    }
}
	
RW.CatFace.prototype.textNode = function (ele){
    var leafsTxt = [$(ele).text()],
    	fnGetTextNode = function(parent) {
	        $.each($(parent).contents(), function(){
	            if (this.nodeType === 3) {
	                var text = (this.textContent || this.data || "").replace(/(^\s+|\s+$)/g, '').replace(/\s{2,}/g, ' ');
	                if(text && /[a-z]{2,}/i.test(text)) {
	                    leafsTxt.push(text);
	                    
	                    //text = text.split('').reverse().join('');
	                    //this.textContent ? (this.textContent = text) : (this.data = text);
	                }
	            } else if (this.nodeType === 1 && !$(this).is('script,style,noscript,img')) {
	            	if ($(this).is('iframe')) {
	            		var doc = this.contentDocument ||
                        	(this.contentWindow ? this.contentWindow.document : null) ||
	            			(this.name ? window.frames[this.name].document : null);	            		
	            		if(doc) fnGetTextNode(doc.body);
	            	} else {
		            	fnGetTextNode(this);
	            	}
	            }
	        });
    	};
    
    fnGetTextNode(ele);
    return leafsTxt;
}

RW.CatFace.prototype.getXPath = function(ele, xpath) {
	if (xpath === undefined) xpath = '';
	if (ele.nodeType === 3) {
		return arguments.callee(ele.parentNode, (this.textContent || this.data || "").trim().replace(/\s+/g, ' '));
	} else if (ele.nodeType === 9) {	/*ele === document*/
		return '/' + xpath;
	} else if (ele.nodeType === 1) {
		var tag = ele.tagName.toLowerCase(),
			jParent = $(ele).parent(),
			jBroSis = jParent.children(tag);
		return arguments.callee(jParent[0], tag + 
				(jBroSis.size() == 1 ? '' : ('[' + jBroSis.index(ele) + ']')) +
			'/' + xpath
		);
	}
}

// return tag for keep digging, tag/ end of search, false for skip
RW.CatFace.prototype._countEle = (function(){
	var re_samedomain = new RegExp('^' + document.location.href.match(/^https?:\/\/[\w.]+/)[0].replace(/\./g,'\\.'));

	return function (ele) {
		if ($(ele).is('#_firebugConsole, .popover-container')) return false;
		var tag = ele.tagName.toLowerCase();
		if (/script|style/.test(tag)) return false;

		if (/noscript|img|meta|embed|object|link|input|br|hr|map/.test(tag)) return tag + '/';
		
		if (tag == 'iframe' && !(ele.src=="javascript:''" || ele.src=="about:blank" || re_samedomain.test(ele.src))) {
			return tag + '/';
		}
		
		return tag;
	};
})();
	
RW.CatFace.prototype.domXpath = function(){
    var leafsTxt = [],
    	_countEle = this._countEle,
    	
	fnGetTextNode = function(ele, xpath) {
        $.each($(ele).contents(), function(){
            if (this.nodeType === 3) {
                var txt = $.trim((this.textContent || this.data || "")).replace(/\s+/g, ' ');
                if (txt) leafsTxt.push(xpath + txt);
                
            } else if (this.nodeType === 1) {
            	var tag = _countEle(this);
            	if (!tag){
            		return;
            	} else if (/\/$/.test(tag)) {
            		leafsTxt.push(xpath + tag);
            		return;
            	} 
            		
        		var jBroSis = $(this).parent().children(tag);

        		if (tag == 'iframe') {
            		var doc = this.contentDocument ||
                    	(this.contentWindow ? this.contentWindow.document : null);
            		
            		if(doc) fnGetTextNode($(doc).children('html')[0],
            				xpath + 'iframe' + 
                			(jBroSis.size() == 1 ? '' : ('[' + jBroSis.index(this) + ']') ) + '/html/'
                	);
            	} else {
	            	fnGetTextNode(this, 
	            		xpath + tag + 
            			(jBroSis.size() == 1 ? '' : ('[' + jBroSis.index(this) + ']') ) +
            			'/'
	            	);
            	}
            }
        });
	};

	fnGetTextNode($(document).children('html')[0], '/html/');
	return leafsTxt;
}

RW.CatFace.prototype.dryHTML = function(){
    var leafsTxt = [],
    	_countEle = this._countEle,

	fnDryHTML = function(ele, tag) {
    	leafsTxt.push('<'+tag+'>');
        $.each($(ele).contents(), function(){
        	if (this.nodeType === 1) {
            	var tag = _countEle(this);
            	if (tag == 'iframe') {
        			var doc = this.contentDocument ||
                    	(this.contentWindow ? this.contentWindow.document : null);
            		if(!doc) return;

            		leafsTxt.push('<iframe>');
            		fnDryHTML($(doc).children('html')[0], 'html');
            		leafsTxt.push('</iframe>');

            	} else if (/\/$/.test(tag)) {
            		leafsTxt.push('<'+tag+'>');
            	} else if (tag) {
            		fnDryHTML(this, tag);
            	}
            } else if (this.nodeType === 3) {
                var txt = $.trim((this.textContent || this.data || "")).replace(/\s+/g, ' ');
                if (txt){
                	leafsTxt.push(txt);
                } 
                
            }
        });

        leafsTxt.push('</'+tag+'>');
	};

	fnDryHTML($(document).children('html')[0], 'html');
	return leafsTxt;
}

$(function(){CAT = new RW.CatFace();});
