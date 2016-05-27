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

  $('#form_newentry').submit(function (e) {
    e.preventDefault();
    var self = $(this), fetch = {'firstname': String($('#firstname').val()), 'lastname': String($('#lastname').val()), 'othername': String($('#othername').val()), 'dob': String($('#dob').val()), 'sex': String($('#sex').val()), 'phonenumber': String($('#phonenumber').val()), 'emailaddress': String($('#emailaddress').val()), 'homeaddress': String($('#homeaddress').val()), 'occupation': String($('#occupation').val()), 'workplace': String($('#workplace').val()), 'workaddress': String($('#workaddress').val()), 'image1': String($('#image1').val()), 'image2': String($('#image2').val())}, data = [], ready = true;
    $.each(fetch, function (key, val) {
      data.push(key + '=' + escape(val));
      if (val.trim().length === 0) {
        ready = false;
      }
    });
    (ready) && $.post('executenewentry', data.join('&'), function (data) {
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

  $('button.edit-entry').each(function () {
    var self = $(this), ref = String(self.data('entry')), data = 'edit-entry=true&ref=' + escape(ref);
    $(this).click(function (e) {
      e.preventDefault();
      $.post('executeeditentry', data, function (data) {
        data = JSON.parse(data);
        $('#form_editentry input[name="othername"]').val(data.Othername);
        $('#form_editentry input[name="dob"]').val(data.DOB);
        $('#form_editentry input[name="phonenumber"]').val(data.Phonenumber);
        $('#form_editentry input[name="emailaddress"]').val(data.EmailAddress);
        $('#form_editentry input[name="homeaddress"]').val(data.HomeAddress);
        $('#form_editentry input[name="occupation"]').val(data.Occupation);
        $('#form_editentry input[name="workplace"]').val(data.WorkPlace);
        $('#form_editentry input[name="workaddress"]').val(data.WorkAddress);
        $('#form_editentry button').attr('data-id', data.UniqueID);
      });
    });
  });

  $('#form_editentry').submit(function (e) {
    e.preventDefault();
    var self = $(this), ref = String($('#form_editentry button').data('id')), fetch = {'othername': String($('#othername').val()), 'dob': String($('#dob').val()), 'phonenumber': String($('#phonenumber').val()), 'emailaddress': String($('#emailaddress').val()), 'homeaddress': String($('#homeaddress').val()), 'occupation': String($('#occupation').val()), 'workplace': String($('#workplace').val()), 'workaddress': String($('#workaddress').val()), 'id': escape(ref)}, data = [], ready = true;
    $.each(fetch, function (key, val) {
      data.push(key + '=' + escape(val));
      if (val.trim().length === 0) {
        ready = false;
      }
    });
    (ready) && $.post('executeeditentry', data.join('&'), function (data) {
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

  $('button.train-album').each(function () {
    var self = $(this), ref = String(self.data('entry'));
    $(this).click(function (e) {
      e.preventDefault();
      $('#form_trainalbum').append('<input type="hidden" class="entryid" name="entryid" value="'+ ref +'" />');
    });
  });

  var max_fields = 10, wrapper = $(".imageurl_fields"), add_button = $(".addimage_field");
  var x = 1;
  $(add_button).click(function(e) {
    e.preventDefault();
    if (x < max_fields) {
      x++;
      $(wrapper).append('<div><input type="text" placeholder="Image URL" class="imageurlfield" name="imageURL[]" /><a href="#" class="removeimage_field">Remove</a></div>');
    }
  }); 
  $(wrapper).on("click", ".removeimage_field", function(e){
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  });

  $('#form_trainalbum').submit(function (e) {
    e.preventDefault();
    var self = $(this), images = [], data = [], ready = true;
    $.each($('#form_trainalbum input[class="imageurlfield"]'), function () {
      images.push(escape($(this).val()));
      if ($(this).val().trim().length === 0) {
        ready = false;
      }
    });
    data['id'] = String($('#form_trainalbum input[name="entryid"]').val());
    data['dataset'] = images;
    (ready) && $.post('executetrain', 'data='+escape(JSON.stringify(data)), function (data) {
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

});