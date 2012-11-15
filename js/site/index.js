// require jquery | array | messager

fnTranslateDom = (function(){
	var fnFromNode = function(dom){

	    findLeaf = function(parent) {
	        $.each($(parent).contents(), function() {
	            if (this.nodeType === 3) {
	                var node = this,
	                    text = $.trim(this.textContent || this.data || "").replace(/\s+/g, ' ');

	                if(text && /[a-z]{2,}/i.test(text)) {
	                    google.language.translate(text, "en", google.browser_language,function(result) {
	                        if (result.translation) {
	                            node.textContent
	                            ? (node.textContent = result.translation)
	                            : (node.data = result.translation);
	                        }
	                    });
	                }
	            } else if (this.nodeType === 1 && !$(this).is('script,style,frame,iframe,textarea')) {
	                findLeaf(this);
	            }
	        });
	    };

	    findLeaf(dom);

	    $(dom).find('input[type=submit],input[type=button],:button').each(function(){
	    	var node = this,
	        	text = $.trim(this.value || "").replace(/\s+/g, ' ');

	    	if(text && /[a-z]{2,}/i.test(text)) {
	            google.language.translate(text, "en", google.browser_language,function(result) {
	                if (result.translation) {
	                    node.value = result.translation;
	                }
	            });
	    	}
	    });
	}, condition = 2;

	return function(ele){
		condition--;
		if (condition == 0 && google.browser_language && !/^en/.test(google.browser_language)) {
			fnFromNode(ele);
		}
	};
})();

//google.load("language", "1");
//google.setOnLoadCallback(function(){fnTranslateDom('html')});
//$(function(){fnTranslateDom('html')});

