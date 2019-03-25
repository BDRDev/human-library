

import { prefix } from '../global_vars';

//responsible for updating only the bookDisplay table
export const admin_update_book = async (data, userId) => {

	const result = await $.post(`${prefix}/api/admin/updateBook.php`, { dataArray: data, userId });
}

//adds a user to the attending table
export const user_attending = async (userId, eventId) => {

	const result = await $.post(`${prefix}/api/admin/bookAttending.php`, { userId, eventId });
}

//removes a user from the attending table
export const user_not_attending = async (userId, eventId) => {

	const result = await $.post(`${prefix}/api/admin/bookNotAttending.php`, { userId, eventId });

}

//adds a new event
export const add_event = async data => {

	const result = await $.post(`${prefix}/api/admin/newEvent.php`, { dataArray: data });
}

//this is used to get all of the users who need to be approved to be a book
export const getPendingBooks = async () => {
	const result = await $.get(`${prefix}/api/admin/getPendingBooks.php`);
	return $.parseJSON(result);
}

//gets a list of all the users who need to br approved to be a librarian
export const getPendingLibrarians = async () => {
	const result = await $.get(`${prefix}/api/admin/getPendingLibrarians.php`);
	return $.parseJSON(result);
}


//this is used to set books from pending to approved
export const approveUser = async userId => {
	const result = await $.post(`${prefix}/api/admin/approveUser.php`, { userId });

	return result;
}

//this is used to set books from pending to declined
export const declineUser = async userId => {

	const result = await $.post(`${prefix}/api/admin/declineUser.php`, { userId });

	return result;
}

//gets a list of users that are attending a certain event
export const getAttendingUsers = async eventId => {

	const result = await $.get(`${prefix}/api/admin/event/list.php`, { eventId });
	return $.parseJSON(result);
}