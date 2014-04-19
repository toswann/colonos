if (typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, ''); 
  }
}

if (typeof Array.prototype.forEach != 'function') {
    Array.prototype.forEach = function(callback) {
      for (var i = 0; i < this.length; i++) {
        callback.apply(this, [this[i], i, this]);
      }
    };
}