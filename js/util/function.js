if (typeof Object.beget !== 'function') {
   Object.beget = function (o) {
     var F = function () {};
     F.prototype = o;
     return new F();
   };
}

Function.prototype.bind = function(callThis) {
  var fn = this,
    args = [].slice.call(arguments, 1);
  return function() {
    var callArgs = args.concat([].slice.call(arguments));
    if (this !== window) callArgs.push(this);
    return fn.apply(callThis, callArgs);
  }
}

Function.prototype.extend = function (parent) {
	var F = function(){};
	F.prototype = parent.prototype;
	this.prototype = new F();
	this.prototype.constructor = this;
	this.prototype._super = function(method/*args*/){
    return parent.prototype[method].apply(this, [].slice.call(arguments, 1));
  };
  return this;
}

// take the function flow
Function.prototype.later = function (msec) {
  return window.setTimeout(this, msec);
}

Function.prototype.release = function (val) {
  var fn = this;
  return function(){
    var args = [].slice.call(arguments), that = this;
    (function(){fn.apply(that, args)}).later(1);
    return val;
  };
}

Function.prototype.slow = function (msec, immediate) {
  var fn = this,
    tm = 0,
    calmDn = function(args){fn.apply(this, args); tm = 0;};

  return function(){
    if(immediate && !tm) {
      tm = (function(){tm = 0;}).later(msec);
      fn.apply(this, [].slice.call(arguments));
    } else {
      tm && clearTimeout(tm);
      tm = calmDn.bind(this, [].slice.call(arguments)).later(msec);
    }
  }
}

//Function.prototype.method = function (name, func) {
//  this.prototype[name] = func;
//  return this;
//};
