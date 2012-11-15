Array.prototype.grep = function(fn) {
	var ret = [];
	for(var i=0, n=this.length; i<n ; i++){
		if(fn(this[i], i)) ret.push(this[i]);
	}
	return ret;
}

Array.prototype.unique = function() {
    var p = 0, i=1, n=this.length, r;
    
    if (n < 2) return;

    typeof(this[0]) == "number" ? this.sort(function(a,b){return a-b}) : this.sort();
    
    for (r = [0, n, this[0]]; i<n; i++) if (this[p] !== this[i]) {
        r.push(this[i]);
        p = i;
	}

    Array.prototype.splice.apply(this, r);
    return this;
}

Array.prototype.map = function(fn) {
	var ret = [], val;
	for(var i=0, n=this.length; i<n ; i++){
		val = fn(this[i], i);
		if(val!= null) ret.push(val);
	}
	return Array.prototype.concat.apply([],ret);
}

Array.prototype.max = function(){
    return Math.max.apply(Math, this);
}
    
Array.prototype.min = function(){
    return Math.min.apply(Math, this);
}
    
