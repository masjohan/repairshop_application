// require function | rw

$(function(){
    var box = $('<span />').dialog({
        width: '33%',
        autoOpen: false,
        dialogClass: "no-title message",
        position: ['center', 'top'],
        open: function(){
            box.hide()
                .prev('.ui-dialog-titlebar')
                    .css('padding', '0')
                .find('.ui-dialog-title')
                    .css({
                        color: '#555555',
                        margin: '0.1em 16px 0.1em 0.3em'
                    })
                .parents('.ui-dialog')
                    .css({
                        borderRadius: '2px',
                        boxShadow: '0 2px 4px rgba(0, 0, 0, 0.2)'
                    });
        }
    }),
    fnShowMsg = function(css, msg, last) {
        box
        .dialog('option', 'title', msg)
        .dialog('open')
        .parents('.ui-dialog')
            .css(css)
            .delay(last).fadeOut( 'slow', function(){
                box.dialog('close')
            });
    };

    RW.notifyOK = function (msg, last) {
        fnShowMsg({
            backgroundColor: '#ccff99',
            border: '1px solid #66cc33'
        }, msg, last || 6000);
    }
    RW.notifyError = function (msg, last) {
         fnShowMsg({
            backgroundColor: '#ffcccc',
            border: '1px solid #993333'
        }, msg, last || 30000);
    }
    RW.notify = function (msg, last) {
         fnShowMsg({
            backgroundColor: '#F9EDBE',
            border: '1px solid #F0C36D'
        }, msg, last || 12000);
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
