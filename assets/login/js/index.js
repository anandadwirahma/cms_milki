var $loginForm = $(".form-signin"),
    $login_text_fields = $loginForm.find("input[type='text']");

	$(".login-logo,.form-container").removeClass("off-canvas");

    $loginForm.validate({
      errorElement: "span",
      success: function(label) {
        _form_success_aria(label);
      },
      invalidHandler : function(event, validator){
        _form_error_aria(event);
      }
    });

    function _form_success_aria(label){
      var target = label.parent().find("input");
      target.attr("aria-invalid","false");
    }

    function _form_error_aria(validator){
 		console.log(validator.target.elements[0]);
    }