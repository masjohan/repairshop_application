// require jformval
RW.CommonProfile = function() {
  this.initForm();
}

RW.CommonProfile.prototype.initForm = function() {
	$('form#profile-form').formval({
    rules: {
      Greeting: {
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
        RW.notifyOK("Your profile informatin has been updated successfully");
      });
    }
  });
}

$(function(){new RW.CommonProfile()});