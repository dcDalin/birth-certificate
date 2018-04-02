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

  $("#birth-cert-form").validate({
    rules: {
      motherId: {
        required: true,
        number: true,
        minlength: 7,
        maxlength: 10,
        remote: {
          url: "check-exists.php",
          type: "post",
          data: {
            motherId: function() {
              return $("#motherId").val();
            }
          }
        }
      },
      childFirstName: {
        required: true,
        validname: true,
        minlength: 3
      },
      childOtherName: {
        required: true,
        validname: true,
        minlength: 3
      },
      fatherTribalName: {
        required: true,
        validname: true,
        minlength: 3
      },
      childDateOfBirth: {
        required: true
      },
      placeOfBirth: {
        required: true,
        validname: true,
        minlength: 3
      },
      townOfBirth: {
        required: true,
        validname: true,
        minlength: 3
      },
      fatherFirstName: {
        required: true,
        validname: true,
        minlength: 3
      },
      fatherOtherName: {
        required: true,
        validname: true,
        minlength: 3
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
      motherId: {
        required: "Mother ID Number is required",
        number: "Only digits allowed",
        minlength: "ID Number seems short",
        maxlength: "ID Number seems long",
        remote: "Mother ID not found"
      },
      childFirstName: {
        required: "First Name is required",
        validname: "First Name is invalid",
        minlength: "Your First Name name is too short"
      },
      childOtherName: {
        required: "Other Name is required",
        validname: "Other Name is invalid",
        minlength: "Child Other Name is too short"
      },
      fatherTribalName: {
        required: "Father Tribal Name is required",
        validname: "Father Tribal Name is invalid",
        minlength: "Father Tribal Name is too short"
      },
      childDateOfBirth: {
        required: "Date of Birth is required"
      },
      placeOfBirth: {
        required: "Place of Birth is required",
        validname: "Place of Birthis invalid",
        minlength: "Place of Birth is too short"
      },
      townOfBirth: {
        required: "Town of Birth is required",
        validname: "Town of Birthis invalid",
        minlength: "Town of Birth is too short"
      },
      fatherFirstName: {
        required: "Father First Name is required",
        validname: "Father First Name is invalid",
        minlength: "Father First Name name is too short"
      },
      fatherOtherName: {
        required: "Father Other Name is required",
        validname: "Father Other Name is invalid",
        minlength: "Father Other Name is too short"
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
      url: "edit-birth-certificate-ajax.php",
      type: "POST",
      data: $("#birth-cert-form").serialize(),
      dataType: "json"
    })
      .done(function(data) {
        $("#btn-birth-cert")
          .html('<img src="ajax-loader.gif" /> &nbsp; Sending...')
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
                $("#birth-cert-form").trigger("reset");
                $(
                  "input[type=text],input[type=email],input[type=number],input[type=password]"
                ).prop("disabled", true);
                $("#btn-birth-cert")
                  .html("SUBMIT DETAILS")
                  .prop("disabled", true);
              })
              .delay(3000)
              .slideUp("fast");
            window.location.href = "admin.php";
          } else {
            $("#errorDiv")
              .slideDown("fast", function() {
                // $("#errorDiv").html(
                //   '<div class="alert alert-danger">' + data.message + "</div>"
                // );
                swal("Error!", data.message, "danger");
                $("#birth-cert-form").trigger("reset");
                $(
                  "input[type=text],input[type=email],input[type=password]"
                ).prop("disabled", false);
                $("#btn-birth-cert")
                  .html("SUBMIT DETAILS")
                  .prop("disabled", false);
              })
              .delay(3000)
              .slideUp("fast");
          }
        }, 3000);
      })
      .fail(function() {
        $("#birth-cert-form").trigger("reset");
        alert("An unknown error occoured, Please try again Later...");
      });
  }
});
