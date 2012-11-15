// require jformval | juibutton
RW.CarGas = function() {
	$('#add-car-log, #cancel-car-log')
	.button()
	.filter('#cancel-car-log')
	.bind('click',function(){
		window.location.assign('/member/mycar');
	});

	this.initForm();
}

RW.CarGas.prototype.initForm = function() {
    $('form#mycar-gas-form').formval({
    	rules: {
            "volume_added": {
                'required': true,
                'number': true
            },
            'mileage' : {
                'required': true,
                'number': true
            },
            "date" : {
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

$(function(){new RW.CarGas()});