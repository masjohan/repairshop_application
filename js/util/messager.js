// require function | rw

$(function(){
    var box = $('<span />').dialog({
        width: '66%',
        autoOpen: false,
        position: ['center', 'top'],
        draggable: false,
        resizable: false,
        open: function(){
            box.hide()
                .prev('.ui-dialog-titlebar')
                    .css('padding', '0.5em');
        }
    }),
    fnShowMsg = function(cls, msg, last) {
        box
        .dialog('option', 'title', msg)
        .dialog('option', 'dialogClass', "message "+cls)
        .dialog('open');

        setTimeout(function(){box.dialog('close')}, last);
    };

    RW.notifyOK = function (msg, last) {
        fnShowMsg("ok", msg, last || 6000);
    }
    RW.notifyError = function (msg, last) {
         fnShowMsg('error', msg, last || 30000);
    }
    RW.notify = function (msg, last) {
         fnShowMsg('', msg, last || 12000);
    }
    RW.notifyClose = function () {
         box.dialog('close');
    }

    var jmsg = $('#messager');
    if (!jmsg.length) return;

    var txt = jmsg.text();
    if (jmsg.hasClass('ok')) {
        RW.notifyOK(txt);
    } else if (jmsg.hasClass('error')) {
        RW.notifyError(txt);
    } else {
        RW.notify(txt);
    }
});
