

export function getReturnTime(time){

	let now  = new Date();
    let formattedTime;

    let hours = now.getHours();
    let minutes = now.getMinutes() + time;
    let newMin;

    //console.log("minutes", minutes);

    if(minutes > 60){

    	let extraMin = minutes % 60;
    	let extraHour = Math.floor(minutes / 60);

    	console.log("extraHour", extraHour);
    	console.log("extraMin", extraMin);

    	hours += extraHour;
    	newMin = extraMin;

    	formattedTime = hours + ":" + newMin;

    } else {

    	formattedTime = hours + ":" + minutes;
    }

    //console.log("minutes", minutes);

    

    return formattedTime;
}