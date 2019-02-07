export function checkAvail(resultJSON) {

    //Current Time
    let now  = new Date (Date.now());
    let formattedTime = now.getHours() + ":";
    if(now.getMinutes() < 10){
        formattedTime += "0" + now.getMinutes();
    } else {
        formattedTime += now.getMinutes();
    }

    //console.log("Current Time: " + formattedTime);

    //the next thing we need to do is to get the time string into variables
    //I am thinking about having two arrays that will hold the start and end time
    //the second var is not necessary all the time


    //bookTime is the time that the book is available
    //I need to put this in a for loop if there are more than one time avail

    let bookTime = resultJSON.time;

    //console.log("Book Time: " + bookTime);

    //this is if the user only haves one time, Its safe to assume that its the time that they will arrive and they
    //are staying til the end, we need to have a way to get the end time, but for now just making sure it works
    if(!bookTime.includes("-")){
        bookTime = bookTime + "-7:00pm";
    }

    //time split is the var that will hold the two times from the bookTime
    let timeSplit = bookTime.split("-");


    //This is to handle if the users put spaces between the "-" in the time
    //not too sure if this messas anything up, but just to be sure

    if(timeSplit[0].includes(" ")) { timeSplit[0] = timeSplit[0].replace(/\s/g, ''); }
    if(timeSplit[1].includes(" ")) { timeSplit[1] = timeSplit[1].replace(/\s/g, ''); }
    

    //console.log("TimeSplit");
    //console.log(timeSplit);

    //this is where the for loop is going to start
    //we need to have a for loop just for the first two numbers

    let timeSlotOne = [];

    //console.log("timeSplit0: " + timeSplit[0]);
    //console.log("timeSplit1: " + timeSplit[1]);

    for(let y = 0; y < timeSplit.length; y++){
        timeSlotOne[y] = timeSplit[y];
    }

    //this for loop is to take the first time slot and set the two times to military time
    for(let x = 0; x < timeSplit.length; x++){
        //console.log(timeSlotOne[x]);
        //checks to see if the time is am, if so we handle it and turn it to military time
        if(timeSlotOne[x].includes("am")) {
            var holder = (timeSlotOne[x].split("am", 1));

            //console.log("Holder: " + holder[0]);

            //turns the 12:00 am to 0
            if(holder[0].includes('12')){
                let anotherSplit = holder[0].split(":");


                if(anotherSplit.length == 1) { anotherSplit[1] = '00' };
                
                anotherSplit[0] = 0;
                holder[0] = anotherSplit[0] + ":" + anotherSplit[1];
            } 

            //again this checks to see if the users added a ":00" if they didnt
            //we just add it to the end for them
            if(holder.length == 1){ holder[0] = holder[0] + ":00" }


            
        
        //checks to see if the time is pm, if so we handle it and turn it to military time
        } else if(timeSlotOne[x].includes("pm")){
            var holder = (timeSlotOne[x].split("pm", 1));

            //console.log("Holder: " + holder[0]);

            //Adds 12 to all numbers other than 12
            if(!holder[0].includes('12')){
                //console.log("not a 12");

                let anotherSplit = holder[0].split(":");

                anotherSplit[0] = parseInt(anotherSplit[0]) + 12;

                //This is a check to see if the users followed the correct naming convention and added the ':00'
                //at the end of the time, if they did not we go ahead and add it in there to avoid undefined errors
                if(anotherSplit.length == 1) { anotherSplit[1] = '00' };

                holder[0] = anotherSplit[0] + ":" + anotherSplit[1];
            } 
        }
        //console.log(holder)
        timeSlotOne[x] = holder[0];
    } //ends timeChange for loop

    //timeSlotOne is the time that the users gave, but in military time
    //console.log(timeSlotOne);
    //down here is where we are going to do the check to see if the book is available or not
    //could do the check above but I want to split it up a little, too clustered up there


    let bookAvail = 0;

    //console.log("formattedTime", formattedTime);
    //console.log(timeSlotOne[0]);

    if("20:00" > timeSlotOne[0]){
        //console.log("wtf")
    }

    // var str1 = "20:20:45",
    // str2 = "05:10:10";



    if(formattedTime >= timeSlotOne[0]){
        //console.log("one run");
        bookAvail += 1;
    }
    if(formattedTime <= timeSlotOne[1]){
        //console.log('two run');
        bookAvail += 1;
    } 

    //console.log("BookAvail: " + bookAvail);

    //down here we are going to get all of the information that we need from up top
    //and return it as an object to the indexUpdate function
    //that function will handle the object and change the database accordingly

    let availPass = false;
    if(bookAvail == 2) { availPass = true }

    var bookReturn = {

        available: availPass
    }

    //console.log(bookReturn);

    return bookReturn;
}
