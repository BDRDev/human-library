
import {
	list_users_url,
	get_all_books_url,
	get_available_books_url,
	sign_up_user_url,
	book_account_success_url,
	librarian_account_success_url,
	book_account_success_admin_url,
	librarian_account_success_admin_url,
	create_empty_book_url,
	create_empty_librarian_url,
	attempt_to_login_url,
	get_user_data_url, 

	get_user_book_data_url, 
	get_user_librarian_data_url,
	get_event_book_list_url,
	
	update_unverified_user_url, 
	send_unverified_email_url,

	update_verified_user_url,
	update_verified_librarian_url,

	get_events_list_url,
	get_specific_attend_list_url,

	get_pending_users_url,
	get_pending_librarians_url,

	update_pending_users_url,
	get_user_data_email_url,
	user_sessions_url,
	get_next_event_url,
	check_if_attending_url,
	get_emails_url,
	mass_email_url,
	check_unique_email_url,
	get_user_email_url,
	send_book_approved_email_url,
	send_librarian_approved_email_url,

	send_email_url,

	add_new_event_url,

} from '../global_vars';

export const addNewEvent = async formData => {

	console.log('addNewEvent', formData);

	$.ajax({
		type: 'POST',
		url: add_new_event_url,
		data: formData,
		dataType: 'json',
		success: (result) => {
			console.log(result);
		},
		error: () => {
			console.log('wrong');
		}
	});
}

export const getUsers = async role => {

	const users = await $.ajax({
		type: 'GET',
		url: list_users_url,
		data: { role: role },
		dataType: 'json'
	})

	return users;

}

export const signUp = async userData => {

	console.log("userData", userData);

	const result = await $.ajax({
		type: 'POST',
		url: sign_up_user_url,
		data: {
			first: userData.first,
			last: userData.last,
			email: userData.email,
			password: userData.password,
			role: userData.role
		}
	});

	return result;

}

export const checkForUniqueEmail = (email, callback) => {
	console.log("check for unique email", email);
	$.ajax({
		type: 'POST',
		url: check_unique_email_url,
		async: false,
		data: {
			email: email
		},
		success: (result) => {
			//console.log("result", result);
			callback(result);
		}
	})
} 

export function createEmptyBook(userId, callback){

	console.log("create empty book", userId);

	$.ajax({
		type: 'POST',
		url: create_empty_book_url,
		data: {
			displayId: userId
		},
		success: (result) => {
			console.log("empty book was successfully created");
			callback();
		}
	})

}

export const createEmptyLibrarian = (userId, callback) => {

	console.log("create empty librarian", userId);

	$.ajax({
		type: 'POST',
		url: create_empty_librarian_url,
		data: {
			displayId: userId
		},
		success: (result) => {
			console.log("empty librarian was successfully created");
			callback();
		}
	})

}

export const attemptLogin = async formData => {

	console.log("attempt to login");

	const user = $.ajax({
		type: 'GET',
		url: attempt_to_login_url,
		dataType: 'json',
		data: {
			email: formData.email,
			password: formData.password
		}
	});

	return user;

}

export function getAllBooks(callback){

	$.ajax({
		type: 'GET',
		url: get_all_books_url,
		dataType: 'json',
		success: (result) => {
			callback(result);
		} 
	})
}

export function getAvailableBooks(callback){

	$.ajax({
		type: 'GET',
		url: get_available_books_url,
		dataType: 'json',
		success: (result) => {
			callback(result);
		}
	})
}

export const getUserData = async userId => {

	let result = await $.ajax({
	        type: 'GET',
	        url: get_user_data_url,
	        data: {
	        	userId: userId
	        },
	        dataType: 'json',
	    })
	return result;

}

export const updateUnverifiedUser = async (userId, formData) => {

	console.log("update function", formData);

	let why_book = formData.why_book;
	let book_overview = formData.book_overview;

	console.log("why_book", why_book);
	console.log("book_overview", book_overview);

	let result = await $.ajax({
        type: 'GET',
        url: update_unverified_user_url,
        data: {
        	userId: userId,
        	why_book: why_book,
        	book_overview: book_overview
        },
        dataType: 'json',
    })

    return result;
}

