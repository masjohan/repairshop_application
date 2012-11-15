// require formval

$(function(){
    var fv = new RW.FormVal('form', {
      'first_name' : {
        required: 1,
        regexp: /^\w+$/,
        minlen: 3,
        maxlen: 20,
        maxnum: 10000,
        minnum: 1,
        helperCb: function(jEl){
          if(jEl.val()!='1234' && jEl.val()!='5678') return {error:1,message:"1234 or 5678 is good"}
        },
        jsonCb: function(jEl){
          return {
            get: '/json' + document.location.pathname,
            data: {sendTime:new Date().getTime()},
            helperCb: function(oResp){
              if(jEl.val()=='1234') return {
                    error:1,
                    message: oResp.sendTime +'<br>'+ oResp.recvTime +'<br>5678 is good'
              };
            }
          }
        },
        message: {
          required: 'Please give your first name',
          minlength: 'it is good idea to have 3+ chars first name'
        }
      },
      'first_passwd':{
        minlen:6,
        jsonCb: function(jEl){
          return {
            get: '/json' + document.location.pathname,
            data: {passwd:jEl.val()},
            helperCb: function(oResp){
              if(oResp.error) return oResp;
            }
          }
        }
      },
      'first_checkbox[]':{
        required: 1
      },
      'first_area':{
        jsonCb: function(jEl){
          return null;
        }
      },
      'first_select':{
        jsonCb: function(jEl){
            return {
                get: '/json' + document.location.pathname,
                data: {directmsg:jEl.val()}
            }
        }
      }
      
    })
    .validOnChange()
    .bindEvent('success', function(evt, ele){
        console.log('form is good');
    })
    .bindEvent('formval_dirty', function(evt, ele){
        console.log('dirty: ' + $(ele).attr('name'));
    })
    .bindEvent('formval_change', function(evt, ele){
        if ($(ele).attr('name') == 'first_first') {
            fv.setChange($(ele.form).find("input[name=first_name]").val($(ele).val())[0]);
        } else if ($(ele).attr('name') == 'first_area' && ! /^\d*$/.test($(ele).val())) {
            fv.setError(ele, 'number ONLY');
        }
    });
});