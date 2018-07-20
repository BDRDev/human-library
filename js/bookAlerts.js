//Functions imported
import { updateBookDisplay } from './functions/updateBookDisplay';
import { updateDivContent } from './functions/updateDivContent';
import { updateDivCss } from './functions/updateDivCss';
import { setTimeBack } from './functions/setTimeBack';

//Variables Imported
//import { } from './global_vars';


//this function creates an HmlHttpRequest Object.
function createXmlHttpRequestObject()
{
    // add your code here to create a XMLHttpRequest object compatible to most browsers
    if(window.ActiveXObject) { //for ie 6 or older
        return new ActiveXObject("Microsoft.XMLHTTP");
    } else if(window.XMLHttpRequest) { //for ie7+ and other browsers
        return new XMLHttpRequest();
    } else {
        return false; //failed to create the object
    }

}

var booksArray = [];
var rentedOut = [];



function addRowsToArray(){
    //loops through all of the bookWrapper divs
    $("tr.tableRow").each(function(){

        //gets the divs id
        var value = $(this).attr('id');

        //stores the id in an array
        booksArray.push(value);

    })

} //ends addDivsToArray

function process(displayId) {
    //creates a new XmlHttpRequest Object.
    var xmlHttp = new createXmlHttpRequestObject();

    console.log("this is an ajax request");

    //gets all of the information about the user based off of the div id
    xmlHttp.open("GET", "../indexUpdate/bookUpdate.php?displayId=" + displayId, true);

    xmlHttp.onreadystatechange = function() {
        //console.log(xmlHttp.readyState);

        if(xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            //console.log(xmlHttp.responseText);

            var resultJSON = JSON.parse(xmlHttp.responseText);

            //checks if the user is rented out
            //if the user is rented out they will have a timeBack
            //if they dont have a time back nothing happens
            //if they do, runs the checkAlert function
            if(resultJSON.timeBack === null) {
                console.log("the timeBack is null");
            } else {
                //if there is a timeback run check time function
                console.log(resultJSON);
                checkTime(resultJSON, displayId);
            }

        }



    };

    xmlHttp.send(null);

   
}

//checkTime gets the amount of time that the book has left
function checkTime(result, bookId) {
    var timeBack = result.timeBack;
    console.log("timeBack: " + timeBack);

    var date = new Date(Date.now());
    //console.log("date.getHours: " + date.getHours());

    var hours = date.getHours();
    var minutes = date.getMinutes();

    hours = hours % 12;
    hours = hours ? hours : 12; //hour '0' should be '12'

    var strTime = hours + ":" + minutes;

    //console.log("Current Time: " + strTime);

    var backArray = timeBack.split(":");
    //console.log(backArray);

    var backHour = parseInt(backArray[0]);
    var backMin = parseInt(backArray[1]);

    var timeBackMin = (backHour * 60) + backMin;
    //console.log("Time Back in Minutes: " + timeBackMin);

    var currentArray = strTime.split(":");

    var currentHour = parseInt(currentArray[0]);
    var currentMin = parseInt(currentArray[1]);

    var currentTimeMin = (currentHour * 60) + currentMin;
    //console.log("Current Time In Minutes: " + currentTimeMin);

    var difference = timeBackMin - currentTimeMin;
    //here is where were having issues
    console.log("They will be back in " + difference + " minutes");

    updateRented(result, bookId, difference)
}

//updateRented adds the divs that are checked out to an array and
//puts them in order based off of the number of min
//until they need to be returned
function updateRented(result, bookId, difference){
    //check to see if any divs are in the array
    if(rentedOut.length === 0) {
        //if the array is empty go ahead and add the div to the array

        //stores the books id and time difference in a book object
        //we do this so we can control how the rented books are displayed
        //this is to be sure they are displayed in order by time
        bookId = {id: bookId, difference: difference, story: result.title};

        //rented out is an array of objects that stores the books
        rentedOut.push(bookId);

    } else {

        //loop through the array and check if the id is already in the array
        //if it is, do nothing, if it isn't add to the array

        //variable for adding
        var addTo = true;


        //checks to see if the id we are trying to add is already in the array
        for(var x = 0; x < rentedOut.length; x++){
            if(rentedOut[x].id === bookId){
                //if we find that two id's match we will update the array
                //then we will update the output

                //the reason bookId is not bookId.id is because here bookId is not an object yet
                addTo = false;

                if(rentedOut[x].difference <= 0) {
                    difference = "Times Up!";
                } else {
                    rentedOut[x].difference = difference;
                }

                var currentDiv  = "#rented_" + bookId;

                $(currentDiv + " > div.rentedTime").html(difference);

            }
        } //ends for loop


        var array1;
        var array2;

        var added = false;

        //rentedOut is the array we are adding too

       //console.log(rentedOut);

        //sorts the array in order by the time remaining
        if(addTo === true){

            bookId = {id: bookId, difference: difference, story: result.title};

            for(var x = 0; x < rentedOut.length; x++){

                //checks if the number we are trying to add is less then the first number in the array
                //if this is true it means that the number is going to smaller then the rest if the array
                //so we put it first
                console.log("Loop " + x);
                console.log(rentedOut);

                if(rentedOut[0] >= bookId.difference && added === false) {

                    console.log(bookId.difference + " Needs to go to the beginning");
                    array1 = [];
                    array2 = rentedOut;

                    console.log("array1");
                    console.log(array1);

                    console.log("array2");
                    console.log(array2);

                    array1.push(bookId);

                    rentedOut = array1.concat(array2);

                    console.log("New Array");
                    console.log(rentedOut);

                    added = true;

                } //END IF STATEMENT

                else if(rentedOut[x] > bookId.difference && added === false){
                    array1 = rentedOut.slice(0, x);
                    array2 = rentedOut.slice(x, rentedOut.length);

                    array1.push(bookId);

                    rentedOut = array1.concat(array2);

                    added = true;
                } //ENDS ELSE IF

                else if(x === (rentedOut.length - 1) && added === false){
                    rentedOut.push(bookId);

                    added = true;
                }


            }// ENDS FOR LOOP


        }
    } //ends else statement

    //we will see
    console.log("print");
    printAlert(rentedOut);
    init();
    initBtn();

}//end updateRented

