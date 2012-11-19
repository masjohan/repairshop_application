/*
 * $.formval.addMethod('criteria-name',
        function(value, criteria-value, element, multivalues) {
            ...
            return {
                error: truthy       // validation fails ONLY when return.error evalue as true
                message: "..."
            };
        }
    );

    dateDE: "Bitte geben Sie ein gültiges Datum ein.",
    numberDE: "Bitte geben Sie eine Nummer ein.",
    accept: "Please enter a value with a valid extension.",
 */
$.formval.addMethod('minlength',
    function(value, expect) {
        return {
            error: !new RegExp('^.{'+ expect+',}$').test(value),
            message: "Please enter at least "+expect+" characters."
        };
    }
);
$.formval.addMethod('maxlength',
    function(value, expect) {
        return {
            error: !new RegExp('^.{0,'+ expect+'}$').test(value),
            message: "Please enter no more than "+expect+" characters."
        };
    }
);
$.formval.addMethod('rangelength',
    function(value, expect) {
        return {
            error: !new RegExp('^.{'+ expect[0]+','+ expect[1]+'}$').test(value),
            message: "Please enter a value between {0} and {1} characters long.".surplant(expect)
        };
    }
);

$.formval.addMethod('min',
    function(value, expect) {
        return {
            error: parseFloat(value) < expect,
            message: "Please enter a value greater than or equal to "+expect+"."
        };
    }
);
$.formval.addMethod('max',
    function(value, expect) {
        return {
            error: parseFloat(value) > expect,
            message: "Please enter a value less than or equal to "+expect+"."
        };
    }
);
$.formval.addMethod('range',
    function(value, expect) {
        return {
            error: parseFloat(value) > expect[1] || parseFloat(value) < expect[0],
            message: "Please enter a value between {0} and {1}.".surplant(expect)
        };
    }
);

$.formval.addMethod('pattern',
    function(value, expect) {
        return {
            error: !expect.test(value),
            message: "Invalid Format. Please check that your data."
        };
    }
);

$.formval.addMethod('email',
    function(value, expect) {
        return {
            error: !/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(value),
            message: "Please enter a valid email address."
        };
    }
);

$.formval.addMethod('cs_email', // comma seperated email
    function(value, expect) {
        var one;
        $.each(value.split(/\s*,\s*/), function(_, email){
            one = $.formval.methods.email(email, expect);
            if (one.error) {return false;}
        });
        one.message = "Please use comma to sperate each valid email address";
        return one;
    }
);

$.formval.addMethod('url',
    function(value, expect) {
        return {
            error: !/^(https?:\/\/)?(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(value),
            message: "Please enter a valid URL."
        };
    }
);

$.formval.addMethod('number',
    function(value, expect) {
        return {
            error: !/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value),
            message: "Please enter a valid number."
        };
    }
);

$.formval.addMethod('digits',
    function(value, expect) {
        return {
            error: !/^\d+$/.test(value),
            message: "Please enter only digits."
        };
    }
);

$.formval.addMethod('creditcard',
    function(value, expect) {

        var nCheck = 0,
            nDigit = 0,
            bEven = false

        value = value.replace(/\D/g, "");

        for (n = value.length - 1; n >= 0; n--) {
            var cDigit = value.charAt(n);
            var nDigit = parseInt(cDigit, 10);
            if (bEven) {
                if ((nDigit *= 2) > 9) nDigit -= 9;
            }
            nCheck += nDigit;
            bEven = !bEven;
        }

        return {
            error: nCheck % 10,
            message: "Please enter a valid credit card number."
        };
    }
);

$.formval.addMethod('equalTo',
    function(value, expect) {
        return {
            error: value != this._jForm.find(":input[name="+expect+"]").val(),
            message: "Please enter the same value again."
        };
    }
);

$.formval.addMethod('notEqualTo',
    function(value, expect) {
        return {
            error: value == this._jForm.find(":input[name="+expect+"]").val(),
            message: "Please enter the different value."
        };
    }
);

$.formval.addMethod('date',
    function(value, expect) {
        return {
            error: isNaN(Date.parse(value)),
            message: "Please enter a valid date."
        };
    }
);

$.formval.addMethod('dateISO',
    function(value, expect) {
        return {
            error: !/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(value) || isNaN(Date.parse(value)),
            message: "A ISO date should be format: yyyy-mm-dd or yyyy/mm/dd"
        };
    }
);

$.formval.addMethod('postalCA',
    function(value, expect) {
        return {
            error: !/^[A-Z][0-9][A-Z] *[0-9][A-Z][0-9]$/.test(value),
            message: "Please input a Canadian postal code."
        };
    }
);

$.formval.addMethod('zipUS',
    function(value, expect) {
        return {
            error: !/^\d{5}(-\d{4})?$/.test(value),
            message: "Please input a U.S. zip code."
        };
    }
);

$.formval.addMethod('phoneUS',
    function(value, expect) {
        return {
            error: !/^(1[-. ]?)?(\([2-9]\d{2}\)|[2-9]\d{2})[-. ]?[2-9]\d{2}[-. ]?\d{4}$/.test(value),
            message: "Please specify a valid phone number."
        };
    }
);

$.formval.addMethod('password8',
    function(value, expect) {
        return {
            error: !(/[A-Z]/.test(value) && /\d/.test(value) && /.{8,}/.test(value)),
            message: "8+ chars including one CAPTIAL, 1 digit."
        };
    }
);