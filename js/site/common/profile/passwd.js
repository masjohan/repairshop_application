// require jformval | juiautocomplete | juibutton
RW.ProfilePassword = function() {
  this.initForm();
}

RW.ProfilePassword.prototype.initForm = function() {
	$('form#page-form').formval({
    rules: {
      PasswordOld: {
        required: true
      },
      PasswordNew: {
        required: true,
        password8: true

      },
      PasswordNew2: {
        required: true,
        equalTo: 'PasswordNew'
      }
    },
    onSuccess: function() {
      $(this).formval('ajaxUpload', function(oReply){
        if (oReply.error) {
          RW.notifyError(oReply.message);
        } else {
          RW.notifyOK("Your account password has been updated successfully");
        }
      });
    }
  });
}

$(function(){new RW.ProfilePassword()});