function printAlert(rentedOut){
    //now rented out is in order by time
    //console.log("books Rented out");
    console.log(rentedOut);

    //then we print the arrays to the page
    for(var x = 0; x < rentedOut.length; x++) {

        //console.log(rentedOut[x].id);
        //console.log(rentedOut[x].story);

        var checkDiv = "#rented_" + rentedOut[x].id;

        if(!$(checkDiv).length) {
            //console.log("it does not exist");

            if(rentedOut[x].difference > 5) {


                $(".rentedBooks > div.rentedGreen").append(
                    "<div class='rentedBook green' id='rented_" + rentedOut[x].id + "'>" +
                    "<div class='rentedStory'>" + rentedOut[x].story + "</div>" +
                    "<div class='rentedTime'>" + rentedOut[x].difference + "</div>" +

                    "<div class='rentedReturn'>RETURN</div>" +
                    "</div>"
                );
            } else if (rentedOut[x].difference <=5 && rentedOut[x].difference > 0) {
                $(".rentedBooks > div.rentedYellow").append(
                    "<div class='rentedBook yellow' id='rented_" + rentedOut[x].id + "'>" +
                    "<div class='rentedStory'>" + rentedOut[x].story + "</div>" +
                    "<div class='rentedTime'>" + rentedOut[x].difference + "</div>" +

                    "<div class='rentedReturn'>RETURN</div>" +

                    "</div>"
                );
            } else if(rentedOut[x].difference <= 0){
                $(".rentedBooks > div.rentedRed").append(
                    "<div class='rentedBook red' id='rented_" + rentedOut[x].id + "'>" +
                    "<div class='rentedStory'>" + rentedOut[x].story + "</div>" +
                    "<div class='rentedTime'>" + rentedOut[x].difference + "</div>" +

                    "<div class='rentedReturn'>RETURN</div>" +
                    "</div>"
                );
            }
        } else if($(checkDiv).length) {
            //the div is on the page

            //console.log("it exists");

            $(checkDiv).remove();

            if(rentedOut[x].difference > 5) {
                $(".rentedBooks > div.rentedGreen").append(
                    "<div class='rentedBook green' id='rented_" + rentedOut[x].id + "'>" +
                    "<div class='rentedStory'>" + rentedOut[x].story + "</div>" +
                    "<div class='rentedTime'>" + rentedOut[x].difference + "</div>" +

                    "<div class='rentedReturn'>RETURN</div>" +
                    "</div>"
                );
            } else if (rentedOut[x].difference <=5 && rentedOut[x].difference > 0) {
                $(".rentedBooks > div.rentedYellow").append(
                    "<div class='rentedBook yellow' id='rented_" + rentedOut[x].id + "'>" +
                    "<div class='rentedStory'>" + rentedOut[x].story + "</div>" +
                    "<div class='rentedTime'>" + rentedOut[x].difference + "</div>" +

                    "<div class='rentedReturn'>RETURN</div>" +
                    "</div>"
                );
            } else if(rentedOut[x].difference <= 0){
                $(".rentedBooks > div.rentedRed").append(
                    "<div class='rentedBook red' id='rented_" + rentedOut[x].id + "'>" +
                    "<div class='rentedStory'>" + rentedOut[x].story + "</div>" +
                    "<div class='rentedTime'>" + "Times up!" + "</div>" +

                    "<div class='rentedReturn'>RETURN</div>" +
                    "</div>"
                );
            }
        } //ends

    } //ends for loop
}


