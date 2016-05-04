$(document).ready(function() {

  $('#startdate').datepicker({
    format: "yyyy-mm-dd"
  });
  $('#enddate').datepicker({
    format: "yyyy-mm-dd"
  });

    $('#form_schedule').submit(function (e) {
        $('#form_schedule').find('button').prop('disabled', false);
        e.preventDefault();
        var self = $(this), fetch = {'country': String($('#countrySchedule').val()), 'network': String($('#nOperatorSchedule').val()), 'amount': String($('#amountSchedule').val()), 'phonenumber': String($('#phonenumberSchedule').val()), 'startdate': String($('#startdate').val()), 'frequency': String($('#frequency').val()), 'enddate': String($('#enddate').val())}, data = [], ready = true;
        $.each(fetch, function (key, val) {
            data.push(key + '=' + escape(val));
            if (val.trim().length === 0) {
                ready = false;
            }
        });
        (ready) && $.post('executeschedule', data.join('&'), function (data) {
            var data = JSON.parse(data), responseElem = $('#form_schedule').find('#alert-container-schedule');
            if (data['status'] === "failure") {
                responseElem.removeClass('alert-success').addClass('alert-danger').show();
            } else if (data['status'] === "success") {
                responseElem.removeClass('alert-danger').addClass('alert-success').show();
            }
            responseElem.html(data['message']);
            $('#form_schedule')[0].reset();
            $('#form_schedule').find('button').prop('disabled', false);
            setTimeout(function() {
              window.location.reload();
            }, 2000);
        });
    });

    $('a.delete-schedule').each(function () {
        var self = $(this), ref = String(self.data('schedule')), data = 'delete-schedule=true&ref=' + escape(ref);
        $(this).click(function (e) {
            e.preventDefault();
            $.post('executedelete', data, function (data) {
                data = JSON.parse(data);
                if (data.status === "success") {
                    window.location.reload();
                }
            });
        });
    });

	$('#form_signup').submit(function (e) {
		e.preventDefault();
		var self = $(this), fetch = {'firstname': String($('#firstname').val()), 'lastname': String($('#lastname').val()), 'username': String($('#username').val()), 'password': String($('#password').val()), 'email': String($('#email').val()), 'phonenumber': String($('#phonenumber').val())}, data = [], ready = true;
		$.each(fetch, function (key, val) {
			data.push(key + '=' + escape(val));
			if (val.trim().length === 0) {
				ready = false;
			}
		});
		(ready) && $.post('executesignup', data.join('&'), function (data) {
			var data = JSON.parse(data), responseElem = self.find('#alert-container');
			if (data['status'] === "failure") {
				responseElem.removeClass('alert-success').addClass('alert-danger');
			} else if (data['status'] === "success") {
				responseElem.removeClass('alert-danger').addClass('alert-success');
			}
			responseElem.html(data['message']);
		});
	});

    $('#form_signin').submit(function (e) {
        e.preventDefault();
        var self = $(this), fetch = {'email': String($('#email').val()), 'password': String($('#password').val())}, data = [], ready = true;
        $.each(fetch, function (key, val) {
            data.push(key + '=' + escape(val));
            if (val.trim().length === 0) {
                ready = false;
            }
        });
        (ready) && $.post('executesignin', data.join('&'), function (data) {
            var data = JSON.parse(data), responseElem = self.find('#alert-container');
            if (data['status'] === "failure") {
                responseElem.removeClass('alert-success').addClass('alert-danger').html(data['message']);
            } else if (data['status'] === "success") {
                document.location = data['redirect'];
            }
        });
    });

    jQuery(function($) {
      $(".numbersonly").keydown(function(e) {
          // Allow: backspace, delete, tab, escape, enter and .
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
              // Allow: Ctrl+A
              (e.keyCode == 65 && e.ctrlKey === true) ||
              // Allow: Ctrl+C
              (e.keyCode == 67 && e.ctrlKey === true) ||
              // Allow: Ctrl+X
              (e.keyCode == 88 && e.ctrlKey === true) ||
              // Allow: home, end, left, right
              (e.keyCode >= 35 && e.keyCode <= 39)) {
              // let it happen, don't do anything
              return;
          }
          // Ensure that it is a number and stop the keypress
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              e.preventDefault();
          }
      });

      // document.getElementById('cardnumber').addEventListener('input', function(e) {
      //     e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1-').trim();
      // });

	    $('#payment-form').submit(function(event) {
        $('#loadingdiv').show();
		    var $form = $('#payment-form');

		    // Disable the submit button to prevent repeated clicks
		    $form.find('button').prop('disabled', true);

		    Pwc.createToken($form, pwcResponseHandler);

		    // Prevent the form from submitting with the default action
		    return false;
	    });
    });
    var pwcResponseHandler = function(status, response) {
	    if (response.error === true) {
        alert(response.error.message);
	    } else {
	    	var token = response.token, fetch = {'buyerID': String($('#buyerID').val()), 'token': token}, data = [];
	    	$.each(fetch, function (key, val) {
            data.push(key + '=' + escape(val));
        });
	    	$.post('executecred', data.join('&'), function (data) {
	        	var data = JSON.parse(data), responseElem = $('#payment-form').find('#alert-container');
	        	if (data['status'] === "failure") {
                $('#loadingdiv').hide();
	        	    responseElem.removeClass('alert-success').addClass('alert-danger').html(data['message']);
	        	} else if (data['status'] === "success") {
                $('#loadingdiv').hide();
                responseElem.removeClass('alert-danger').addClass('alert-success').html(data['message']);
                setTimeout(function() {
                  window.location.href = data['redirect'];
                }, 2000);
	        	}
	    	});
	    }
    };

    var operators = {
      'NGN': {'1': 'NG Airtel', '2': 'NG Etisalat', '3': 'NG Visafone', '4': 'NG MTN', '5': 'NG GLO'},
      'KES': {'6': 'KES Airtel', '7': 'KES Orange', '8': 'KES Safaricom', '9': 'KES YU'},
      'GBP': {'10': 'UK Orange', '11': 'UK TMobile', '12': 'UK Vodafone'},
      'USD': {'13': 'US AT&T', '14': 'US Boost', '15': 'US TMobile', '16': 'US UltraMobile', '17': 'US Verizon'},
      'GHS': {'18': 'GH Airtel', '19': 'GH Expresso', '20': 'GH GLO', '21': 'GH MTN', '22': 'GH Tigo', '23': 'GH Vodafone'},
      'CAD': {'24': 'CA Calldirek'},
      'INR': {'25': 'IN Aircel', '26': 'IN Bharti Airtel', '27': 'IN Videocon', '28': 'IN Vodafone'},
      'ZAR': {'29': 'SA 8TA', '30': 'SA CELLC', '31': 'SA MTN', '32': 'SA Vodacom'}
    };

    populateNOperators();

    $(function() {
        $('#country').change(function() {
          $('#nOperator').html('');
          populateNOperators();
        });
    });

    function populateNOperators() {
    var selectedCountry = $('#country').val(),
     append = '<option value="" selected disabled>Select Network Operator</option>';

     $.each(operators, function (country, operator) {
       if (selectedCountry === country) {
         $.each(operator, function (i, obj) {
           append += '<option value="'+i+'">'+obj+'</option>';
         });
       }
     });

     $('#nOperator').html(append);
   }

    function generateTopUpOptions (options, country) {
      var html = '';
      $.each(options, function (i, option) {
        html += '<option value="' + option + '">' + option + ' ' + country + '</option>';
      });
      return html;
    }

    $(function() {
      $('#nOperator').change(function() {
        var operator = $(this).val(), html = '';

        $.each(operators, function (country, opt) {
          var options = [];
          if (opt.hasOwnProperty(operator)) {
            switch (country) {
              case 'KES':
                if (operator === '7') {
                  Array.prototype.push.apply(options,[1575,3150]);
                } else {
                  Array.prototype.push.apply(options,[100,300,600,900,1200,1500,1800]);
                }
                html += '<select class="form-control" name="amount" id="amount" required style="padding: 0;">';
                html += generateTopUpOptions(options, country);
                html += '</select>';
                break;
              case 'GBP':
                if (operator === '12') {
                  Array.prototype.push.apply(options,[5,10,20,30,40,50]);
                } else {
                  Array.prototype.push.apply(options,[5,10,20]);
                }
                html += '<select class="form-control" name="amount" id="amount" required style="padding: 0;">';
                html += generateTopUpOptions(options, country);
                html += '</select>';
                break;
              default:
                html += '<input class="form-control" name="amount" id="amount" placeholder="Top-up Amount" required />';
                break;
            }
          }
        });
        $('#form_airtime #amount').replaceWith(html);
      });
    });

    populateNOperatorsSchedule();

        $(function() {
            $('#countrySchedule').change(function() {
              $('#nOperatorSchedule').html('');
              populateNOperatorsSchedule();
            });
        });

        function populateNOperatorsSchedule () {
        var selectedCountry = $('#countrySchedule').val(),
         append = '<option value="" selected disabled>Select Network Operator</option>';

         $.each(operators, function (country, operator) {
           if (selectedCountry === country) {
             $.each(operator, function (i, obj) {
               append += '<option value="'+i+'">'+obj+'</option>';
             });
           }
         });

         $('#nOperatorSchedule').html(append);
       }

        function generateTopUpOptionsSchedule (options, country) {
          var html = '';
          $.each(options, function (i, option) {
            html += '<option value="' + option + '">' + option + ' ' + country + '</option>';
          });
          return html;
        }

        $(function() {
          $('#nOperatorSchedule').change(function() {
            var operator = $(this).val(), html = '';

            $.each(operators, function (country, opt) {
              var options = [];
              if (opt.hasOwnProperty(operator)) {
                switch (country) {
                  case 'KES':
                    if (operator === '7') {
                      Array.prototype.push.apply(options,[1575,3150]);
                    } else {
                      Array.prototype.push.apply(options,[100,300,600,900,1200,1500,1800]);
                    }
                    html += '<select class="form-control" name="amountSchedule" id="amountSchedule" required style="padding: 0;">';
                    html += generateTopUpOptions(options, country);
                    html += '</select>';
                    break;
                  case 'GBP':
                    if (operator === '12') {
                      Array.prototype.push.apply(options,[5,10,20,30,40,50]);
                    } else {
                      Array.prototype.push.apply(options,[5,10,20]);
                    }
                    html += '<select class="form-control" name="amountSchedule" id="amountSchedule" required style="padding: 0;">';
                    html += generateTopUpOptionsSchedule(options, country);
                    html += '</select>';
                    break;
                  default:
                    html += '<input class="form-control" name="amountSchedule" id="amountSchedule" placeholder="Top-up Amount" required />';
                    break;
                }
              }
            });

            $('#form_schedule #amountSchedule').replaceWith(html);
        });
      });
    $('#form_airtime').submit(function (e) {
        // $('#form_airtime').find('button').prop('disabled', true);
        e.preventDefault();

        var rand = function() {
            return Math.random().toString(16).substr(2); // remove 0.
        };

        var token = function() {
            return rand() + rand(); // to make it longer
        };

        var self = $(this), responseElem = $('#form_airtime').find('#alert-container'), fetch = {'country': String($('#country').val()), 'network': String($('#nOperator').val()), 'amount': String($('#amount').val()), 'phonenumber': String($('#phonenumber').val()), 'token': token()}, data = [], ready = true;
        if (fetch['amount'] < 100) {
          responseElem.removeClass('alert-success').addClass('alert-danger').html('Please you cannot purchase less than N 100 airtime.').show();
        } else {
          $.each(fetch, function (key, val) {
              data.push(key + '=' + escape(val));
              if (val.trim().length === 0) {
                  ready = false;
              }
          });

          (ready) && $.post('executebuyairtime', data.join('&'), function (data) {
            console.log(data);
          });

          var description = 'Airtime purchase for ' + fetch['phonenumber'];

          var newForm = $('<form>', {
            'method': 'post',
            'action': 'https://www.paywithcapture.com/live/pay',
            'target': '_top'
          }).append($('<input>', {
            'name': 'merchantid',
            'value': 102555,
            'type': 'hidden'
          })).append($('<input>', {
            'name': 'amount',
            'value': fetch['amount'] * 100,
            'type': 'hidden'
          })).append($('<input>', {
            'name': 'trxref',
            'value': fetch['token'],
            'type': 'hidden'
          })).append($('<input>', {
            'name': 'description',
            'value': description,
            'type': 'hidden'
          }));
          newForm.submit();
        }
    });

    $('#logout').click(function (e) {
        e.preventDefault();
        $.post('executelogout', null, function (data) {
            var data = JSON.parse(data);
            document.location = data['redirect'];
        });
    });

});

function changeBG() {
    var cardinput = $('#cardnumber');
    var cardnumber = $('#cardnumber').val();
    var mcArray = ["51", "52", "53", "54", "55"];

    if (cardnumber.charAt(0) == 4) {
        cardinput.css('cssText', 'background-image:url(img/vs.png)');
    } else if (mcArray.indexOf(cardnumber.substr(0, 2)) != -1) {
        cardinput.css('cssText', 'background-image:url(img/mc.png)');
    } else {
        cardinput.css('cssText', 'background-image:url(img/rg.png)');
    }
}

// function dash() {
//   var ccNum = document.getElementById("cardnumber");
//   if ((ccNum.value.search("-") == -1) && (ccNum.value.length != 0) ){
//     var newCC = new Array();
//     newCC[0] = ccNum.value.slice(0,4);
//     newCC[1] = ccNum.value.slice(4,8);
//     newCC[2] = ccNum.value.slice(8,12);
//     newCC[3] = ccNum.value.slice(12,16);
//     ccNum.value = "";
//     for(i=0;i<=2;i++) {
//       if(newCC[i].length == 4) 
//          newCC[i] = newCC[i] + "-";
//          ccNum.value += newCC[i];
//     }
//     ccNum.value += newCC[3];
//   }
// }