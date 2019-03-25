

import { getUpcomingEvent } from '../functions/dataCalls';

import { getAttendingUsers } from '../functions/adminCalls';


import { eventControllerSection } from '../admin';

export const eventController = async () => {

	//first thing we need to do is get the next event

	const event = await getUpcomingEvent();

	console.log('event', event);

	displayEventDetails(event);
	displayDaysUntilEvent(event);
	displayAttendingNumbers(event);

	

	
}

const displayAttendingNumbers = async ({ eventId }) => {

	//number of users attending
	const users = await getAttendingUsers(eventId);
	const books = users.filter(({ role }) => role === 'book' );
	const librarians = users.filter(({ role }) => role === 'librarian');

	const attendingUsers = 
		`<div>
			<h4>Attending Numbers</h4>
			<div class='numbers-total'>Total: ${users.length}</div>
			<div class='numbers-books'>Books: ${books.length}</div>
			<div class='numbers-librarians'>Librarians: ${librarians.length}</div>
		</div>`


	$('#attendingUsersWrapper').html(attendingUsers)
}

const displayDaysUntilEvent = ({ date }) => {

	

	//days until the event
	const difference = getDate(date);

	console.log('difference', difference);

	const daysUntilEvent = 
		`<div>
			Days until next event: ${difference}
		</div>`;

	$('#daysUntilEventWrapper').html(daysUntilEvent);
}

const displayEventDetails = ({ name, date, address, city, state, room, event_start, event_end }) => {

	//console.log('display event details');

	const eventDetails = 
		`<div class='eventDetails'>
			<h4>Event Details</h4>
			<div class='event-name'>${name}</div>
			<div class='event-date'>${date}</div>
			<div class='event-address-1'>${address}</div>
			<div class='event-address-2'>${city}, ${state}</div>
			<div class='event-room'>Room: ${room}</div>
			<div class='event-time'>${event_start} - ${event_end}</div>
		</div>`

	$('#eventDetailsWrapper').html(eventDetails);
}

const getDate = event => {

	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth() + 1; //January is 0!
	var yyyy = today.getFullYear();

	if (dd < 10) {
	  dd = '0' + dd;
	}

	if (mm < 10) {
	  mm = '0' + mm;
	}

	today = yyyy + '/' + mm + '/' + dd;
	//console.log(today)

	//console.log('days until', event - today);

	const _MS_PER_DAY = 1000 * 60 * 60 * 24;

	// a and b are javascript Date objects
	function dateDiffInDays(a, b) {
	  // Discard the time and time-zone information.
	  const utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
	  const utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());

	  return Math.floor((utc2 - utc1) / _MS_PER_DAY);
	}

	// test it
	const a = new Date(today),
	    b = new Date(event),
	    difference = dateDiffInDays(a, b);

	   return difference;
}

//this is going to have the name of the event / event locations / time etc
//how many books / librarians are signed up
//how many days until the event
//start and stop event
//then maybe a do not let users update info button