//Once I get the to files merge this will need some work
function initBtn(){
    console.log("btn init");

    //need to pass id
    $(".rentedReturn").unbind().bind("click", function(){

        var str = ($(this).parent().prop("id"));

        var divId = str.split("_");

        divId = divId[1];

        //console.log(divId);

        returnBook(divId);

        removeAlert(divId);
    });
}

function removeAlert(divId){
    console.log("this is where we remove div " + divId);

    //remove from the rentedOut array first
    divId = parseInt(divId);

    //console.log(rentedOut);

    for(var x = 0; x < rentedOut.length; x++) {
        //console.log("forloop");

        var arrayId = parseInt(rentedOut[x].id);

        if(arrayId === divId){

            console.log("found it");

            rentedOut.splice(x, 1);
        }
    }

    //div is removed from the array that displays the alerts
    //now time to remove from the page

    var removeId = "#rented_" + divId;

    $(removeId).remove();
}


//The rentBook function gets the current time and sets that
//time in the database for the book to be returned


function rentBook(displayId){
    //we pass parameters, success function handles the response
    //use the updateDivContent, and updateDivCss function in the call
    //did this just to clean up the code

    

    //here is where were going to call the setTimeBack function
    let timeBack = setTimeBack();

    //need to have another update here because were updating the timeBack
     updateBookDisplay(displayId, 'timeBack', timeBack, 'timeBack');

    //see js/functions/updateBookDisplay.js
    //parameters: displayId, colChange, value, update_case
    updateBookDisplay(displayId, 'available', 'no', 'rent');


    

    


} //End rentBook()

//the returnBook function sets the timeBack to NULL in the database
function returnBook(displayId){

    //we pass parameters, success function handles the response
    //use the updateDivContent, and updateDivCss function in the call
    //did this just to clean up the code

    //see js/functions/updateBookDisplay.js
    //parameters: displayId, colChange, value, update_case
    updateBookDisplay(displayId, 'available', 'yes', 'return');

    updateBookDisplay(displayId, 'timeBack', 'NULL', 'timeBack');
} //End returnBook()

//the display function displays the time that book is going ot be back
//it also changes the button from rent to return
function display(bookId, JSON){

    console.log("display Function");
    console.log("this is the bookId");
    console.log(bookId);
    var id = "#" + bookId;

    //$(id).children("div.employee-bookInformation").children("div.indexAva").html("<strong>Available</strong>: " + JSON.available);

    //if timeBack does not equal null, that means that it is rented out
    //so we need to change timeBack from empty to the time the book is back
    if(JSON.timeBack !== null) {
        //grabs the timeBack column of the row with the clicked on id
        //changes is to the time its supposed to be returned
        $(id).children("td.bookTimeBack").html(JSON.timeBack);

        //$(id).children("div.employee-bookInformation").children("div.employee-TimeBack").html("Time Back: " + JSON.timeBack);
    } else {
        $(id).children("td.bookTimeBack").html(JSON.timeBack).html(" ");

    }


    //if available does not equal yes that means its rented out and we need to change rent to return.
    if(JSON.available !== "yes") {

        var clickedDiv = $(id).children("td.rentTableRent");

        clickedDiv.html("RETURN");

        if(clickedDiv.hasClass("rentTableRent")){
            console.log("has it boi");

            clickedDiv.removeClass("rentTableRent");

            clickedDiv.addClass("rentTableReturn");

        }

    } else {

        var clickedDiv = $(id).children("td.rentTableReturn");

        clickedDiv.html("RENT");

        if(clickedDiv.hasClass("rentTableReturn")){
            console.log("has it boi");

            clickedDiv.removeClass("rentTableReturn");

            clickedDiv.addClass("rentTableRent");

        }
    }

    init();
}  

//.unbind.bind is very crucial
export function init(){
    //console.log('other init');

    //console.log("this is the init");

    $(".rentTableRent").unbind().bind("click", function(){
        rentBook(this.id);
        bookAlerts()
    });


    //allows the return button to do two functions hopefully
    $(".rentTableReturn").unbind().bind('click', function(){
        console.log("pls work idk");
        returnBook(this.id);
        removeAlert(this.id);
    });


};

//this is the main function that does all the work
function bookAlerts() {

    console.log(rentedOut);

    //console.log("booksArray");
    //console.log(booksArray);

    //this function adds an event listener to each div on the page
    init();


    //grabs all of the divs on the page and puts them into an array
    addRowsToArray();

    //console.log(booksArray);
    //loops through the array and passes the id to the process function
    for(var i = 0; i < booksArray.length; i++) {

        var displayId = booksArray[i];
        process(displayId);

        if(i === booksArray.length - 1) {
            //console.log("first for loop is done");
        }
    }

    booksArray = [];

}


$(document).ready(function(){

    //calls bookAlerts when the page is loaded
    bookAlerts();




    // $(".employee-Rent").bind("click", function(){
    //     console.log("this calls bookAlerts");
    //     bookAlerts();
    // });


    //runs bookAlerts every 5 sec
    setInterval(function(){
        //bookAlerts();
    }, 5000)

});