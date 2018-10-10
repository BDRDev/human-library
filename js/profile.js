//This page would be like if the user linked a profile.js file at the end of their page
	
import { get_events_list_url, get_specific_attend_list_url } from './global_vars.js';

//This imports the create_slider function .. here is where I need to insert how to use it
import { create_slider } from './functions/create_slider.js';

import { Slider } from './functions/create_slider.js';


//I think I will need to add another argument where we see if attending the event
//is true or false, then based on that if we need to pass positionTwo to the
//slider or not

//A lot of this is going to be based off of the events table, and the user event column


//for now I am just going to have it showing but eventually it will be conditional if it shows up or not
//based on the event table

//This is actually going to be easier then I thought

//explanation of the create_slider function

//argument 1: This is for the size of the slider you want small, medium, large, custom
//(If I ever think about deploying this to npm or something make a css file for custom)

//argument 2: This is the location where you want the slider

//argument 3: This is going to be the id given to the slider
//(This should come as pretty obvious but it needs to be unique)

//argument 4: This is going to be the position of the slider.
//Ither 'position_one' or 'position_two'

//argument 5: This will be the id of the event that we get from the table

//argument 6: This is going to be the usersId, this will come from the for loop
//or we can just pass the session variable, idk not too woried ab this rn

//NOT SURE ABOUT THE BOTTOM 

//(These next two will be added eventually, still need to think about how its going to work)
//argument 4: This is going to be the first function the slider calls
//(Moving from left to right, position 1 -> position 2)

//argument 5: This is going to be the second function the slider calls
//(Moving from right to left, position 2 -> position 1)

if(page == 'profile'){

	


	//I am thinking the way to do this is to make a for loop
	//since this is going to be conditional get the data from
	//the events table and however many results we get do that many
	//loops then on the last loop give the sliders their functionality

	//Still have a couple of kinks to work out but I think it is going to work
	//the best that way

	
	//this will be conditional once I get the events table up and running

	//basically there will be an event slider for each event that the date of the event is greater than the current date.
	//Need to have a way for the admin to "turn the slider off"
	//this is so like maybe they can only change if they are attending or not up until the event is three days away
	//potentially be a form field for creating an event //dont need to worry about now, I can ask this is the meeting



	//This is going to be for getting an array of events, this will tell the profile page how many sliders to add

	//I think I will need to generate my own array since I will be pulling data from two different tables
	//Will need to tailor this to the the events and such, ugh

	//The following block of code is going to get a list of events, this will let us know how many
	//sliders we need to put on the page.
	//Next we get a list of all of the events the user is attending, we will be able to tell this
	//by their id which we will get from the session var.

	//Then I will make an array that will list each event, and whether the user is attending or not.
	//This will tell us if the slider should be in position two or one.

	//Then we should be done with this.


	function bigTest(){
		console.log("BIG TEST");
	}

	console.log("currentUserId", currentUserId);

	//console.log(myTest);



	var events = $.ajax({
		url: get_events_list_url,
		dataType: 'json',
		async: false,
		success: function(result){
			console.log("Get Events List")
			//console.log(result);

			//console.log(test.responseJSON);
		}
	})


	//NEED TO DO THIS \/

	console.log("get_specific_attend_list_url")

	var attending = $.ajax({
		url: get_specific_attend_list_url,
		dataType: 'json',
		async: false,
		data: {
			userId: currentUserId
		},
		success: function(result){
			console.log("Get events user is attending")
			console.log(result);

		},
		fail: function(){
			console.log("get events failed");
		}
	})

	//two arrays, one for the events and an array of the events the current user is attending
	console.log("events", events.responseJSON);
	console.log("attending", attending.responseJSON);

	//need to mere this into one array that will give us all the parameters we need to conditionally load the sliders

	

	for(let event of events.responseJSON){
		console.log(event);

		let userAttend = 'false';
		let sliderId = 'slider_' + event.eventId;

		//tels if the user is attending said event
		attending.responseJSON.find(function(element){

			if(event.eventId === element.event_id){

				console.log("event id: ", event.eventId);
				console.log("from the attend table", element.event_id);

				userAttend = 'true';

			}
			

		})

		console.log("userAttend", userAttend);


		//here we will need to append a section that will give details each event

		//sliderSize, location, id, attending or not, event_id, user_id


		var slider = new Slider('small', '.profile_holder', sliderId, userAttend, event.eventId, currentUserId );
	}

	

	// var slider = new Slider('small', '.profile_holder', 'slider_one', 'false', '1', '33');
	// var slider = new Slider('small', '.profile_holder', 'slider_two', 'true', '2', '33');

	

	//This section is for the slider mechanic
}