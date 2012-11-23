// require jformval |
RW.MarketShopNew = function() {
  this.initForm();
}

RW.MarketShopNew.prototype.initForm = function() {
  var newUser;

	$('form#market-shop-form').formval({
    rules: {
      Name: {
        required: true
      },
      Email: {
        required: true,
        email: true,
        remote: function() {
          return {
            'type': "post",
            'url': "/json/market/shop/new",
            'data': $('form#market-shop-form').serialize(),
            'custom': function(oJson) {
              if (oJson.error) {
                return  {error:1, message: oJson.message }
              } else {
                newUser = oJson;
                RW.notifyOK("New shop <b>" + oJson.shop + "</b> has been created successfully");
              }
            }
          };
        }
      }
    },

    onSuccess: function() {
      // hide form and show result
      $('form#market-shop-form, p.form-blurb').hide();
      $('p.success').show().find('.link').text(newUser.link);
    }
  });
}

$(function(){new RW.MarketShopNew()});