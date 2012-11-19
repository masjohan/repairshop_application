// require jformval |
RW.Forget = function() {
    this.initForm();
}

RW.Forget.prototype.initForm = function() {
	$('form#page-form').formval({
        rules: {
            Email: {
                required: true,
                email: true,
                remote: function(element) {
                    return {
                        'type': "post",
                        'url': "/json/common/forget",
                        'data': {"Email": element.value},
                        'custom': function(oJson) {
                            if (oJson.error) {
                                return  {error:1, message: oJson.message}
                            } else {
                                RW.notifyOK(oJson.message, 60000);
                            }
                        }
                    };
                }
            }
        },

        onSuccess: function() {
            $('form#page-form')
            .hide()
                .prev('p')
                .text('Your password reset request email has been sent. Please follow the instruction from there.');
        }
    });

    $('form#page-form-2').formval({
        rules: {
            Passwd: {
                required: true,
                password8: true
            },
            Passwd2: {
                required: true,
                password8: true,
                equalTo: "Passwd"
            }

        },

        onSuccess: function() {
            $('form#page-form-2').formval('ajaxSubmit', function(oJson){
                $('form#page-form-2')
                .hide()
                    .prev('p')
                    .html('Successed! Your password has been reset. It is time to <a href="/">login using new password</a>');
            })
        }
    });
}

$(function(){new RW.Forget()});