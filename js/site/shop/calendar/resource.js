// require sections/inline-edit.js
$(function(){

  new RW.InlineEdit('#calendar-resource-edit', '/json/shop/calendar/resource');
  // reload page when new or delete
  $('#calendar-resource-edit').on('success', function(evt, action){
    if (action === 'delete' || action === 'new') {
      window.location.reload();
    }
  });

});