String.prototype.truncate = function(n, suffix) {
    var matches = this.match(new RegExp('^(.{' + n + '})(.*)$'));
    if (matches && matches[2]) {
        if(/\w$/.test(matches[1]) && /^\w/.test(matches[2])) {
            matches[1] = matches[1].replace(/\w+$/,'');
        }
        return matches[1] + (suffix || '...');
    }
    return this.toString();
}

String.prototype.trim = function(){
    return this.replace(/(^\s+|\s+$)/g, '');
}

String.prototype.commify = function() {
    return this.replace(/(\d{1,3})(?=(?:\d{3})+(?!\d))/g,"$1,");
}

String.prototype.uppercaseFirst = function() {
    return this.replace(/\b(\w)/g, function(_, m){
        return m.toUpperCase();
    });
}

// replace "{something}" with O.something
String.prototype.surplant = function(o) {
    var fn = (typeof o == "function") ? o : function(a,b) {
        return o[b] === undefined ? a : o[b];
    };
    return this.replace(/\{(\w+)\}/g, fn);
}
