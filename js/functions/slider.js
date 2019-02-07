

//This file is going to be responsible for printing the sliders to the page

import { getAllEvents, getOneAttendee } from './dataCalls';
import { Slider } from './create_slider.js';

let curEvents;
let userList;


export function printSliders(userId, callback){

	console.log("Here is where we will print the sliders");

	

	getAllEvents((events) => {
		console.log("getAllEvents Callback", events);

		curEvents = events;

		console.log("events", curEvents);
		getOneAttendee(userId, (user) => {

			console.log("getOneAttendee Callback", user)

			userList = user;

			showSliders(userId, callback);
		})
	})

}

function showSliders(userId, callback){

	console.log("events", curEvents)

	for(let event of curEvents){
		//console.log(event);

		let userAttend = 'false';
		let sliderId = 'slider_' + event.eventId;

		//tels if the user is attending said event
		userList.find(function(element){

			if(event.eventId === element.event_id){

				//console.log("event id: ", event.eventId);
				//console.log("from the attend table", element.event_id);

				userAttend = 'true';

			}
			

		})

		//console.log("userAttend", userAttend);


		//here we will need to append a section that will give details each event

		//sliderSize, location, id, attending or not, event_id, user_id
		var eventWrapper = "event_" + event.eventId + "_wrapper";

		var eventDetails = "event_" + event.eventId + "_details";
		var sliderHolder = "slider_" + event.eventId + "_holder";

		//console.log(eventDetails);
		//console.log(sliderHolder);

		var sliderSection = "<div class='event_wrapper " + eventWrapper + "'>";
		sliderSection += "<div class='event_details " + eventDetails + "'></div>";
		sliderSection += "<div class='" + sliderHolder + "'></div>";
		sliderSection += "</div>";

		$('#eventWrapper').append(sliderSection);

		
		sliderHolder = '.' + sliderHolder;
		eventDetails = '.' + eventDetails;

		//here is where we need to put the event data in the eventDetails div

		//console.log(event);

		let timeStart = event.event_start;
		let timeEnd = event.event_end;

		if(timeStart < 12){
			timeStart = timeStart + "am";
		} else if(timeStart == 12){
			timeStart = timeStart + "pm";
		} else if(timeStart > 12){
			timeStart = timeStart % 12;
			timeStart = timeStart + "pm";
		}

		if(timeEnd < 12){
			timeEnd = timeEnd + "am";
		} else if(timeEnd == 12){
			timeEnd = timeEnd + "pm";
		} else if(timeEnd > 12){
			timeEnd = timeEnd % 12;
			timeEnd = timeEnd + "pm";
		}

		$(eventDetails).append(event.name + "<br>");
		$(eventDetails).append(event.date + "<br>");
		$(eventDetails).append(event.address + "<br>");
		$(eventDetails).append(event.city + ", " + event.state + "<br>");
		$(eventDetails).append(event.room + "<br>");
		//$(eventDetails).append(event.event_start + " - " + event.event_end + "<br>");
		$(eventDetails).append(timeStart + " - " + timeEnd + "<br>");

		var slider = new Slider('small', sliderHolder, sliderId, userAttend, event.eventId, userId, callback);
	}
}