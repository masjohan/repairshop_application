// require jformval | juiautocomplete | juibutton
RW.ShopCustomer = function() {
  this.initForm();
}

RW.ShopCustomer.prototype.initYearAutoComp = function() {
  // deal with refer id
  var yearSrc = [];
  for(var i=0, n=new Date().getFullYear() + 1; i<30; i++) {
    yearSrc.push((n-i).toString());
  }
  $('form#mycar-form input[name=year]')
    .autocomplete({
    'source': yearSrc
  })
  .bind('blur', function(e){
  	if ($.inArray(this.value, yearSrc) == -1){
  		this.value = '';
  	}
  });
}

RW.ShopCustomer.prototype.initForm = function() {
	$('form#new-customer-form').formval({
    rules: {
      Email: {
        required: false,
        email: true,
        remote: function(ele) {
          return {
            'type': "post",
            'url': "/json/shop/customer/new",
            'data': {"checkemail": ele.value},
            'custom': function(oJson) { return  oJson }
          };
        }
      },
      Title: {
        required: true
      },
      FirstName: {
        required: true
      },
      LastName: {
        required: true
      },
      Phone: {
        required: true
      }
    }
  });
}

$(function(){new RW.ShopCustomer()});