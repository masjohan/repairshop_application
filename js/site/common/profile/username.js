// require jformval | juiautocomplete | juibutton
RW.ProfileUsername = function() {
  this.initForm();
}

RW.ProfileUsername.prototype.initForm = function() {
	$('form#page-form').formval({
    rules: {
      Username: {
        required: true,
        pattern: /^[\w.-]+$/,
        remote: function(ele) {
          return {
            'type': "post",
            'url': "/json/common/profile/username",
            'data': {"checkusername": ele.value},
            'custom': function(oJson) { return  oJson }
          };
        }
      },
      Username2: {
        required: true,
        equalTo: 'Username'
      }
    },
    messages: {
      Username: {
        pattern: 'It is ONLY allowed digit, letter, "." or "-"'
      }
    },
    onSuccess: function() {
      $(this).formval('ajaxUpload', function(){
        RW.notifyOK("Your account username has been updated successfully");
        return;
      });
    }
  });
}

$(function(){new RW.ProfileUsername()});