export function sendUnverifiedEmail(data){

	console.log("sending an email to admin regarding unverified user");

	console.log("data", data);

	$.ajax({
		type: 'POST',
		url: send_unverified_email_url,
		data: data,
		success: function(){
			console.log("the admin was successfully emailed");
		}
	})
}

export const bookApprovedEmail = (email) => {
	console.log("sending an email to user reguarding getting approved");

	$.ajax({
		type: 'POST',
		url: send_book_approved_email_url,
		data: {
			email: email
		},
		success: () => {
			console.log("user - book - was successfully emailed")
		}
	})
}

export const librarianApprovedEmail = (email) => {
	console.log("sending an email to librarian reguarding getting approved");

	$.ajax({
		type: 'POST',
		url: send_librarian_approved_email_url,
		data: {
			email: email
		},
		success: () => {
			console.log("user - librarian - was successfully emailed")
		}
	})
}

export function getBookData(userId, callback){
	console.log("get users book data");

	console.log("userId", userId);

	$.ajax({
	        type: 'GET',
	        url: get_user_book_data_url,
	        data: {
	        	displayId: userId
	        },
	        dataType: 'json',
	        success: function(result){
	        	console.log("result", result);
	            callback(result);
	        }
	    })

}

export const getLibrarianData = (userId, callback) => {
	console.log("get users librarian data");

	$.ajax({
	        type: 'GET',
	        url: get_user_librarian_data_url,
	        data: {
	        	displayId: userId
	        },
	        dataType: 'json',
	        success: function(result){
	        	console.log("result", result);
	            callback(result);
	        }
	    })

}

export const updateVerifiedUser = (userId, data, callback) => {

	console.log("update verified user data", data);

	let title = data.title;
	let description = data.description;
	let chapter_one = data.chapter_one;
	let chapter_two = data.chapter_two;
	let chapter_three = data.chapter_three;
	let start_time = data.start_time;
	let end_time = data.end_time;

	$.ajax({
        type: 'GET',
        url: update_verified_user_url,
        data: {
        	userId: userId,
        	title: title,
        	description: description,
        	chapter_one: chapter_one,
        	chapter_two: chapter_two,
        	chapter_three: chapter_three,
        	start_time: start_time,
        	end_time: end_time
        },
        dataType: 'json',
        success: function(result){
        	console.log("result", result);
            callback();
        }
    })
}

export const updateVerifiedLibrarian = (userId, data, callback) => {
	$.ajax({
        type: 'GET',
        url: update_verified_librarian_url,
        data: {
        	userId: userId,
        	start_time: data.start_time,
        	end_time: data.end_time
        },
        dataType: 'json',
        success: function(result){
        	console.log("result", result);
            callback();
        },
        error: () => {
        	console.log("was an error");
        }
    })
}


//This is used to get a list of all of the events in the database

export function getAllEvents(callback){

	$.ajax({
		url: get_events_list_url,
		dataType: 'json',
		success: function(events){
			
			callback(events);
		}
	})
}

//used to get a single attendee
export function getOneAttendee(userId, callback){

	console.log("getOneAttendee", userId);

	$.ajax({
		url: get_specific_attend_list_url,
		dataType: 'json',
		data: {
			userId: userId
		},
		success: function(result){
			
			callback(result);

		}
	})
}

//this is used to get all of the users who need to be approved to be a book
export const getPendingBooks = async () => {

	console.log("get the pending Books");

	const books = await $.ajax({
		url: get_pending_users_url,
		dataType: 'json',
	})

	return books;
}

export const getPendingLibrarians = async () => {
	let librarians = await $.ajax({
		url: get_pending_librarians_url,
		dataType: 'json',
	})

	return librarians;
}


//this is used to set books from pending to approved
export const approveUser = async userId => {

	console.log("appprove the pending users");

	const approved = await $.ajax({
		url: update_pending_users_url,
		data: { userId: userId },
		dataType: 'json'
	})

	console.log(approved); 

	return approved

}

