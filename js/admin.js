

import { addEvent } from './admin/add_event';
import { attendeeList } from './admin/attendee_list';
import { pendingBooks } from './admin/pending_books';
import { pendingLibrarians } from './admin/pending_librarians';
import { massEmail } from './admin/mass_email';
import { listUsers } from './admin/list_users';
import { eventController } from './admin/event_controller';

//Though process behind below is so I have all vars in one place, if I need to change it it is right here
//and I do not need to look through a ton of file or lines of code to find it

//I might want to add more if there is a necessity for them

//This section is going to be used for section id's
export const addEventSection = '#addEventSection';
export const attendeeListSection = '#attendeeListSection';
export const pendingBooksSection = '#pendingBookSection';
export const pendingLibrarianSection = '#pendingLibrarianSection';
export const massEmailSection = '#massEmailSection';
export const listUsersSection = '#listUsersSection';
export const eventControllerSection = '#eventControllerSection';

//This is going to be the central hub for the the admin page.
if(page == 'admin'){


	//eventually this is going to be used for displaying all of the content sections on the admin page
	const displayAdminLayout = () => {
		
	}

		

		
		


	$(document).ready(function(){
		console.log("admin page is ready");



		//most recent functions I'm using
		addEvent();
		attendeeList();
		pendingBooks();
		pendingLibrarians();
		massEmail();
		listUsers();
		eventController();

		//displayAdminLayout();
	})

}