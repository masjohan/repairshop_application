// require jformval | juiautocomplete | juibutton
RW.ShopVehicle = function() {
	this.initYearAutoComp();
  this.initForm();
}

RW.ShopVehicle.prototype.initYearAutoComp = function() {
  // last 30 year
  var yearSrc = [];
  for(var i=0, n=new Date().getFullYear() + 1; i<30; i++) {
      yearSrc.push((n-i).toString());
  }
  $('form#page-form input[name=Year]')
  .autocomplete({
      'source': yearSrc
  })
  .bind('blur', function(e){
    if ($.inArray(this.value, yearSrc) == -1){
      this.value = '';
    }
  });
}

RW.ShopVehicle.prototype.initForm = function() {
	$('form#page-form').formval({
    rules: {
      Make: {
        required: true
      },
      Model: {
        required: true
      },
      Year: {
        required: true
      },
      Volume: {
       number: true
      },
      IniOdometer: {
        required: true,
        number: true
      }
    }
  });
}

$(function(){new RW.ShopVehicle()});