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
        return;
      });
    }
  });
}

$(function(){new RW.CommonProfile()});