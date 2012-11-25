// require jformval | juiautocomplete | juibutton
RW.ProfileEmail = function() {
  this.initForm();
}

RW.ProfileEmail.prototype.initForm = function() {
	$('form#page-form').formval({
    rules: {
      Email: {
        required: true,
        email: true,
        remote: function(ele) {
          return {
            'type': "post",
            'url': "/json/common/profile/email",
            'data': {"checkemail": ele.value},
            'custom': function(oJson) { return  oJson }
          };
        }
      },
      Email2: {
        required: true,
        equalTo: 'Email'
      }
    },

    onSuccess: function() {
      $(this).formval('ajaxUpload', function(){
        RW.notifyOK("Your account email has been updated successfully");
        return;
      });
    }
  });
}

$(function(){new RW.ProfileEmail()});