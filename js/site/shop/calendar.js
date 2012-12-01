// require jformval
RW.ShopCalendar = function() {
  // init popup
  this.jCalPop = $('.calendar-pop').popover({
    'containerCss' : {
      "width"		: 400
    },
    'position' : {
      "of" 		: function(evt) {
        if (!evt) return;
        var leftSide = $(evt.target).parent().index() < 3;
        return {
          "of"    : evt.target,
          "my" 		: leftSide ? 'left top' : 'right top',
          "at" 		: leftSide ? 'right top' : 'left top',
          "offset" 	: '0 0',
          "collision"	: 'fit fit'
        }
      }
    },
    'events' : {
      "show": this.onShow.bind(this),
      "hide": this.onHide.bind(this)
    }
  });

  this.initForm();

  $(document)
    .on('click','#calendar-daily-view', function(evt){
      this.jCalPop.popover('show',evt.toElement);
    }.bind(this))
    .on('click','#cal-delete', this.deleteEvent.bind(this))
    .on('click','#cal-move', this.moveEvent.bind(this))
    .on('change','select[name=FromSlot]', this.onFromChange.bind(this))
    .on('click','.calendar-nav, .phpc-date', this.loadCore.bind(this));

  this.loadCore();
}

RW.ShopCalendar.prototype.loadCore = function(evt) {
  var query = {}, url;
  if (evt && $(evt.target).is('.phpc-date')) {
    url = '/shop/calendar/daily';
    query.d = evt.target.id.substring(5); // get day from id
  } else {
    url = '/shop/calendar/monthly'; // load monthly by default
    if (evt) {
      var jEl = $(evt.target);
      query.m = jEl.attr('data-m');
      query.y = jEl.attr('data-y');
      query.d = jEl.attr('data-d');
      if (query.d) {
        url = '/shop/calendar/daily';
      }
      RW.notifyOK('loading ... ', 3000);
    }
  }

  $.ajax({
    url: url,
    data: query,
    dataType: 'html',
    success:  this.onCoreLoaded.bind(this)
  });
}

RW.ShopCalendar.prototype.onCoreLoaded = function(re) {
  $('#main-conent').html(re);
}

RW.ShopCalendar.prototype.deleteEvent = function() {
  var eventId = $('[name=EventId]').val();
  $.ajax({
    url: '/json/shop/calendar',
    type: 'GET',
    data: {delete_event: eventId},
    dataType: 'json',
    success:  this.popoverDone.bind(this)
  });
}

RW.ShopCalendar.prototype.moveEvent = function() {
  var eventId = $('[name=EventId]').val();
  this.jCalPop.data('calendar_move', eventId);

  this.jCalPop.popover('hide');
  RW.notify.bind(window, "In the middleing or moving, select free timeslots to move to", 60000).later(100);
}

RW.ShopCalendar.retrieveDayCalenar = function(elDay) {
  var dat = elDay.id.substring(5);
  if (!/^\d{4}-\d+-\d+$/.test(dat)) return;

  $.ajax({
    url: '/json/shop/calendar',
    type: 'GET',
    data: {day_calendar: dat},
    dataType: 'json',
    success: function(oRe) {
      var li = [];
      $.each(oRe.dat_cal, function(i, val){
        var disp;
        if (val.NumSlots >=4) {
          disp = [val.StartSlot+'~'+val.EndSlot, val.FirstName, val.LastName, val.Phone].join('<br>');
        } else if ( val.NumSlots ==3 ) {
          disp = [val.StartSlot+'~'+val.EndSlot, val.FirstName, val.Phone].join('<br>');
        } else if ( val.NumSlots ==2 ) {
          disp = [val.StartSlot+'~'+val.EndSlot, val.FirstName].join('<br>');
        } else {
          disp = [val.StartSlot, val.FirstName].join(', ');
        }
        li.push('<li class="event-list fake-link" id="event-'+val.Id+'">'+disp+'</li>');
      });

      $(elDay).next('ul').html(li.join(""));
    }
  });
}

RW.ShopCalendar.prototype.onShow = function(evt, pop) {
  $( ".selectable" ).selectable('disable');

  var move_cal = this.jCalPop.data('calendar_move');
  this.jCalPop.removeData('calendar_move');  // one time thing

  // query data sending back
  var query = {};
  query.free_slot = $('#calendar-daily-date').text();

  if ($(evt.target).is('li.booked')) {
    if (move_cal) {
      RW.notify("Calendar moving has been cancelled");
    }
    query.resource_id = $(evt.target).parent().attr('data-resource');
    query.event_id = $(evt.target).attr("data-event");
    $('h3', pop).html( 'Update existing event');
    $('#cal-delete', pop).show();
    $('#cal-move', pop).show();
  } else if (move_cal) {
    // no select return
    if ($(this.jCalPop.popover('getTrigger')).find(".ui-selected").length === 0) {
      this.jCalPop.popover('hide');
      RW.notify("Calendar moving has been cancelled");
      return;
    }
    query.event_id = move_cal;
    query.resource_id = $(evt.target).attr('data-resource');
    $('h3', pop).html( 'Move existing event ' );
    $('#cal-delete', pop).hide();
    $('#cal-move', pop).hide();
  } else {
    // no select return
    if ($(this.jCalPop.popover('getTrigger')).find(".ui-selected").length === 0) {
      this.jCalPop.popover('hide');
      return;
    }
    query.resource_id = $(evt.target).attr('data-resource');
    $('h3', pop).html( 'Add calendar ' + query.free_slot );
    $('#cal-delete', pop).hide();
    $('#cal-move', pop).hide();
  }
  $('[name=FirstName]').val('');
  $('[name=LastName]').val('');
  $('[name=Phone]').val('');
  $('[name=Notes]').val('');
  $('[name=EventId]').val('');  // very important
  $('[name=ResourceId]').val('');  // very important
  $('[name=FromSlot]').children().not(':first-child').remove();
  $('[name=EndSlot]').children().remove();

  $.ajax({
    url: '/json/shop/calendar',
    type: 'GET',
    data: query,
    dataType: 'json',
    success: function(oJson) {
      this.onLoadFreeSlots(oJson, pop);
    }.bind(this)
  });
  $('form#calendar-add-form').formval('enable');
}

