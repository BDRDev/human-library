import { checkAvail } from './functions/availCheck';
import { updateDivContent } from './functions/updateDivContent';
import { updateDivCss } from './functions/updateDivCss';



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

            //This is where we check to see if a book is avail or not
            //check availCheck.js
            //returns an object
            let returnedObject = checkAvail(resultJSON);

            //console.log(returnedObject);


            //this shows that the book is available based on their time slot
            if(returnedObject.available){

                //this handles if the book is available
                //we need to do a check to see if the resultJSON.available is == 'not here'
                //if thats true we need to set it to 'yes' and take away the class associated with the book not being there

                console.log("book is here")

                

                if(resultJSON.available === 'away'){

                    //set it in the db to here
                    console.log("this is where the request goes");

                    let displayId = resultJSON.displayId;
                    let colChange = 'available';
                    let value = 'yes';

                    const siteUrl = "http://localhost:8383/humanLibrary/ajax/updateBookDisplay.php";
                    //updateBookDisplay(displayId, colChange, value)

                     $.ajax({
                        type: 'GET',
                        url: siteUrl,
                        data: { displayId : displayId, colChange : colChange, value : value },
                        success: function(result){

                            console.log("ajax was successful");

                            result = JSON.parse(result);

                            //now we have the available col changed in the db and we have
                            //the new data returned to us

                            let passAvail = '<strong>Available</strong>: ' + result.available;

                            //pass the div ID, class that needs to be changed, content that is
                            //being replaced
                            updateDivContent(displayId, 'bookAva', passAvail);

                            //next we want to have add a class that changes the background
                            //color of the main div
                            //Id of the div, class to add class to? , class to be added

                            //NOTE

                            //if we leave the divClass argument blank, it means that we are
                            //targeting the parent id
                            //The divClass is if we need to add a class to a child element
                            updateDivCss(displayId, ' ', 'bookAway');

                        },
                        error: function(){
                            console.log("youre an idiot");
                            
                        }

                    })//ends ajax



                    //take away the class associated with 'not here'
                }    
            }

            //this shows that the book is not available based on their time
            if(!returnedObject.available){

                //this handles if the book is un available
                //we need to check to see if the resultJSON !== 'away'
                //if thats true we need to set it to 'not here' then add the class 
                //that is associated with not here


                //this needs to be 'away' but we need to set up the index.php page to handle 'away' first
                if(resultJSON.available !== 'not here'){

                    //set db to 'away'
                    //this function is for updating any single value in the bookDisplay table
                    //pass the displayId, the column you want to change, and the new value

                    let displayId = resultJSON.displayId;
                    let colChange = 'available';
                    let value = 'away';

                    const siteUrl = "http://localhost:8383/humanLibrary/ajax/updateBookDisplay.php";
                    //updateBookDisplay(displayId, colChange, value)

                     $.ajax({
                        type: 'GET',
                        url: siteUrl,
                        data: { displayId : displayId, colChange : colChange, value : value },
                        success: function(result){

                            console.log("ajax was successful");

                            result = JSON.parse(result);

                            //now we have the available col changed in the db and we have
                            //the new data returned to us

                            let passAvail = '<strong>Available</strong>: ' + result.available;

                            //pass the div ID, class that needs to be changed, content that is
                            //being replaced
                            updateDivContent(displayId, 'bookAva', passAvail);

                            //next we want to have add a class that changes the background
                            //color of the main div
                            //Id of the div, class to add class to? , class to be added

                            //NOTE

                            //if we leave the divClass argument blank, it means that we are
                            //targeting the parent id
                            //The divClass is if we need to add a class to a child element
                            updateDivCss(displayId, ' ', 'bookAway');

                        },
                        error: function(){
                            console.log("youre an idiot");
                            
                        }

                    })//ends ajax


                    //we have the response in the updateBookDisplay function, I want to 
                    //get it back here

                    function testReturn(){
                        console.log("come on")
                    }

                    //add class associated with 'not here'

                }
                
            }

            display(resultJSON, displayId);
        }
    };

    xmlHttp.send(null);
}

function display(bookResults, bookId){
    //give the bookId a css ID
    //console.log("from display: " + bookId);
    
    //let id = "#" + bookId;

    
    //using the new function, pretty aparent but the bottom is the old code incase something breaks

    updateDivContent(bookId, 'storyTitle', bookResults.title);
    //$(id).find(".storyTitle").html(bookResults.title);

    let passHours = '<strong>Time</strong>: ' + bookResults.time;
    updateDivContent(bookId, 'bookHours', passHours);
    //$(id).find(".bookHours").html("<strong>Time</strong>: " + bookResults.time);

    //this is already being done above
    //$(id).find(".bookAva").html("<strong>Available</strong>: " + bookResults.available);



    if(bookResults.timeBack === null) {

        updateDivContent(bookId, 'time', ' ');
        //$(id).find(".time").html(" ");
    } else {

        let passTime = '<strong>Time Back</strong>: ' + bookResults.timeBack;
        updateDivContent(bookId, 'time', passTime);
        //$(id).find(".time").html("<strong>Time Back</strong>: " + bookResults.timeBack);
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
   //console.log("connected w jQuery");


   //for one test
   updateIndex();


   //updates the index page every 5 seconds

   setInterval(function(){
       //
       .

       updateIndex();
   }, 5000)

});