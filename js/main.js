$(document).ready(function() {

  $('#form_newpersonnel').submit(function (e) {
    e.preventDefault();
    var self = $(this), fetch = {'firstname': String($('#firstname').val()), 'lastname': String($('#lastname').val()), 'policeid': String($('#policeid').val()), 'emailaddress': String($('#emailaddress').val()), 'role': String($('#role').val())}, data = [], ready = true;
    $.each(fetch, function (key, val) {
      data.push(key + '=' + escape(val));
      if (val.trim().length === 0) {
        ready = false;
      }
    });
    (ready) && $.post('executenewpersonnel', data.join('&'), function (data) {
      var data = JSON.parse(data); //responseElem = self.find('#alert-container');
      // if (data['status'] === "failure") {
      //   responseElem.removeClass('alert-success').addClass('alert-danger');
      // } else if (data['status'] === "success") {
      //   responseElem.removeClass('alert-danger').addClass('alert-success');
      // }
      // responseElem.html(data['message']);
      console.log(data);
    });
  });

  $('#form_login').submit(function (e) {
      e.preventDefault();
      var self = $(this), fetch = {'policeid': String($('#policeid').val()), 'secret': String($('#secret').val())}, data = [], ready = true;
      $.each(fetch, function (key, val) {
          data.push(key + '=' + escape(val));
          if (val.trim().length === 0) {
              ready = false;
          }
      });
      (ready) && $.post('executelogin', data.join('&'), function (data) {
          var data = JSON.parse(data); //responseElem = self.find('#alert-container');
          // if (data['status'] === "failure") {
          //     responseElem.removeClass('alert-success').addClass('alert-danger').html(data['message']);
          // } else if (data['status'] === "success") {
          //     document.location = data['redirect'];
          // }
          console.log(data);
      });
  });

  $('button.deactivate-personnel').each(function () {
      var self = $(this), ref = String(self.data('personnel')), data = 'deactivate-personnel=true&ref=' + escape(ref);
      $(this).click(function (e) {
          e.preventDefault();
          $.post('executepersonnel', data, function (data) {
              data = JSON.parse(data);
              // if (data.status === "success") {
              //     window.location.reload();
              // }
              console.log(data);
          });
      });
  });

  $('button.activate-personnel').each(function () {
      var self = $(this), ref = String(self.data('personnel')), data = 'activate-personnel=true&ref=' + escape(ref);
      $(this).click(function (e) {
          e.preventDefault();
          $.post('executepersonnel', data, function (data) {
              data = JSON.parse(data);
              // if (data.status === "success") {
              //     window.location.reload();
              // }
              console.log(data);
          });
      });
  });

  $('button.delete-personnel').each(function () {
      var self = $(this), ref = String(self.data('personnel')), data = 'delete-personnel=true&ref=' + escape(ref);
      $(this).click(function (e) {
          e.preventDefault();
          $.post('executepersonnel', data, function (data) {
              data = JSON.parse(data);
              // if (data.status === "success") {
              //     window.location.reload();
              // }
              console.log(data);
          });
      });
  });

});