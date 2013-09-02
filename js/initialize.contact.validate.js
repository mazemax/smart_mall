$(document).ready(function() {
	$("#contactform").validate({
		errorClass: "error",
		validClass: "success",
		success: function(label) {
			label.text("OK").addClass("success");
		},
		rules: {
			contact_name: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			comment: {
				required: true
			}
		},
		messages: {
			contact_name: "Please enter your name",
			email: {
				required: "Please enter an e-mail",
				email: "Please enter a valid e-mail"
			},
			comment: {
				required: "Please enter a comment"
			}
		}
	});
});