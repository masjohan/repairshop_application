// require jformval | juibutton
RW.CarLogForm = function() {
	$('#add-car-log, #cancel-car-log')
	.button()
	.filter('#cancel-car-log')
	.bind('click',function(){
		window.location.assign('/member/mycar');
	});

	this.initForm();
}

RW.CarLogForm.prototype.initForm = function() {
    $('form#mycar-log-form').formval({
    	rules: {
            "date" : {
                'required': true
            },
            'mileage' : {
                'required': true,
                'number': true
            },
            "content": {
                'required': true
            },
            'cost' : {
                'required': false,
                'number': true
            }
        },
        'datepicker' : {
            "date" : {
                "maxDate": '0d',
                "minDate": '-1y'
            }
        }
    });
}

$(function(){new RW.CarLogForm()});