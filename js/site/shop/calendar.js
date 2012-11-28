// require jformval
RW.ShopCalendar = function() {
  // init popup
  this.jCalPop = $('.calendar-pop').popover({
    'containerCss' : {
      "width"		: 400
    },
    'position' : {
      "of" 		: function(evt) {
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
    'trigger' : {
      "click" : '.phpc-date'
    },
    'events' : {
      "show": this.onShow.bind(this),
      "hide": this.onHide.bind(this)
    }
  });

  this.initForm();

  $(document)
    .on('click','.day-calendar', this.viewEvent.bind(this))
    .on('click','#cal-delete', this.deleteEvent.bind(this))
    .on('click','#cal-move', this.moveEvent.bind(this))
    .on('change','select[name=FromSlot]', this.onFromChange.bind(this))
    .on('click','.calendar-nav', this.loadCore.bind(this));

  this.loadCore();
}

RW.ShopCalendar.prototype.loadCore = function(evt) {
  var query = {};
  if (evt) {
    var jEl = $(evt.target);
    query.m = jEl.attr('data-m');
    query.y = jEl.attr('data-y');
    RW.notifyOK('loading ... ', 3000);
  }
  $.ajax({
    url: '/shop/calendar-core',
    data: query,
    dataType: 'html',
    success:  this.onCoreLoaded.bind(this)
  });
}

RW.ShopCalendar.prototype.onCoreLoaded = function(re) {
  $('.phpc-calendar').html(re);

  // hack for jpopover
  $('.phpc-date').addClass('popover-trigger');

  // load daily calendar
  $('.phpc-date').each(function(){RW.ShopCalendar.retrieveDayCalenar(this)});
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

RW.ShopCalendar.prototype.viewEvent = function(evt) {
  if (!$(evt.target).is('.event-list')) return;
  var evtId = evt.target.id.substring(6);
  this.jCalPop.data('calendar_event', evtId);
  $(evt.target).parent('.day-calendar').prev('.phpc-date').trigger('click');
}

RW.ShopCalendar.prototype.moveEvent = function() {
  var eventId = $('[name=EventId]').val();
  this.jCalPop.data('calendar_move', eventId);

  this._updateCalendarLater = this.popoverDone({
    error:0,
    message: "click on the HEADER of the day you are going to move to"
  });
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
  var dat =  evt.target.id.substring(5);
  var view_cal = this.jCalPop.data('calendar_event');
  var move_cal = this.jCalPop.data('calendar_move');

  this.jCalPop.removeData('calendar_event');  // one time thing
  this.jCalPop.removeData('calendar_move');  // one time thing

  // query data sending back
  var query = {};
  query.free_slog = dat;

  if (view_cal) {
    query.event_id = view_cal;
    $('h3', pop).html( 'Update existing event ' + dat );
    $('#cal-delete', pop).show();
    $('#cal-move', pop).show();
  } else if (move_cal) {
    query.event_id = move_cal;
    $('h3', pop).html( 'Move existing event ' + dat );
    $('#cal-delete', pop).hide();
    $('#cal-move', pop).hide();
  } else {
    $('h3', pop).html( 'Add calendar ' + dat );
    $('#cal-delete', pop).hide();
    $('#cal-move', pop).hide();
  }
  $('[name=FirstName]').val('');
  $('[name=LastName]').val('');
  $('[name=Phone]').val('');
  $('[name=Notes]').val('');
  $('[name=EventId]').val('');  // very important
  $('[name=FromSlot]').children('option').not(':first-child').remove();
  $('[name=EndSlot]').children('option').not(':first-child').remove();

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
  var jForm = $('form#calendar-add-form');
	jForm.formval({
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
  });
}

RW.ShopCalendar.prototype.popoverDone = function(oRe){
  $('form#calendar-add-form')[0].reset();

  // update calendar
  var dayElement = $('.calendar-pop').popover('getTrigger');
  RW.ShopCalendar.retrieveDayCalenar(dayElement);
  if (this._updateCalendarLater) {
    RW.ShopCalendar.retrieveDayCalenar(this._updateCalendarLater);
    delete this._updateCalendarLater;
  }

  // close popup and show OK message
  $('.calendar-pop').popover('hide');
  (oRe.error? RW.notifyError : RW.notifyOK).bind(window, oRe.message).later(100);
  return dayElement; // used by move from, update it later
}

RW.ShopCalendar.prototype.onLoadFreeSlots = function(oJson, pop) {
  if (oJson.slots.length === 0) {
    RW.notify("No free time slots available at that day. Try the day after that.", 6000)
    return;
  }
  var optionHtml = [];
  $.each(oJson.slots, function(_, val){
    optionHtml.push('<option value="'+val.id+'">'+val.slot+'</option>');
  });
  var jFrom = $('select[name=FromSlot]', pop);
  jFrom.children('option').not(':first-child').remove();
  jFrom.append(optionHtml.join(''));

  this.jFrom = jFrom;
  this.jEnd = $('select[name=EndSlot]', pop);
  this.slots = oJson.slots;

  if (oJson.viewEvent) {
    var event = oJson.viewEvent[0];
    $('[name=FirstName]').val(event.FirstName);
    $('[name=LastName]').val(event.LastName);
    $('[name=Phone]').val(event.Phone);
    $('[name=Notes]').val(event.Notes);
    // hidden value for update
    $('[name=EventId]').val(event.Id);

    // set start slot and trigger change
    jFrom.val(event.StartSlot).trigger('change');

    // set end slot a bit later
    if (event.NumSlots > 1) {
      this.jEnd.delay(100).val(event.EndSlot);
    }
  }
}

RW.ShopCalendar.prototype.onFromChange = function(){
  var i = parseInt(this.jFrom.val());
  var optionHtml = [];
  $.each(this.slots, function(_, val){
    var id = parseInt(val.id);
    if (id > i) {
      i++;  // must be continous value with from
      if (id === i) {
        optionHtml.push('<option value="'+val.id+'">'+val.slot+'</option>');
      } else {
        return false; // break;
      }
    }
  });

  this.jEnd.children('option').not(':first-child').remove();
  this.jEnd.append(optionHtml.join(''));
}
RW.ShopCalendar.prototype.onHide = function() {
  RW.notifyClose();
  $('form#calendar-add-form').formval('disable');
}

$(function(){new RW.ShopCalendar()});