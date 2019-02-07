
//This is used for building complex forms 
import { base } from '../global_vars';

import { getEventTimes, getEventTimeSelection, checkSequential } from './buildFormFunctions';

const displayMessage = (message) => {
	$(".profileMessage").html(message);

	setTimeout(() => {
		clearMessage();
	}, 4000);
}

const clearMessage = () => {
	$(".profileMessage").html("");
}

export function printUnverifiedForm(userData, callback){

	let form;

	if(userData.role === 'book'){
		form =
			"<form class='unverifiedForm'>" + 
				"<div class='unverifiedTop'>" +
					"<div class='unverifiedSection'>" + 
						"<label for='unverifiedWhy' class='formLabel'>Tell us why you you'd be a good book</label>" + 
						"<textarea id='unverifiedWhy' name='unverifiedWhy' ></textarea>" + 
					"</div>" +

					"<div class='unverifiedSection'>" +
						"<label for='unverifiedOverview' class='formLabel'>Tell us about the adversity/discrimination you've faced</label>" + 
						"<textarea id='unverifiedOverview' name='unverifiedOverview' ></textarea>" +
					"</div>" +
				"</div>" +
				

				"<input  class='button submit' type='submit' value='Submit'>" +
			"</form>";
	}

	if(userData.role === 'librarian'){
		form =
			"<form class='unverifiedForm'>" + 
				"<div class='unverifiedTop'>" +
					"<div class='unverifiedSection'>" + 
						"<label for='unverifiedWhy' class='formLabel'>Tell us why you you'd be a good Librarian</label>" + 
						"<textarea id='unverifiedWhy' name='unverifiedWhy' ></textarea>" + 
					"</div>" +
				"</div>" +

				"<div class='unverifiedSection'>" +
					"<label for='unverifiedOverview' class='formLabel hide'>Tell us about the adversity/discrimination you've faced</label>" + 
					"<textarea id='unverifiedOverview' class='hide' name='unverifiedOverview' value='librarian' ></textarea>" +
				"</div>" +
				

				"<input  class='button submit' type='submit' value='Submit'>" +
			"</form>";
	}

	
	$("#unverifiedWrapper").html(form);

	$('.unverifiedForm').on('submit', function(e) {

		let formData = {
			why_book: $("#unverifiedWhy").val(),
			book_overview: $("#unverifiedOverview").val()
		}

		callback(formData);

		e.preventDefault();
	});
	
}

export const printVerifiedLibrarianForm = (librarianData, eventData, attending, callback) => {
	

	if(attending === true){	
		let form = 
		"<form class='profile_user_info_form generalForm'>";

		form += getEventTimeSelection(eventData.event_start, eventData.event_end, 1, librarianData.start_time, librarianData.end_time);

		form += 
		"<input type='submit' value='submit' />" + 
		"</form>";


		$("#verifiedWrapper").html(form);

		$('.profile_user_info_form').on('submit', function(e) {
			
			//times will be the id of the time slots
			let timeIds = [];
			let timeSlots = []
			$.each($("input[name='event_time']:checked"), function(){   

			 	let timeSlot = {
			 		start: $(this).data('start'),
			 		end: $(this).data('end')
			 	}
		        timeIds.push($(this).val());
		        timeSlots.push(timeSlot);

		    });

			if(attending){
				let sequential = checkSequential(timeIds);

				if(timeIds.length <= 2){
					displayMessage("Make sure you pick atleast two sequential time slots");
				} else if(!sequential){
					displayMessage("Make sure time slots are sequential");
				} else if(timeIds.length >= 2 && sequential){

					let timeStart = timeSlots[0].start;
		        	let timeEnd = timeSlots[timeIds.length - 1].end;

					let profileData = {
						start_time: timeStart,
						end_time: timeEnd
					}
					callback(profileData);
				}
			}

			e.preventDefault();
		})

	} else {
		$("#verifiedWrapper").empty();
	}
}

export function printVerifiedBookForm(bookData, eventData, attending, callback){
	//I need to explain everything that is going on at some point
	//here is where we will do all of the stuff 
		
	let form = 
		"<form class='profile_user_info_form generalForm'>" +

			"<label for='book_display_title' class=''>Title</label>" +
			"<input type='text' name='book_title' id='book_display_title' class=''" +  
			"value='" + bookData.title + "''/>" +
			
			"<label for='book_display_description' class=''>Short Description</label>" +
			"<input type='text' name='book_description' id='book_display_description' class=''" +  
			"value='" + bookData.description + "''>" +
			
			"<label for='book_display_ch_one' class=''>Chapter One Topic</label>" +
			"<input type='text' name='book_ch_one' id='book_display_ch_one' class=''" +  
			"value='" + bookData.chapter_one + "'/>" +
			
			"<label for='book_display_ch_two' class=''>Chapter Two Topic</label>" +
			"<input type='text' name='book_ch_two' id='book_display_ch_two' class=''" +  
			"value='" + bookData.chapter_two + "''/>" +
			
			"<label for='book_display_ch_three' class=''>Chapter Three Topic</label>" +
			"<input type='text' name='book_ch_three' id='book_display_ch_three' class=''" +  
			"value='" + bookData.chapter_three + "''/>";


			//need a way to check if the user is attending the event or not, maybe do this on the homepage?
			//for now we will assume they are attending
			
			if(attending === true){	
				//get time section displays the option for the book to select a time
				form += getEventTimeSelection(eventData.event_start, eventData.event_end, 1, bookData.start_time, bookData.end_time)

			}

					

				form += "<input class='button' type='submit' value='submit' />" + 

			"</form>";
	$("#verifiedWrapper").empty();
	$("#verifiedWrapper").html(form);

	$('.profile_user_info_form').on('submit', function(e) {

		//times will be the id of the time slots
		let timeIds = [];
		let timeSlots = []
		$.each($("input[name='event_time']:checked"), function(){   

		 	let timeSlot = {
		 		start: $(this).data('start'),
		 		end: $(this).data('end')
		 	}

	        timeIds.push($(this).val());
	        timeSlots.push(timeSlot);

	    });

		if(attending){
			let sequential = checkSequential(timeIds);

			if(timeIds.length < 2){
				displayMessage("Make sure you pick atleast two sequential time slots");
			} else if(!sequential){
				displayMessage("Make sure time slots are sequential");
			} else if(timeIds.length >= 2 && sequential){

				let timeStart = timeSlots[0].start;
	        	let timeEnd = timeSlots[timeIds.length - 1].end;

				let profileData = {
					title: $("#book_display_title").val(),
					description: $("#book_display_description").val(),
					chapter_one: $("#book_display_ch_one").val(),
					chapter_two: $("#book_display_ch_two").val(),
					chapter_three: $("#book_display_ch_three").val(),
					start_time: timeStart,
					end_time: timeEnd
				}
				callback(profileData);
			}
		}

		if(!attending){
			let profileData = {
				title: $("#book_display_title").val(),
				description: $("#book_display_description").val(),
				chapter_one: $("#book_display_ch_one").val(),
				chapter_two: $("#book_display_ch_two").val(),
				chapter_three: $("#book_display_ch_three").val(),
				start_time: "",
				end_time: ""
			}
			callback(profileData);
		} //ends not attending case

		e.preventDefault();
	})
} //end printVerifiedBook

const getDisplayTime = (displayTimes) => {

	console.log("getDisplayTime", displayTimes);

	if(displayTimes.start < 12){
		displayTimes.start = displayTimes.start + ' am';
	}
	console.log(displayTimes);
}

