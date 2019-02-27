
import { getUserData, getBookData, getUpcomingEvent, checkIfAttending, getUserSessions } from './functions/dataCalls';

import { admin_update_book, user_attending, user_not_attending } from './functions/adminCalls';

import { buildEditForm } from './functions/buildEditForm';

if(page === 'edit'){

	
	const callDisplayEditForm = (userData, bookData, nextEvent, attending) => {
		//calls the helper function to display the edit form
		buildEditForm(bookData, nextEvent, attending, async () => {
			//This function is run when the form is submitted

			let formData = {};

			//gets the data from the form
			$('.admin_edit_form').serializeArray().forEach(({ name, value }) => {
			    formData[name] = value;
			});

			console.log(formData);


			//check to see if the admin role is set
			const role = await getUserSessions('user_role');

			if(role === 'admin'){
			
				//this function updates the users book data only
				admin_update_book(formData, await getId());

				//we first need to check if atteding is true
				//then we check to see if it reflects the db 
				//if it does, we do nothing, if they are different we update the db

				const nextEvent = await getUpcomingEvent();
				//gets whether the user is attending the event
				const { eventId } = nextEvent;

				const attending = await checkIfAttending(await getId(), eventId);


				const editAttending = formData.edit_attending_next_event === "true" ? true : false;

				if(attending !== editAttending){

					//here we know we need to change the attending

					if(editAttending){
						//we need to add the user to the attending table
						user_attending(await getId(), eventId);
					} else {
						//we need to remove the user from the attending table
						user_not_attending(await getId(), eventId);
					}
				}

			}
		})
	}

	//this gets the user data and the book data from the user with the id
	const getData = async () => {

		const id = getId();

		//gets the users user data
		const userData = await getUserData(id);
		//gets the users book data
		const bookData = await getBookData(id);
		//gets the next upcoming event
		const nextEvent = await getUpcomingEvent();
		//gets whether the user is attending the event
		const { eventId } = nextEvent;

		const attending = await checkIfAttending(id, eventId);


		//once we get all the necessarry data we display the edit book form
		callDisplayEditForm(userData, bookData, nextEvent, attending);
	}

	const getId = () => {

		var parts = window.location.search.substr(1).split("&");
		var $_GET = {};
		for (var i = 0; i < parts.length; i++) {
		    var temp = parts[i].split("=");
		    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
		}

		return $_GET['userId'];
	}

	$(document).ready(() => {

		console.log('Edit page is ready to go');

		getData();

	});
}