//This function sends an email to the user when they successfully create a book account
export function bookSignUpSuccessEmail(data){

	$.ajax({
		type: 'POST',
		url: book_account_success_url,
		data: data,
		success: function(){
			console.log("the user - book - was successfully emailed");
		}
	})
}

//This function sends an email to the user when they successfully create an accout
export function librarianSignUpSuccessEmail(data){

	$.ajax({
		type: 'POST',
		url: librarian_account_success_url,
		data: data,
		success: function(){
			console.log("the user - librarian - was successfully emailed");
		}
	})
}

//this function sends an email to the admin when a user successfully creates an account
export function bookSignUpSuccessEmailAdmin(data){

	$.ajax({
		type: 'POST',
		url: book_account_success_admin_url,
		data: data,
		success: function(){
			console.log("the admin was successfully emailed - book");
		}
	})
}

//this function sends an email to the admin when a user successfully creates an account
export function librarianSignUpSuccessEmailAdmin(data){

	$.ajax({
		type: 'POST',
		url: librarian_account_success_admin_url,
		data: data,
		success: function(){
			console.log("the admin was successfully emailed - librarian");
		}
	})
}

export function getUserDataEmail(email, callback){

	console.log("email", email);

	$.ajax({
		type: 'GET',
		url: get_user_data_email_url,
		dataType: 'json',
		data: {
			email: email
		},
		success: function(result){
			callback(result)
		},
		
	})
}


// export const getPendingLibrarians = async () => {
// 	let librarians = await $.ajax({
// 		url: get_pending_librarians_url,
// 		dataType: 'json',
// 	})

// 	return librarians;
// }

export const getUserSessions = async session => {

	console.log("getUserSessions", session);

	try {
		let result = await $.ajax({
			type: 'GET',
			url: user_sessions_url,
			data: {
				action: 'retrieve',
				session: session
			}
		})
		return result;
	} catch(error) {

	}
}


export function setUserSessions(session, value){

	console.log("setting: " + session + " as : " + value);

	$.ajax({
		type: 'POST',
		url: user_sessions_url,
		data: {
			action: 'set',
			session: session,
			value: value
		},
		success: (result) => {
			console.log("successfully set " + session);
		},
		error: () => {
			console.log('error function');
		}
	})
}

export function destroyUserSession(session){

	console.log(`destroying ${session} session`);

	$.ajax({
		type: 'GET',
		url: user_sessions_url,
		data: {
			action: 'destroy',
			session: session,
		},
		success: (result) => {
			console.log("successfully destroyed " + session, result);
		},
		error: () => {
			console.log('error function');
		}
	})
}

export const getUpcomingEvent = async () => {

	console.log('getting the next event');

	let result = await $.ajax({
		type: 'GET',
		url: get_next_event_url,
		dataType: 'json',
	})

	return result;
}

export const getAttendingUsers = async eventId => {

	const result = await $.ajax({
		type: 'GET',
		url: get_event_book_list_url,
		dataType: 'json',
		data: {
			eventId: eventId
		}

	})

	return result
}

//This is the check to see if the user is attending the next upcoming event
export const checkIfAttending = async (userId, eventId) => {

	console.log("This is the checkIfAttending function from dataCalls", userId, eventId);
	
	let result = await $.ajax({
		type: 'GET',
		url: check_if_attending_url,
		dataType: 'json',
		data: {
			userId: userId,
			eventId: eventId
		}
	});

	console.log("RESULT", result);
	return result;



}

export const getEmails = (role, callback) => {
	console.log("() => getEmails from 'dataCalls'", role);
	$.ajax({
		type: 'GET',
		url: get_emails_url,
		dataType: 'json',
		data: {
			role: role
		},
		success: (result) => {
			callback(result);
		}
	});
}

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

export const getUserEmail = (userId, callback) => {
	console.log("() => getUserEmail from 'dataCalls'");

	$.ajax({
		type: 'GET',
		url: get_user_email_url,
		dataType: 'json',
		data: {
			userId: userId
		},
		success: (result) => {
			console.log("get user email based off userId result", result);
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