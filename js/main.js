$(document).ready(function() {
  $('#form_register').submit(function (e) {
    e.preventDefault();
    var self = $(this), fetch = {'firstname': String($('#firstname').val()), 'lastname': String($('#lastname').val()), 'policeid': String($('#policeid').val()), 'emailaddress': String($('#emailaddress').val()), 'role': String($('#role').val())}, data = [], ready = true;
    $.each(fetch, function (key, val) {
      data.push(key + '=' + escape(val));
      if (val.trim().length === 0) {
        ready = false;
      }
    });
    (ready) && $.post('executeregister', data.join('&'), function (data) {
      var data = JSON.parse(data); 
      console.log(data);
    });
  });
});