//This file is responsible for getting a list of users that will be attending the next upcoming event

import { getUpcomingEvent, getAttendingUsers } from '../functions/dataCalls';

import { attendeeListSection } from '../admin';

//this is the main function for the page, this will get called from the admin page
export const attendeeList = async () => {

	//console.log('attendee List')

	//first thing we need to do is get the upcoming event;
	const event = await getUpcomingEvent();

	//next thing we need to do is get a list of users that are attending the event
	const users = await getAttendingUsers(event.eventId);

	//now that we have the event and the attendees we need to print it to the page

	// console.log('nextEvent', event);
	// console.log('attendingUsers', users);

	//print the title of the event
	$(attendeeListSection).append(`<div>Event: ${event.name}</div>`);

	//now we print the users
	users.forEach(({ firstName, lastName, email }) => {
		$(attendeeListSection).append(`<div>${firstName} ${lastName} - Email: ${email}</div>`);
	})

}