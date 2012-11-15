// require jquery

if (!window.RW) window.RW = {};

// converting JSON text <==> JavaScript data
RW.JSON = {
    "stringify": function(data) {
        var sJson = [], tmp;

        if (typeof data == 'number') {
            return data;
        } else if (typeof data == 'string') {
            return '"' + data.replace('"','\\"') +'"';
        } else if (typeof data == 'boolean') {
            return data ? 1 : 0 ;
        } else if (data instanceof Array) {
            for(var i in data) {
                tmp = arguments.callee(data[i]);
                if (tmp !== undefined) sJson.push(tmp);
            }
            return "[" + sJson.join(",") + "]";
        } else if (data instanceof Object) {
            for(var i in data) if(data.hasOwnProperty(i)) {
            	tmp = arguments.callee(data[i]);
                if (tmp !== undefined) sJson.push('"'+i+'":'+tmp);
            }
            return "{" + sJson.join(",") + "}";
        }
        return undefined;
    }
};

RW.log = (typeof console !== 'undefined') ? function(s){console.log(s)} : function(){};

// disable ajax cache
$.ajaxSetup({"cache" : false});

jQuery.fn.outerHTML = function(s) {
	return (s)
	? this.before(s).remove()
	: jQuery("<p>").append(this.eq(0).clone()).html();
}