RW.ShopCalendar.prototype.initForm = function() {
  var jForm = $('form#calendar-add-form')
  .formval({
    rules: {
      FirstName: {
        required: true
      },
      LastName: {
        required: true
      },
      Phone: {
        required: true
      },
      FromSlot: {
        required: true
      }
    },
    "onSuccess": function() {
      jForm.formval('ajaxSubmit', this.popoverDone.bind(this));
    }.bind(this)
  })
  .formval('disable');
}

RW.ShopCalendar.prototype.popoverDone = function(oRe){
  $('form#calendar-add-form')[0].reset();

  // close popup and show OK message
  this.jCalPop.popover('hide');
  (oRe.error? RW.notifyError : RW.notifyOK).bind(window, oRe.message).later(100);

  // hack for trigger one update
  $("#calendar-daily-view .phpc-date").trigger('click');
}

RW.ShopCalendar.prototype.onLoadFreeSlots = function(oJson, pop) {
  if (oJson.slots.length === 0) {
    RW.notify("No free time slots available at that day. Try the day after that.", 6000)
    return;
  }
  var optionHtml = [];
  $.each(oJson.slots, function(_, val){
    optionHtml.push('<option value="'+val.id+'">'+val.FromSlot+'</option>');
  });
  var jFrom = $('select[name=FromSlot]', pop);
  jFrom.children('option').not(':first-child').remove();
  jFrom.append(optionHtml.join(''));

  this.jFrom = jFrom;
  this.jEnd = $('select[name=EndSlot]', pop);
  this.slots = oJson.slots;

  var olEle = this.jCalPop.popover('getTrigger');
  if (oJson.viewEvent) {
    var event = oJson.viewEvent[0];
    $('[name=FirstName]').val(event.FirstName);
    $('[name=LastName]').val(event.LastName);
    $('[name=Phone]').val(event.Phone);
    $('[name=Notes]').val(event.Notes);

    // hidden value for update
    $('[name=EventId]').val(event.Id);

    // update case
    if ($(olEle).is('li.booked')) {
      $('[name=ResourceId]').val($(olEle).parent().attr('data-resource'));

      // set start slot and trigger change
      jFrom.val(event.StartSlot).trigger('change');

      // set end slot a bit later
      if (event.NumSlots > 1) {
        this.jEnd.delay(100).val(event.EndSlot);
      }
    } else if ($(olEle).is('ol.selectable')) {  // move case
      // populate slot start and end
      var selectSlots = [];
      $(olEle).find(".ui-selected").each(function(){
        selectSlots.push($(this).attr("data-slot"));
      })

      jFrom.val(selectSlots[0]).trigger('change');
      if (selectSlots.length > 1) {
        this.jEnd.delay(100).val(selectSlots.pop());
      }
      // populate resource id
      $('[name=ResourceId]').val($(olEle).attr('data-resource'));
    }
  } else {
    // populate slot start and end
    var selectSlots = [];
    $(olEle).find(".ui-selected").each(function(){
      selectSlots.push($(this).attr("data-slot"));
    })

    jFrom.val(selectSlots[0]).trigger('change');
    if (selectSlots.length > 1) {
      this.jEnd.delay(100).val(selectSlots.pop());
    }
    // populate resource id
    $('[name=ResourceId]').val($(olEle).attr('data-resource'));
  }
}

RW.ShopCalendar.prototype.onFromChange = function(){
  var i = parseInt(this.jFrom.val());
  var optionHtml = [];
  $.each(this.slots, function(_, val){
    var id = parseInt(val.id);
    if (id >= i) {
      if (id === i) {
        optionHtml.push('<option value="'+val.id+'">'+val.EndSlot+'</option>');
      } else {
        return false; // break;
      }
      i++;  // must be continous value with from
    }
  });

  this.jEnd.html(optionHtml.join(''));
}
RW.ShopCalendar.prototype.onHide = function() {
  RW.notifyClose();
  $('form#calendar-add-form').formval('disable');
  $('.selectable .ui-selected').removeClass('ui-selected');
  $( ".selectable" ).selectable('enable');
}

$(function(){RW.shopCal = new RW.ShopCalendar()});