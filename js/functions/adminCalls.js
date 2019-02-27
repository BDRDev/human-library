import {

	admin_update_book_url
} from '../global_vars';

const prefix = "/humanlibrary";

//responsible for updating only the bookDisplay table
export const admin_update_book = async (data, userId) => {

	const result = await $.post(`${prefix}/api/admin/updateBook`, { dataArray: data, userId });

	console.log('result', result);
}

//adds a user to the attending table
export const user_attending = async (userId, eventId) => {

	console.log('attending', `userId: ${userId} eventId: ${eventId}`);

	const result = await $.post(`${prefix}/api/admin/bookAttending`, { userId, eventId });

	console.log('result', result);
}

//removes a user from the attending table
export const user_not_attending = async (userId, eventId) => {

	console.log('not attending', `userId: ${userId} eventId: ${eventId}`);

	const result = await $.post(`${prefix}/api/admin/bookNotAttending`, { userId, eventId });

	console.log('result', result);
}