


//returns an array of time slot objects
export const getEventTimes = (start, end, interval) => {

	start = parseInt(start);
	end = parseInt(end);
	interval = parseInt(interval);

	let times = [];
	let loops = (end - start) / interval;

	let startTime = start;
	let endTime = end;
	let currentTime = start;

	//This only works for an interval of one;
	//need to make sure that I can get it to work for all of the others

	for(var x = 0; x < loops; x++){

		let time = {start: '', end: ''};
		time.start = currentTime;
		currentTime++;
		time.end = currentTime;
		times.push(time);

	}
	return times; 
}

export const getEventTimeSelection = (eventStart, eventEnd, interval, userStart, userEnd) => {

	let timeSection = 
		"<div class='timeSlot_rules'>Here is where you will select you time slot for the event. Make sure you select at least two consecutive time slots</div>" + 
		"<ul class='event_times'>";

	//gets us our time slots
	let times = getEventTimes(eventStart, eventEnd, 1);
	
	console.log("times", times);

	//This is our start times, if the user has a start time we need to pass it here
	let start = parseInt(userStart);
	let end = parseInt(userEnd);

	for(let x = 0; x < times.length; x++){

		//here is where we will change the display from military to regular time
		let timeStart = times[x].start;
		let timeEnd = times[x].end;

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

		

		if(times[x].start >= start && times[x].end <= end){
			console.log("A USER HAS A TIME SELECTED");
			timeSection += 
			`<li class='timeSlot'>` + 
				`<input checked type='checkbox' id='${x}' name='event_time' value='${x}' data-start=${times[x].start} data-end=${times[x].end} />` +
				`<label for='${x}'>${timeStart} - ${timeEnd}</label>` +
			`</li>`;
		} else {
			timeSection += 
				`<li class='timeSlot'>` + 
					`<input type='checkbox' id='${x}' name='event_time' value='${x}' data-start=${times[x].start} data-end=${times[x].end} />` +
 					`<label for='${x}'>${timeStart} - ${timeEnd}</label>` +
				`</li>`;
		}
		
	}

	timeSection += "</ul>";

	
	return timeSection;


}



//this is going to be the check to make sure that the time slots are sequential
export const checkSequential = (timeIds) => {
	let sequential = true;
	for(let x = 0; x < timeIds.length - 1; x++){
		
		let current = parseInt(timeIds[x]);
		let check = parseInt(timeIds[x + 1]);

		if((current + 1) === check){
		} else {
			sequential = false;
		}
	}
	console.log("sequential", sequential);

	return sequential;
}