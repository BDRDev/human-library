
import { prefix } from '../global_vars';

//gets a list of users
export const getUsers = async role => {
	const result = await $.get(`${prefix}/api/general/listUsers.php`, { role });
	return $.parseJSON(result);
}

//adds user data to the db when they sign up
export const signUp = async ({ first, last, email, password, role }) => {
	const result = await $.post(`${prefix}/api/general/signUpUser.php`, { first, last, email, password, role });
	return result;
}

//checks to be sure that an email is unique
export const checkForUniqueEmail = async email => {
	const result = await $.post(`${prefix}/api/general/checkUniqueEmail.php`, { email })
	return result;
} 

//when a book signs up, this creates a blank book entry for them
export const createEmptyBook = async displayId => {
	const result = await $.post(`${prefix}/api/general/createEmptyBook.php`, { displayId });
	return result;
}

//when a librarian signs up, this creates a blank librarian entry for them
export const createEmptyLibrarian = async displayId => {
	const result = await $.post(`${prefix}/api/general/createEmptyLibrarian.php`, { displayId })
	return result;
}

//checks to see if the email password combo exists
export const attemptLogin = async ({ email, password }) => {
	const result = await $.get(`${prefix}/api/general/attemptToLogin.php`, { email, password })
	return $.parseJSON(result);
}

//returns a list of all the books
export const getAllBooks = async () => {
	const result = await $.get(`${prefix}/api/general/getAllBooks.php`);
	return $.parseJSON(result);
}

//returns a list of all available books 
export const getAvailableBooks = async () =>{
	const result = await $.get(`${prefix}/api/general/getAvailableBooks.php`);
	return $.parseJSON(result);
}

//gets user data based off of userId
export const getUserData = async userId => {
	const result = await $.get(`${prefix}/api/general/getUserData.php`, { userId })
	return $.parseJSON(result);
}

//when a user updates their 'why' page, sets the data
export const updateUnverifiedUser = async (userId, { why_book, book_overview }) => {
    const result = await $.get(`${prefix}/api/general/updateUnverifiedUser.php`, { userId, why_book, book_overview });
    return result;
}

//gets a users book data
export const getBookData = async displayId => {
    const result = await $.get(`${prefix}/api/general/getBookData.php`, { displayId });
    return $.parseJSON(result);
}

//gets a users librarian data
export const getLibrarianData = async displayId => {
	const result = await $.get(`${prefix}/api/general/getLibrarianData.php`, { displayId });
	return $.parseJSON(result);
}

//updates the book's book data
export const updateVerifiedUser = async (userId, data, callback) => {
    const result = await $.post(`${prefix}/api/book/updateVerified.php`, { userId, dataArray: data });
    callback();
}

//updates the librarian's librarian data
export const updateVerifiedLibrarian = async (userId, data, callback) => {
    const result = await $.post(`${prefix}/api/librarian/updateVerified.php`, { userId, dataArray: data });
    callback();
}

//This is used to get a list of all of the events in the database
//idk what this is for tbh
export const getAllEvents = async callback => {
	const result = await $.get(`${prefix}/api/general/getEventsList.php`);
	callback($.parseJSON(result));
}

//used to get a single attendee
export const getOneAttendee = async (userId, callback) => {
	const result = await $.get(`${prefix}/api/general/getOneAttendee.php`, { userId });
	callback($.parseJSON(result));
}

//gets a user's data based off of their email
export const getUserDataEmail = async email =>{
	const result = await $.get(`${prefix}/api/general/getUserDataEmail.php`, { email })
	return $.parseJSON(result);
}

//gets a users sessions
export const getUserSessions = async session => {
	let result = await $.get(`${prefix}/api/session/userSessions.php`, { action: 'retrieve', session })
	result = result.replace(/(\r\n|\n|\r)/gm, "");
	return result;
}

//sets a users session
export const setUserSessions = async (session, value) => {
	const result = await $.post(`${prefix}/api/session/userSessions.php`, { action: 'set', session, value });
	return result;
}

//deletes a users session
export const destroyUserSession = async session => {
	const result = await $.get(`${prefix}/api/session/userSessions.php`, { action: 'destroy', session })
	return result;
}

//gets the next upcoming event
export const getUpcomingEvent = async () => {
	const result = await $.get(`${prefix}/api/event/getNext.php`);
	return $.parseJSON(result);
}

//This is the check to see if the user is attending the next upcoming event
export const checkIfAttending = async (userId, eventId) => {
	const result = await $.get(`${prefix}/api/general/checkIfAttending.php`, { userId, eventId });
	return $.parseJSON(result);
}

//gets a list of emails based off of a users role
export const getEmails = async role => {
	const result = await $.get(`${prefix}/api/email/getEmails.php`, { role });
	return result;
}

// export const getUserEmail = async userId => {
// 	const result = await $.get(`${prefix}/api/email/getEmail`, { userId })
// 	return result;
// }


export const massEmail = (email, subject, content) => {
	console.log("() => massEmail from 'dataCalls'");

	$.ajax({
		type: 'POST',
		url: mass_email_url,
		data: {
			email: email,
			subject: subject,
			content: content
		},
		success: (result) => {
			console.log('mass email was successfully send to ' + email);
		}
	})
}


export const sendEmail = (emailType, email, formData) => {
	console.log("send an email", formData);

	let first = '';
	let last = '';
	let userEmail = '';
	let role = '';

	if(formData){
		first = formData.first;
		last = formData.last;
		role = formData.role;
		userEmail = formData.email;
	}

	$.ajax({
		type: 'POST',
		url: send_email_url,
		data: {
			emailType: emailType,
			email: email,
			first: first,
			last: last,
			role: role,
			userEmail: userEmail
		},
		success: (result) => {
			console.log("test was success");
		}
	})
}


// error: (jqXHR, exception) => {
//     var msg = '';
//     if (jqXHR.status === 0) {
//         msg = 'Not connect.\n Verify Network.';
//     } else if (jqXHR.status == 404) {
//         msg = 'Requested page not found. [404]';
//     } else if (jqXHR.status == 500) {
//         msg = 'Internal Server Error [500].';
//     } else if (exception === 'parsererror') {
//         msg = 'Requested JSON parse failed.';
//     } else if (exception === 'timeout') {
//         msg = 'Time out error.';
//     } else if (exception === 'abort') {
//         msg = 'Ajax request aborted.';
//     } else {
//         msg = 'Uncaught Error.\n' + jqXHR.responseText;
//     }
//     console.log(msg);
// },

//we could implement an error function idk