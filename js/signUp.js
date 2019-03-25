


//page that is going to handle all of the sign up functionality

import { signUp, getUserDataEmail, createEmptyBook, createEmptyLibrarian, checkForUniqueEmail,
  getUserSessions, setUserSessions, sendEmail } from './functions/dataCalls';

import _ from 'lodash';

import { check_unique_email_url, adminEmail, prefix } from './global_vars';

const jqueryValidation = require('jquery-validation');


if(page === 'signUp'){

	const displayMessage = (message) => {
		$(".signUpMessage").html(message);

		setTimeout(() => {
			clearMessage();
		}, 5000);
	}

	const clearMessage = () => {
		$(".signUpMessage").html("");
	}

	const handleBookSignUp = async formData => {
		//here is where we will send all the emails, I might remove the password field for safety

		//email one: A message to the user saying what to do next, as well as if they need anything contact the admin
		sendEmail('userSignUpSuccess', formData.email, formData);

		//email two: A message to the admin saying that the user created an account
		sendEmail('adminNewUserSignUp', adminEmail, formData);

		//next thing we need to do is get the user data
		//here is also where we will set the global user obj
		const user = await getUserDataEmail(formData.email)
			
		//need to create an empty book entry
		await createEmptyBook(user.userId)

		//after this we can re direct the user to their profile page
		setUserSessions("userId", user.userId);
		setUserSessions("user_role", user.role);
		

		window.location =  `${prefix}/profile/index.php`;
				
				
		
	} //ends handleBookSignUp

	const handleLibrarianSignUp = async formData => {

		console.log('handleLibrarianSignUp');

		//email one: A message to the user saying what to do next, as well as if they need anything contact the admin
		sendEmail('userSignUpSuccess', formData.email, formData);

		//email two: A message to the admin saying that the user created an account
		sendEmail('adminNewUserSignUp', adminEmail, formData);

		//next thing we need to do is get the user data
		const user = await getUserDataEmail(formData.email)

		//now we have the user data
		
		//need to create an empty book entry
		await createEmptyLibrarian(user.userId)

		//after this we can re direct the user to their profile page
		setUserSessions("userId", user.userId);
		setUserSessions("user_role", user.role);
		
		window.location = `${prefix}/profile/index.php`;

	}

	const startSignUp = async formData => {

		const result = await signUp(formData);

		//removes both password fields from the rest of the signup process
		formData = _.omit(formData, 'password');
		formData = _.omit(formData, 'confirmPassword');

		//runs if sign up was successful
		if(result){

			//once the user data was saved, we need to decide what we do next based off of the user role
			const { role } = formData;

			if(role === "book"){
				handleBookSignUp(formData)
			} else if(role === "librarian"){
				handleLibrarianSignUp(formData);
			}
		}
		
	} //ends start signUp




	$(document).ready(() => {

		const prefix = '/humanlibrary';

		$(".signUpForm").validate({
			submitHandler: form => {

				let formData = {};

				$('.signUpForm').serializeArray().forEach(({ name, value }) => {
			        formData[name] = value;
			    });

				startSignUp(formData);
			},
			rules: {
				fName: {
					required: true
				},
				lName: {
					required: true
				},
				email: {
					required: true,
					email: true,
					remote: `${prefix}/api/general/checkUniqueEmail.php`
				},
				password: {
					required: true
				},
				confirmPassword: {
					required: true,
					equalTo: "#password"
				}
			},
			messages: {
				fName: "First Name is Required",
				lName: "Last Name is Required",
				email: {
					required: "Email is required",
					email: "Enter a valid email",
					uniqueEmail: "Email is already in use",
					remote: "Email is already being used, please use another"
				},
				password: "Password is Required",
				confirmPassword: {
					required: "Confirm your password",
					equalTo: "Passwords must match"
				}
			},
			errorPlacement: function(error, element) {
		      var placement = $(element).data('error');
		      if (placement) {
		        $(placement).append(error)
		      } else {
		        error.insertAfter(element);
		      }
		    }
		});
	})
}