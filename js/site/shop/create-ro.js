// require sections/inline-edit.js | jformval | timepicker

RW.CreateRepairOrder = function() {
  // accept specified active
  var active = location.search.match(/\bactive=(\d)\b/);
  active = active ? parseInt(active[1]) : 0

  $( "#cus-veh-accordion" ).accordion({
    heightStyle: "content",
    collapsible: true,
    active: active
  });

  $( "#tabs" ).tabs();

  new RW.InlineEdit('#ro-edit', '/json/shop/create-ro');
  $('#ro-edit').on('success', function(evt, action){

    // fix the first column letter sequence
    var seq = 65;
    $(this).find('tr').not(':first').each(function(){
      $(this).find('td:first').text(String.fromCharCode(seq++));
    })

  });

  this.initForm();
  this.initROForm();
}

RW.CreateRepairOrder.prototype.initROForm = function() {
  $('form#ro-form').formval({
    "datetimepicker": {
      "TimeIn": true,
      "Expected": true
    }
  });
}

RW.CreateRepairOrder.prototype.initForm = function() {
	$('form#new-customer-vehicle-form').formval({
    rules: {
      Email: {
        required: false,
        email: true,
        remote: function(ele) {
          return {
            'type': "post",
            'url': "/json/shop/customer/new",
            'data': {"checkemail": ele.value, "user_id": ele.form.customer_uid.value},
            'custom': function(oJson) { return  oJson }
          };
        }
      },
      FirstName: {
        required: true
      },
      LastName: {
        required: true
      },
      Phone: {
        required: true
      },
      Postal: {
        required: true
      },
      Make: {
        required: true
      },
      Model: {
        required: true
      },
      Year: {
        required: true
      },
      Volume: {
       number: true
      },
      IniOdometer: {
        required: true,
        number: true
      }
    }
  });
}

$(function(){ new RW.CreateRepairOrder()});

