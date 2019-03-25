
import { getUsers } from '../functions/dataCalls';

import { prefix } from '../global_vars';

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
	displayHeaders();
	$(listUsersSection).append("<div class='displayUsers'></div>")

	$('.displayOption').bind('click', e => {

		displayUsers(e.target.id);
	}) 
}

const displayHeaders = () => {
	const userHeaders = 
	`<div class='userDisplayHeaders'>
		<div class='header'>Name</div>
		<div class='email'>Email</div>
		<div class='role'>Role</div>
		<div class='header'>Signup Date</div>
	</div>`;

	$(listUsersSection).append(userHeaders);
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

		$('.displayUsers').append(`

			<div class='user'>
				<div class='header'>${firstName} ${lastName}</div>
				<div class='email'>${email}</div>
				<div class='role'>${role}</div> 
				<div class='header'>${dateSignedUp}</div>

				${role === 'book' ? `<a href='${prefix}/admin/edit.php?userId=${userId}'>Edit</a>` : '' }</div>
			</div>`

		);
	})
}