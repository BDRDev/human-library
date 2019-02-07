
//the dataCalls file will hold all of our ajax calls
import { getUserData, getBookData, getLibrarianData, updateUnverifiedUser, 
		 sendUnverifiedEmail, updateVerifiedUser, updateVerifiedLibrarian, 
		 getUpcomingEvent, checkIfAttending } from './functions/dataCalls';

import { printUnverifiedForm, printVerifiedBookForm, printVerifiedLibrarianForm } from './functions/buildForms';
import { printSliders } from './functions/slider';
import { getUserSessions, setUserSessions, sendEmail } from './functions/dataCalls';

import { adminEmail } from './global_vars';

//I think I may need checks to see if a user is logged in

if(page === 'profile'){

	let userData = {};
	let bookData = {};

	let librarianData = {};

	let upcomingEvent = {};
	let attendingEvent = {};


	const displayMessage = (message) => {
		$(".profileMessage").html(message);

		setTimeout(() => {
			clearMessage();
		}, 8000);
	}

	const clearMessage = () => {
		$(".profileMessage").html("");
	}


	const displayVerifiedForm = async () => {

		console.log("bookData", bookData);
		console.log("userData", userData);
		console.log("upcomingEvent", upcomingEvent);

		//look into re factoring this in the future
		let attending = await checkIfAttending(userData.userId, upcomingEvent.eventId)
		attendingEvent = {'att' : attending};
		
		let loop = 0;
		let intervalId = setInterval(() => {

			loop++;
			
			// console.log("bookData", bookData);
			// console.log("userData", userData);
			// console.log("upcomingEvent", upcomingEvent);
			 //console.log("attendingEvent", attendingEvent);

			if(userData.role === "book"){

				if(!jQuery.isEmptyObject(userData) && !jQuery.isEmptyObject(bookData) && 
					!jQuery.isEmptyObject(upcomingEvent) && !jQuery.isEmptyObject(attendingEvent)){

					clearInterval(intervalId);



					//Here is where we print the form if all of the data we need is there
					printVerifiedBookForm(bookData, upcomingEvent, attendingEvent.att, (bookData) => {

						updateVerifiedUser(userData.userId, bookData, () => {
							displayMessage("Your data was successfully updated");
						});
					})
				}
			} else if(userData.role === "librarian"){

				if(!jQuery.isEmptyObject(userData) && !jQuery.isEmptyObject(librarianData) && 
					!jQuery.isEmptyObject(upcomingEvent) && !jQuery.isEmptyObject(attendingEvent)){

					clearInterval(intervalId);

					//Here is where we print the form if all of the data we need is there
					//console.log("PRINT THE VERIFIED LIBRARIAN BOOK");

					console.log("it ran?")

					printVerifiedLibrarianForm(librarianData, upcomingEvent, attendingEvent.att, (librarianData) => {
						console.log("librarian form needs to be submitted", librarianData);

						updateVerifiedLibrarian(userData.userId, librarianData, () => {
							displayMessage("Your data was successfully updated");
						});
					})
				}
			}

		}, 250);	
	} //ends displayVerifiedBookForm

	const displayUnverifiedPage = role => {
		console.log("display unverified page for", role)
		
		printUnverifiedForm(userData, async (formData) => {

			//whenever the form is submitted we will run this, call an ajax call, then 'refresh' the page
			let result = await updateUnverifiedUser(userData.userId, formData);
			
			let emailData = {
				first: userData.firstName,
				last: userData.lastName,
				email: userData.email,
				role: role
			}

			//this is responsible for letting the admin know that there is a book that needs to 
			//be reviewed for being a book
			
			sendEmail('adminUnverifiedNotice', adminEmail, emailData);
			getInformation(userData.userId);
			
		});
	}
	

	const displayPendingPage = role => {
		console.log("display pending page for", role)

		$("#unverifiedWrapper").empty();
		$("#pendingWrapper").html("Thank you we will be in touch shortly with more information");
	}

	const displayVerifiedPage = role => {
		console.log("display verified page for", role)

		if(role === 'book'){
			//Gets the user's bookData
			getBookData(userData.userId, (data) => {
				bookData = data;

				//function that will print all of the sliders
				printSliders(bookData.displayId, () => {
					//this runs when the user clicks on the slider, either
					console.log("A user clicked on the slider");

					//runs when a user clicks on the slider
					displayVerifiedForm();
				});

				//function is self explanatory
				displayVerifiedForm();
			})
		}

		if(role === 'librarian'){

			getLibrarianData(userData.userId, (data) => {
				librarianData = data;
				
				//function that will print all of the sliders
				printSliders(userData.userId, () => {
					console.log("A user clicked on the slider");

					//runs when a user clicks on the slider
					displayVerifiedForm();
				});

				//function is self explanatory
				displayVerifiedForm();
				
			});
			
		}
	}


	//this is a function that decides what to show the user, based on user_status and role
	const displayUserInformation = () => {
		switch(userData.user_status) {
			case 'unverified':
				console.log("unverified user");

				displayUnverifiedPage(userData.role);

				break;
			case 'pending' :
				console.log("pending user");

				displayPendingPage(userData.role);

				break;

			case 'verified' :
				console.log("verified user");

				displayVerifiedPage(userData.role);

				break;
		}
	}

	const getInformation = async currentUserId => {
		console.log("get the user information");

		userData = await getUserData(currentUserId);

		console.log("userData", userData);
		displayUserInformation();			
	}

	$(document).ready(async () => {
		console.log("the profile page is good to go");

		//get the userId based off of the userId Session
		let userId = await getUserSessions("userId");

		console.log("userId", userId);

		//gets us the next upcoming event
		upcomingEvent = await getUpcomingEvent();

		//Once we have the users userId we will go and get their book information base off of the userId
		getInformation(userId);
	})
}