// require jformval
$(function() {
	$('form#admin-next-add').formval({
        rules: {
            content: {
                required: true
            },
            attachment: {
                required: true
            },
            next_mileage: {
                required: true
            },
            next_date: {
                required: true
            }
        },
        datepicker: {
            next_date: true
        }
    });
});

