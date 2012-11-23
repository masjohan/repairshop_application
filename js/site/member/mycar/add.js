// require jformval | juiautocomplete | juibutton
RW.MyCarForm = function() {
	$('#add-my-car, #cancel-my-car')
	.button()
	.filter('#cancel-my-car')
	.bind('click',function(){
		window.location.assign('/member/mycar');
	});

	$('form#mycar-form :input[name=Year]').length && this.initYearAutoComp();
  this.initForm();
}

RW.MyCarForm.prototype.initYearAutoComp = function() {
  // last 30 year
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

RW.MyCarForm.prototype.initForm = function() {
	$('form#mycar-form').formval({
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
  required: false,
  number: true
  }
  }
  });
}

$(function(){new RW.MyCarForm()});