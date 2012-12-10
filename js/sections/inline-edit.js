// require rw | function
RW.InlineEdit = function(edTbl, url) {
  $(document).on('click', edTbl, this.onEditTableClick.bind(this));

  this._jTable = $(edTbl);
  this._url = url;

  this._newline = this._jTable.find('tr:last').clone();
  this._jTable.find('tr:odd').css('backgroundColor','#ccc');
}

RW.InlineEdit.prototype.onEditTableClick = function(evt) {
  var action = $(evt.target).text().toLowerCase();
  if ( ! /^new|edit|delete|save|cancel$/.test(action) ) return;

  // make sure cancel current editing
  /^new|edit$/.test(action) && $('#inline-cancel').trigger('click');

  // first level action
  if (/^new|edit|delete$/.test(action)) {
    this._curAction = action;
    this._curId = $(evt.target).parent('td').attr("data-id") || 0;;
  }

  this[action].call(this, evt.target);
}

RW.InlineEdit.prototype['new'] =
RW.InlineEdit.prototype.edit = function(elAction) {
  var jHd = this._jTable.find('tr:first');

  $(elAction)
  .parent('td')       // hide all children and
    .removeClass(this._curAction)
    .addClass('editing')
  .parent('tr').children('[data-value]').each(function(){
    var idx = $(this).index();
    var jCo = jHd.children().eq(idx);

    var input = jCo.attr('data-input');
    var field = jCo.attr('data-field');
    var value = $(this).attr('data-value');

    var html = [];
    if (input === 'select') {
      html.push('<select name="'+field+'">');
      $.each($.parseJSON(jCo.attr('data-options')), function(val, txt){
        html.push('<option value="'+val+'"'+( value == val ? ' selected="selected"': '' )+'>'+txt+'</option>');
      });
      html.push('</select>');
    } else if (input === 'textarea') {
      html.push('<textarea name="'+field+'">'+value+'</textarea>');
    } else {
      html.push('<input type="text" name="'+field+'" value="'+value+'" />');
    }
    $(this).html(html.join(''));
  });
}

RW.InlineEdit.prototype.cancel = function(elAction) {
  var jHd = this._jTable.find('tr:first');

  $(elAction)
  .parent('td')
    .removeClass('editing')
    .addClass(this._curAction)
  .parent('tr')
    .children('[data-value]').each(function(){
      var idx = $(this).index();
      var jCo = jHd.children().eq(idx);

      var input = jCo.attr('data-input');
      var value = $(this).attr('data-value');

      if (input === 'select') {
        var opts = $.parseJSON(jCo.attr('data-options'));
        value = opts[value];
      }

      $(this).text(value || "");
    });

  // remove save/cancel
  delete this._curAction;
  delete this._curId;
}

RW.InlineEdit.prototype.save = function(elAction) {
  var jHd = this._jTable.find('tr:first');
  var query = $(elAction).parents('tr').find(":input").serializeArray();
  query.push({name: "action", value: this._curAction});
  query.push({name: "id", value: this._curId});

  $.ajax({
    url: this._url,
    data: query,
    dataType: 'json',
    success: (function(oRe){
      if (!oRe.error && oRe.row) {
        // && this._curId for edit
        var jCan = $(elAction).next();

        jCan.parents('tr').children('[data-value]').each(function(){
          var idx = $(this).index();
          var jCo = jHd.children().eq(idx);
          var field = jCo.attr('data-field');

          $(this).attr('data-value', oRe.row[field]);
        });

        if (oRe.row.Id && this._curAction !== 'edit') {
          this._curAction = 'edit'; //  see the cancel action
          $(elAction).parent('td').attr('data-id', oRe.row.Id);

          // make a new add line
          this._jTable.find('tr:last').after(this._newline.clone());
        }
        jCan.trigger('click');
      }
      this._afterAction(oRe);
    }).bind(this)
  });
}

RW.InlineEdit.prototype['delete'] = function(elAction) {
  $.ajax({
    url: this._url,
    data: {
            action: this._curAction,
            id: this._curId
          },
    dataType: 'json',
    success: (function(oRe){
      if (!oRe.error) {
        $(elAction).parents('tr').remove();
      }
      this._afterAction(oRe);
    }).bind(this)
  });
}

RW.InlineEdit.prototype._afterAction = function(oRe) {
  oRe.error ? RW.notifyError(oRe.message) : RW.notifyOK(oRe.message);
  this._jTable
  .trigger('success', this._curAction)
  .find('tr:odd')
    .css('backgroundColor','#ccc')
    .end()
  .find('tr:even')
    .css('backgroundColor','transparent');

  delete this._curAction;
  delete this._curId;
}