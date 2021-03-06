$(document).ready(function() {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $("#menu-toggle-2").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled-2");
        $("#menu ul").hide();
    });
    $("#admin-content-div").html($("#personnel-content").html());
    function initMenu() {
        $("#menu ul").hide();
        $("#menu ul").children(".current").parent().show();
        $("#menu ul:first").show();
        $("#menu li a").click(function() {
            var checkElement = $(this).next();
            if (checkElement.is("ul") && checkElement.is(":visible")) {
                return false;
            }
            if (checkElement.is("ul") && !checkElement.is(":visible")) {
                $("#menu ul:visible").slideUp("normal");
                checkElement.slideDown("normal");
                return false;
            }
        });
    }
    $(document).ready(function() {
        initMenu();
    });
    $("#menu > li#entry-menu-item > a").click(function(e) {
        $("li#personnel-menu-item").removeClass("active");
        $("li#entry-menu-item").addClass("active");
        $("#admin-content-div").html($("#entry-content").html());
    });
    $("#menu > li#personnel-menu-item > a").click(function(e) {
        $("li#entry-menu-item").removeClass("active");
        $("li#personnel-menu-item").addClass("active");
        $("#admin-content-div").html($("#personnel-content").html());
    });
    $("#form_newpersonnel").submit(function(e) {
        e.preventDefault();
        var fetch = {
            firstname: String($("#pfirstname").val()),
            lastname: String($("#plastname").val()),
            policeid: String($("#ppoliceid").val()),
            emailaddress: String($("#pemailaddress").val()),
            role: String($("#prole").val())
        }, data = [], ready = true;
        $.each(fetch, function(key, val) {
            data.push(key + "=" + escape(val));
            if (val.trim().length === 0) {
                ready = false;
            }
        });
        ready && $.post("executenewpersonnel", data.join("&"), function(data) {
            var data = JSON.parse(data), responseElem = $("#palert-container");
            if (data["status"] === "failure") {
                responseElem.removeClass("alert-success").addClass("alert-danger");
            } else if (data["status"] === "success") {
                responseElem.removeClass("alert-danger").addClass("alert-success");
            }
            responseElem.html(data["message"]);
        });
    });
    $(".login-input").on("focus", function() {
        $(".login").addClass("focused");
    });
    $("#form_login").submit(function(e) {
        e.preventDefault();
        $(".login").removeClass("focused").addClass("loading");
        var fetch = {
            policeid: String($("#policeid").val()),
            secret: String($("#secret").val())
        }, data = [], ready = true;
        $.each(fetch, function(key, val) {
            data.push(key + "=" + escape(val));
            if (val.trim().length === 0) {
                ready = false;
            }
        });
        ready && $.post("executelogin", data.join("&"), function(data) {
            var data = JSON.parse(data), responseElem = $("#login-alert-container");
            if (data["status"] === "failure") {
                $(".login").removeClass("loading");
                responseElem.append('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
                responseElem.removeClass("alert-success").addClass("alert-danger").html(data["message"]);
            } else if (data["status"] === "success") {
                $(".login").removeClass("loading");
                document.location = data["redirect"];
            }
        });
    });
    $("button.deactivate-personnel").each(function() {
        var self = $(this), ref = String(self.data("personnel")), data = "deactivate-personnel=true&ref=" + escape(ref);
        self.click(function(e) {
            if (confirm("Are you sure? Click OK to continue or Cancel to do nothing!")) {
                e.preventDefault();
                $.post("executepersonnel", data, function(data) {
                    data = JSON.parse(data);
                    if (data.status === "success") {
                        window.location.reload();
                    }
                });
            }
        });
    });
    $("button.activate-personnel").each(function() {
        var self = $(this), ref = String(self.data("personnel")), data = "activate-personnel=true&ref=" + escape(ref);
        self.click(function(e) {
            if (confirm("Are you sure? Click OK to continue or Cancel to do nothing!")) {
                e.preventDefault();
                $.post("executepersonnel", data, function(data) {
                    data = JSON.parse(data);
                    if (data.status === "success") {
                        window.location.reload();
                    }
                });
            }
        });
    });
    $("button.delete-personnel").each(function() {
        var self = $(this), ref = String(self.data("personnel")), data = "delete-personnel=true&ref=" + escape(ref);
        self.click(function(e) {
            if (confirm("Are you sure? Click OK to continue or Cancel to do nothing!")) {
                e.preventDefault();
                $.post("executepersonnel", data, function(data) {
                    data = JSON.parse(data);
                    if (data.status === "success") {
                        window.location.reload();
                    }
                });
            }
        });
    });
    $("#form_newentry").submit(function(e) {
        e.preventDefault();
        $("#loadingdiv").show();
        var fetch = {
            firstname: String($("#efirstname").val()),
            lastname: String($("#elastname").val()),
            othername: String($("#eothername").val()),
            dob: String($("#edob").val()),
            sex: String($("#esex").val()),
            phonenumber: String($("#ephonenumber").val()),
            emailaddress: String($("#eemailaddress").val()),
            homeaddress: String($("#ehomeaddress").val()),
            occupation: String($("#eoccupation").val()),
            workplace: String($("#eworkplace").val()),
            workaddress: String($("#eworkaddress").val()),
            image1: String($("#eimage1").val()),
            image2: String($("#eimage2").val())
        }, data = [], ready = true;
        $.each(fetch, function(key, val) {
            data.push(key + "=" + escape(val));
            if (val.trim().length === 0 && (key != "othername" || key != "occupation" || key != "workplace" || "workaddress")) {
                ready = false;
            }
        });
        ready && $.post("executenewentry", data.join("&"), function(data, status) {
            var data = JSON.parse(data), responseElem = $("#ealert-container");
            if (data["status"] === "failure") {
                responseElem.removeClass("alert-success").addClass("alert-danger");
                $("#loadingdiv").hide();
            } else if (data["status"] === "success") {
                responseElem.removeClass("alert-danger").addClass("alert-success");
                $("#loadingdiv").hide();
            }
            responseElem.html(data["message"]);
        });
    });
    $("button.edit-entry").each(function() {
        var self = $(this), ref = String(self.data("entry")), data = "edit-entry=true&ref=" + escape(ref);
        self.click(function(e) {
            e.preventDefault();
            $.post("executeeditentry", data, function(data) {
                data = JSON.parse(data);
                $('#form_editentry input[name="eeothername"]').val(data.Othername);
                $('#form_editentry input[name="eedob"]').val(data.DOB);
                $('#form_editentry input[name="eephonenumber"]').val(data.Phonenumber);
                $('#form_editentry input[name="eeemailaddress"]').val(data.EmailAddress);
                $('#form_editentry input[name="eehomeaddress"]').val(data.HomeAddress);
                $('#form_editentry input[name="eeoccupation"]').val(data.Occupation);
                $('#form_editentry input[name="eeworkplace"]').val(data.WorkPlace);
                $('#form_editentry input[name="eeworkaddress"]').val(data.WorkAddress);
                $("#form_editentry button").attr("data-id", data.UniqueID);
            });
        });
    });
    $("#form_editentry").submit(function(e) {
        e.preventDefault();
        var ref = String($("#form_editentry button").data("id")), fetch = {
            othername: String($("#eeothername").val()),
            dob: String($("#eedob").val()),
            phonenumber: String($("#eephonenumber").val()),
            emailaddress: String($("#eeemailaddress").val()),
            homeaddress: String($("#eehomeaddress").val()),
            occupation: String($("#eeoccupation").val()),
            workplace: String($("#eeworkplace").val()),
            workaddress: String($("#eeworkaddress").val()),
            id: escape(ref)
        }, data = [], ready = true;
        $.each(fetch, function(key, val) {
            data.push(key + "=" + escape(val));
            if (val.trim().length === 0) {
                ready = false;
            }
        });
        ready && $.post("executeeditentry", data.join("&"), function(data) {
            var data = JSON.parse(data), responseElem = $("#eealert-container");
            if (data["status"] === "failure") {
                responseElem.removeClass("alert-success").addClass("alert-danger");
            } else if (data["status"] === "success") {
                responseElem.removeClass("alert-danger").addClass("alert-success");
            }
            responseElem.html(data["message"]);
        });
    });
    $("button.train-album").each(function() {
        var self = $(this), ref = String(self.data("entry"));
        $(this).click(function(e) {
            e.preventDefault();
            $("#form_trainalbum").append('<input type="hidden" class="entryid" name="entryid" value="' + ref + '" />');
        });
    });
    var max_fields = 10, wrapper = $(".imageurl_fields"), add_button = $(".addimage_field");
    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div class="form-group"><label class="col-sm-2 control-label">#' + x + '</label><div class="col-sm-6"><input type="text" placeholder="Insert image URL" class="form-control imageurlfield" name="imageURL[]" required /></div><a href="#" class="removeimage_field">Remove</a></div>');
        }
    });
    $(wrapper).on("click", ".removeimage_field", function(e) {
        e.preventDefault();
        $(this).parent("div").remove();
        x--;
    });
    $("#form_trainalbum").submit(function(e) {
        e.preventDefault();
        var self = $(this), images = [], data = {}, ready = true;
        $.each($('#form_trainalbum input[class="imageurlfield"]'), function() {
            images.push(escape(self.val()));
            if (self.val().trim().length === 0) {
                ready = false;
            }
        });
        data["id"] = String($('#form_trainalbum input[name="entryid"]').val());
        data["dataset"] = images;
        ready && $.post("executetrain", JSON.stringify(data), function(data) {
            var data = JSON.parse(data), responseElem = $("#alert-container");
            if (data["status"] === "failure") {
                responseElem.removeClass("alert-success").addClass("alert-danger");
            } else if (data["status"] === "success") {
                responseElem.removeClass("alert-danger").addClass("alert-success");
            }
            responseElem.html(data["message"]);
        });
    });
    var uploadBtn = document.getElementById("uploadBtn"), photoName, photoURL;
    uploadBtn.onchange = function() {
        photoName = this.value.substr(12);
        photoURL = "http://npfims.com/photos/" + photoName;
        document.getElementById("image").value = photoURL;
    };
    $("#form_search").submit(function(e) {
        e.preventDefault();
        $("#loadingdiv").show();
        var image, file, ready = true;
        if (uploadBtn.files.length > 0) {
            file = uploadBtn.files[0];
            if (!file.type.match("image.*")) {
                ready = false;
            }
            var formData = new FormData();
            formData.append("file", file, file.name);
            $.ajax({
                url: "executeinternal",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: "POST",
                async: false,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status === "success") {
                        image = photoURL;
                    }
                }
            });
        } else {
            image = escape(String($("#image").val()));
            if (image.trim().length === 0) {
                ready = false;
            }
        }
        ready && $.post("executeinternal", image, function(data) {
            var data = JSON.parse(data), responseElem = $("#internal-alert-container"), resultModal = $("#resultModal"), sex;
            if (data["status"] === "failure") {
                responseElem.removeClass("alert-success").addClass("alert-danger").html(data["message"]);
                $("#loadingdiv").hide();
            } else if (data["status"] === "success") {
                $("#loadingText").html(data["message"]);
                if (data["details"]["Sex"] === "M") sex = "Male";
                if (data["details"]["Sex"] === "F") sex = "Female";
                resultModal.find("#displayimage").attr("src", data["details"]["BaseIMG"]);
                resultModal.find("#firstname").html(data["details"]["Firstname"]);
                resultModal.find("#lastname").html(data["details"]["Lastname"]);
                resultModal.find("#othername").html(data["details"]["Othername"]);
                resultModal.find("#dob").html(data["details"]["DOB"]);
                resultModal.find("#sex").html(sex);
                resultModal.find("#email").html(data["details"]["EmailAddress"]);
                resultModal.find("#phonenumber").html(data["details"]["Phonenumber"]);
                resultModal.find("#confidence").html(data["confidence"]);
                resultModal.find("#homeaddress").html(data["details"]["HomeAddress"]);
                resultModal.find("#occupation").html(data["details"]["Occupation"]);
                resultModal.find("#workplace").html(data["details"]["WorkPlace"]);
                resultModal.find("#workaddress").html(data["details"]["WorkAddress"]);
                resultModal.modal("show");
                setTimeout(function() {
                    $("#loadingdiv").hide();
                }, 2e3);
            }
        });
    });
    $("#logout").click(function(e) {
        e.preventDefault();
        $.post("executelogout", null, function(data) {
            var data = JSON.parse(data);
            document.location = data["redirect"];
        });
    });
});