export function getStartTimes(start, end, interval){

	console.log("getStartTimes");

	//We need this to be in standard time
	
	let startTimes = [];


	start = timeInt(start);
	end = timeInt(end);
	console.log("start", start);
	console.log("end", end);

	let loops = 9;

	

	console.log("loops", loops);

	console.log(start[0]);

	//we do this so we arent actually changing the initial time
	let current = start;

	//before we loop we need to add the starting time as the first time
	console.log("current", current);

	if(current[0] < 12){
		//this means it is am
		console.log("it is less than 12");

		if(current[1] == 0){

			console.log("its zero");

			startTimes.push(current[0] + ":00" + "am");

		} else {

			startTimes.push(current[0] + ":" + current[1] + "am");
		}

	}


	//for(var x = 0; x < loops; x ++)

	while(current[0] != (end[0] - 2)){

		let hourAdd, minAdd, time;

		hourAdd = current[0];
		time = "am";

		//first thing we need to do is add the interval to the 1 index, 1 index is always the minutes
		current[1] += interval;

		minAdd = current[1];

		//next check if the minutes are equal to 60
		if(current[1] == 60){
			current[0] += 1

			hourAdd = current[0];

			current[1] = 0;

		} 

		if(current[1] == 0){

			console.log("it is zero");

			minAdd = "00";
		}

		if(current[0] == 12){
			time = "pm";
		}

		if(current[0] > 12){
			hourAdd = current[0] %  12;
			time="pm";
		}


		console.log("current 0", current[0], "current 1", current[1]);
		
		//here is where we need to check for am and pm

		
		startTimes.push(hourAdd + ":" + minAdd + time);
	}

	return startTimes;
}


//just turns the time string into an array of time ints
function timeInt(time){

	//first thing is split the time into an array
	time = time.split(":");

	console.log("time", time);
	//turn into numbers

	for(let x = 0; x < time.length; x++){

		time[x] = parseInt(time[x]);
	}

	return time

}