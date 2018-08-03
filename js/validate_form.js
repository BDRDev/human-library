
//This is a js file where we can vlaidate all forms based on the page

//import $ from "jquery";
import validate from 'jquery-validation';

if(page == 'set_password'){

	console.log('File: profile/set_password.php');
	console.log("Page: " + page);

	$('#bookSignUpForm').validate({
		rules: { 
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				equalTo: "#password"
			}
		},
		errorPlacement: function(error, element) {
			let placement = $(element).data('error');
			if(placement){
				$(placement).append(error)
			}
		}
	});


	$(".actual_input").focusout(function(){

		console.log($(this).length);

		if($(this).length > 1){
			console.log($(this).valid());
		}
	})
}