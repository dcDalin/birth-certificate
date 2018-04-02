$("document").ready(function() {
  /* validation */

  // valid email pattern
  var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  $.validator.addMethod("validemail", function(value, element) {
    return this.optional(element) || eregex.test(value);
  });

  $("#login-form").validate({
    rules: {
      password: {
        required: true,
        minlength: 6
      },
      user_email: {
        required: true,
        validemail: true,
        email: true
      }
    },
    messages: {
      password: {
        required: "Please enter your password",
        minlength: "Password should be at least 6 characters"
      },
      user_email: {
        required: "Please enter your email address",
        validemail: "Please enter a valid email address"
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
  /* validation */

  /* login submit */
  function submitForm() {
    var data = $("#login-form").serialize();

    $.ajax({
      type: "POST",
      url: "index-ajax.php",
      data: data,
      beforeSend: function() {
        $("#error").fadeOut();
        $("#btn-login").html(
          "<img src='ajax-loader.gif'  /> &nbsp; Sending ..."
        );
      },
      success: function(response) {
        if (response == "ok") {
          $("#btn-login").html(
            '<img src="ajax-loader.gif" /> &nbsp; Logging In ...'
          );
          setTimeout(' window.location.href = "home.php"; ', 3000);
        } else {
          $("#error").fadeIn(2000, function() {
            swal("Sorry!", response, "error");
            $("#btn-login").html("Login");
          });
        }
      }
    });
    return false;
  }
  /* login submit */
});
