
import { getUsers } from '../functions/dataCalls';

import { listUsersSection } from '../admin';

export const listUsers = async role => {


	//this is to display the button to select the users you want to show
	// all, books, or librarians
	displayOptions();
	displayUsers();
}

const displayOptions = () => {

	const userOptions = 
		"<div class='userDisplayOptions'>" + 

			"<div id='all' class='displayOption'>All</div>" + 
			"<div id='book' class='displayOption'>Books</div>" +
			"<div id='librarian' class='displayOption'>Librarians</div>" +

		"</div>";

	$(listUsersSection).append(userOptions);
	$(listUsersSection).append("<div class='displayUsers'></div>")

	$('.displayOption').bind('click', e => {

		displayUsers(e.target.id);
	}) 
}

const displayUsers = async role => {

	let users;

	if(role){
		users = await getUsers(role);
	} else {
		users = await getUsers('all');
	}

	console.log(role, users);

	$('.displayUsers').empty();

	users.forEach(({ userId, firstName, lastName, email, role, dateSignedUp }) => {

		if(!dateSignedUp){
			dateSignedUp = '< 2019/01/28';
		}

		$('.displayUsers').append(`<div>${firstName} ${lastName} - Email: ${email} -- ${role} -- ${dateSignedUp}

			${role === 'book' ? `<a href="/humanLibrary/admin/edit.php?userId=${userId}">Edit</a>` : '' }</div>`);
	})
}