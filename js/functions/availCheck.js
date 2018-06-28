export function checkAvail(resultJSON) {[]

    //Current Time
    let now  = new Date (Date.now());
    let formattedTime = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();

    console.log("Current Time: " + formattedTime);

    //the next thing we need to do is to get the time string into variables
    //I am thinking about having two arrays that will hold the start and end time
    //the second var is not necessary all the time


    //bookTime is the time that the book is available
    //I need to put this in a for loop if there are more than one time avail

    let bookTime = resultJSON.time;

    console.log("Book Time: " + bookTime);

    //time split is the var that will hold the two times from the bookTime
    let timeSplit = bookTime.split("-");

    //this is where the for loop is going to start
    //we need to have a for loop just for the first two numbers

    let timeSlotOne = [];

    //console.log("timeSplit0: " + timeSplit[0]);
    //console.log("timeSplit1: " + timeSplit[1]);

    for(let y = 0; y < timeSplit.length; y++){
        timeSlotOne[y] = timeSplit[y];
    }

    //this for loop is to take the first time slot and set the two time to military time
    for(let x = 0; x < timeSplit.length; x++){

        //This should only ever loop through twice because each time slot should only have two times

        //right now we are going to check for the am time
        //if x === 0, then it is the first loop, so we are dealing with am

        //create an object to simplify the hour!!!!!!!!!


        if(x === 0){
            console.log("timeSlot " + x)
            console.log(timeSlotOne[x]);

            console.log(timeSlotOne[x]);

            timeSlotOne[x] = timeSlotOne[x].split("am", 1);

            console.log(timeSlotOne[x]);
            //at this point we have the AM time in a string format
            //Next I have to check if the first number is 12


            //the reason we are doing this is the off chance we have 12am I need to be sure its 0
            //because of military time, if it stays 12 its like its 12PM

            console

            if(timeSlotOne[x] < '12:00'){
                console.log("The first number is 12")
            }

            console.log("new timeOne: " + timeSlotOne[x]);


        }

        if(x === 1){
            //console.log(timeSlotOne[x]);
            timeSlotOne[x] = parseInt(timeSlotOne[x].split("pm", 1));

            if(timeSlotOne[x] !== 12){
                timeSlotOne[x] = timeSlotOne[x] + 12;
            }

            console.log("new timeTwo: " + timeSlotOne[x])


            //here is where we would do some math to turn the pm to military
        }


    }
}
