// JavaScript Validation For Registration Page

$("document").ready(function() {
  // name validation
  var nameregex = /^[a-zA-Z]+$/;

  $.validator.addMethod("validname", function(value, element) {
    return this.optional(element) || nameregex.test(value);
  });

  // valid email pattern
  var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  $.validator.addMethod("validemail", function(value, element) {
    return this.optional(element) || eregex.test(value);
  });

  // phone number validation
  var pregex = /^07/;

  $.validator.addMethod("validphone", function(value, element) {
    return this.optional(element) || pregex.test(value);
  });

  $("#signup-form").validate({
    rules: {
      firstName: {
        required: true,
        validname: true,
        minlength: 3
      },
      lastName: {
        required: true,
        validname: true,
        minlength: 3
      },
      email: {
        required: true,
        validemail: true,
        remote: {
          url: "check-exists.php",
          type: "post",
          data: {
            email: function() {
              return $("#email").val();
            }
          }
        }
      },
      idNumber: {
        required: true,
        minlength: 5,
        maxlength: 10,
        remote: {
          url: "check-exists.php",
          type: "post",
          data: {
            idNumber: function() {
              return $("#idNumber").val();
            }
          }
        }
      },
      phoneNumber: {
        required: true,
        validphone: true,
        minlength: 10,
        maxlength: 10,
        remote: {
          url: "check-exists.php",
          type: "post",
          data: {
            phoneNumber: function() {
              return $("#phoneNumber").val();
            }
          }
        }
      },
      password: {
        required: true,
        minlength: 6,
        maxlength: 15
      },
      cpassword: {
        required: true,
        equalTo: "#password"
      }
    },
    messages: {
      firstName: {
        required: "First Name is required",
        validname: "First Name is invalid",
        minlength: "Your First Name name is too short"
      },
      lastName: {
        required: "Last Name is required",
        validname: "Last Name is invalid",
        minlength: "Your Last name is too short"
      },
      email: {
        required: "Email is required",
        validemail: "Please enter valid email address",
        remote: "Email already exists"
      },
      idNumber: {
        required: "ID Number is required",
        minlength: "ID Number seems short",
        maxlength: "ID Number seems long",
        remote: "ID Number already exists"
      },
      phoneNumber: {
        required: "Phone Number is required",
        validphone: "Should start with '07'",
        minlength: "Phone number seems short",
        maxlength: "Phone number seems long",
        remote: "Phone number already exists"
      },
      password: {
        required: "Password is required",
        minlength: "Password at least have 6 characters"
      },
      cpassword: {
        required: "Retype your password",
        equalTo: "Password did not match !"
      }
    },
    errorPlacement: function(error, element) {
      $(element)
        .closest(".form-group")
        .find(".help-block")
        .html(error.html());
    },
    highlight: function(element) {
      $(element)
        .closest(".form-group")
        .removeClass("has-success")
        .addClass("has-error");
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element)
        .closest(".form-group")
        .removeClass("has-error");
      $(element)
        .closest(".form-group")
        .find(".help-block")
        .html("");
    },
    submitHandler: submitForm
  });

  function submitForm() {
    $.ajax({
      url: "signup-ajax.php",
      type: "POST",
      data: $("#signup-form").serialize(),
      dataType: "json"
    })
      .done(function(data) {
        $("#btn-signup")
          .html('<img src="ajax-loader.gif" /> &nbsp; signing up...')
          .prop("disabled", true);
        $(
          "input[type=text],input[type=email],input[type=number],input[type=password]"
        ).prop("disabled", true);

        setTimeout(function() {
          if (data.status === "success") {
            swal("Success!", data.message, "success");
            $("#errorDiv")
              .slideDown("fast", function() {
                // $("#errorDiv").html(
                //   '<div class="alert alert-info">' + data.message + "</div>"
                // );
                $("#signup-form").trigger("reset");
                $(
                  "input[type=text],input[type=email],input[type=number],input[type=password]"
                ).prop("disabled", true);
                $("#btn-signup")
                  .html("Create another account")
                  .prop("disabled", true);
              })
              .delay(3000)
              .slideUp("fast");
          } else {
            $("#errorDiv")
              .slideDown("fast", function() {
                // $("#errorDiv").html(
                //   '<div class="alert alert-danger">' + data.message + "</div>"
                // );
                swal("Error!", data.message, "danger");
                $("#signup-form").trigger("reset");
                $(
                  "input[type=text],input[type=email],input[type=password]"
                ).prop("disabled", false);
                $("#btn-signup")
                  .html("SIGNUP AGAIN")
                  .prop("disabled", false);
              })
              .delay(3000)
              .slideUp("fast");
          }
        }, 3000);
      })
      .fail(function() {
        $("#signup-form").trigger("reset");
        alert("An unknown error occoured, Please try again Later...");
      });
  }
});
