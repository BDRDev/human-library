//This function will take military time as a parameter and return the number of minutes

export function getMinutes(time){


	let num = time.split(":");
	let hours = parseInt(num[0]);
	let minutes = parseInt(num[1]);

	let total = (hours * 60) + minutes;
	return total;

}