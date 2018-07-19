//function used for setting the timeBack for the books

export function setTimeBack(){
	console.log("setTimeBack");

	let now  = new Date (Date.now());
    let formattedTime = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();

    let hour = now.getHours();
    let timeDenotation = '';
    let minutes = now.getMinutes();
    let timeBack = '';

    //this is how long the books have
    let bookTime = 10;

    //calc the minutes first, only because if we go above 60 we add an
    //hour to the hour var then do the am/pm calc

    minutes += bookTime

    if(minutes >= 60){
    	minutes = (minutes % 60);

    	if(minutes < 10){
    		minutes = '0' + minutes;
    	}

    	hour += 1;
    }

    if(hour > 12){

    	timeDenotation = 'PM'

    	hour = (hour % 12);
    } else {

    	timeDenotation = 'AM';
    }


    timeBack = hour + ":" + minutes + " " + timeDenotation;

    return(timeBack);

}
