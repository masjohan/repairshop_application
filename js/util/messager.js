// require function | rw | juidialog

$(function(){
    var box = $('<span />').dialog({
        width: '50%',
        autoOpen: false,
        dialogClass: "no-title message",
        position: ['center', 'top'],
        open: function(){
            box.hide()
                .prev('.ui-dialog-titlebar')
                    .css('padding', '0')
                .find('.ui-dialog-title')
                    .css({
                        color: '#333333',
                        fontWeight: 'bold',
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
            .delay(last || 6000).fadeOut( 'slow', function(){
                box.dialog('close')
            });
    };

    RW.notifyOK = function (msg, last) {
        fnShowMsg({
            backgroundColor: '#ccff99',
            border: '1px solid #66cc33'
        }, msg, last);
    }
    RW.notifyError = function (msg, last) {
         fnShowMsg({
            backgroundColor: '#ffcccc',
            border: '1px solid #993333'
        }, msg, last);
    }
    RW.notify = function (msg, last) {
         fnShowMsg({
            backgroundColor: '#F9EDBE',
            border: '1px solid #F0C36D'
        }, msg, last);
    }
});
