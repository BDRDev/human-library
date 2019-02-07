

import { getUpcomingEvent, getAttendingUsers } from '../functions/dataCalls';


import { eventControllerSection } from '../admin';

export const eventController = async () => {

	//first thing we need to do is get the next event

	const event = await getUpcomingEvent();

	console.log('event', event);

	const users = await getAttendingUsers(event.eventId);

	console.log('users', users);

	getDate(event.date);
}

const getDate = (event) => {

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
	console.log(today)

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

	    console.log('difference', difference)
}

//this is going to have the name of the event / event locations / time etc
//how many books / librarians are signed up
//how many days until the event
//start and stop event
//then maybe a do not let users update info button