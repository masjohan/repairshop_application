// require jformval |
RW.ShopSetupInfo = function() {
  this.initForm();
}

RW.ShopSetupInfo.prototype.initForm = function() {
	$('form#page-form').formval({
    rules: {
      Name: {
        required: true
      },
      Email: {
        required: true,
        email: true
      }
    },

    onSuccess: function() {
      $(this).formval('ajaxUpload', function(oJson){
        oJson.error ? RW.notifyError(oJson.message, 60000): RW.notifyOK(oJson.message, 60000);
      });
    }
  });
}

$(function(){new RW.ShopSetupInfo()});