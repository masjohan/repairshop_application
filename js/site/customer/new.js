// require jformval | juiautocomplete | juibutton
RW.MyCarForm = function() {
	$('#add-new').button();

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
	$('form#new-customer-form').formval({
        rules: {
            Title: {
                required: true
            },
            FirstName: {
                required: true
            },
            LastName: {
                required: true
            }
        },

        onSuccess: function() {
            $(this).formval('ajaxUpload', function(){
console.log(arguments);
return;
            });
        }
    });
}

$(function(){new RW.MyCarForm()});