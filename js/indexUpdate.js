import { checkAvail } from './functions/availCheck';



//JQuery Code for scrolling up and down

$("nav a").click(function(e) {
    let btnID = e.currentTarget.id + "Section";
    $("html, body").animate({
        scrollTop: $("#" + btnID).offset().top
    }, 700);

});


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

let booksArray = [];

//grabs each div with the class 'books' and adds them to an array
function addDivsToArray(){
    $("div.books").each(function(){
        //console.log($(this).attr('id'));

        let value = $(this).attr('id');

        booksArray.push(value);

    })

} //ends addDivsToArray

//gets all of the information of the book based off the bookId
function process(displayId) {
    //creates a new XmlHttpRequest Object.
    let xmlHttp = new createXmlHttpRequestObject();

    xmlHttp.open("GET", "indexUpdate/bookUpdate.php?displayId=" + displayId, true);

    xmlHttp.onreadystatechange = function() {
        //console.log(xmlHttp.readyState);

        if(xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            //console.log(xmlHttp.responseText);

            let resultJSON = JSON.parse(xmlHttp.responseText);

            //This should get all the data from the db and print it out
            //console.log(resultJSON);


            //what we need to do here is get the current time and if the current time is earlier or later than the
            //time provided for the book then we need to set available to null and set a css class to indicate that
            //it is unavailable


            //This is where we check to see if a book is avail or not
            //check availCheck.js
            //returns an object
            checkAvail(resultJSON);


            //here is where we will parse the object and change the book div and information
            //info needed to be returned: isAvail, class to be added, maybe book id,

            //now we have the current, and two time slots in military time

            display(resultJSON, displayId);
        }
    };

    xmlHttp.send(null);
}

function display(bookResults, bookId){
    //give the bookId a css ID
    //console.log("from display: " + bookId);
    let id = "#" + bookId;

    //console.log(id);

    //var currentDiv = $(id);

    //console.log($(id).children().children("div.bookAva"));
    //console.log("available: " + bookResults.available);

    //firstName, lastName, story, timeBack

    $(id).children().children("div.story").html(bookResults.story);

    $(id).children().children("div.name").html(bookResults.firstName + " " + bookResults.lastName);

    $(id).children().children("div.avaHolder").children("div.bookAva").html("<strong>Available</strong>: " + bookResults.available);


    //console.log($(id).children().children("div.avaHolder").children("div.bookAva").html());

    //console.log(bookResults.timeBack);

    if(bookResults.timeBack === null) {
        $(id).children().children("div.avaHolder").children("div.time").html(" ");
    } else {
        $(id).children().children("div.avaHolder").children("div.time").html("<strong>Time Back</strong>: " + bookResults.timeBack);
    }

    if(bookResults.timeBack === null){
        $(id).css({
        })
    }


}

function updateIndex(){
    //grabs all the books from the page and puts them in an array
    addDivsToArray();

    console.log(booksArray);

    //loops through the books array and passes each bookId
    //to the process function

    //when it works for sure, change i < 1 to < booksArray.length
    for(var i = 0; i < 1; i++) {
        //console.log(booksArray[i]);
        var bookId = booksArray[i];
        process(bookId);
    }


    //this is the end of the function, this line needs to be last
    //clears the books Array
    booksArray = [];
}


$(document).ready(function(){
   console.log("connected w jQuery");


   //for one test
   updateIndex();


   //updates the index page every 5 seconds

   setInterval(function(){
       //updateIndex();
   }, 5000)

});