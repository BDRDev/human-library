

//Functions Imported
import { checkAvail } from './functions/availCheck';
import { updateBookDisplay } from './functions/updateBookDisplay';
import { updateDivContent } from './functions/updateDivContent';
import { updateDivCss } from './functions/updateDivCss';

import { process_function_url } from './global_vars';


let booksArray = [];

//grabs each div with the class 'books' and adds them to an array
//adds the id to the array, id is the book id
function addDivsToArray(){
    $("div.books").each(function(){

        let value = $(this).attr('id');

        booksArray.push(value);

    })

} //ends addDivsToArray

//gets all of the information of the book based off the bookId
function process(displayId) {

    //we want this to not be asyn because we want it done in a certain order
    $.ajax({
    type: 'GET',
    url: process_function_url,
    data: { displayId : displayId },
    dataType: "json",
    asyn: false,
    success: function(result){
        
        //result is a book object of the id we passed
        //console.log("result", result);


        let returnedObject = checkAvail(result);

        //console.log("returnedObject", returnedObject);

        //This just updates the div with the time in the db
        //probably wont get used very often but it just updates, might do this for every piece of content
        updateDivContent(displayId, "bookTime", result.time);

        if(returnedObject.available){

                //this handles if the book is available
                //we need to do a check to see if the resultJSON.available is == 'not here'
                //if thats true we need to set it to 'yes' and take away the class associated with the book not being there

                console.log("book is here");

                //console.log("------------------------------------------------")

                console.log(result);

                if(result.available === 'away'){

                    //set it in the db to here
                    console.log("this is where the request goes");

                    let displayId = result.displayId;
                    let colChange = 'available';
                    let value = 'yes';
                    let update_case = 'away';


                    updateBookDisplay(displayId, colChange, value, update_case);

                }    
            }

            //this shows that the book is not available based on their time
            if(!returnedObject.available){

                //this handles if the book is un available
                //we need to check to see if the resultJSON !== 'away'
                //if thats true we need to set it to 'not here' then add the class 
                //that is associated with not here


                //this needs to be 'away' but we need to set up the index.php page to handle 'away' first
                if(result.available !== 'not here'){

                    //set db to 'away'
                    //this function is for updating any single value in the bookDisplay table
                    //pass the displayId, the column you want to change, and the new value

                    let displayId = result.displayId;
                    let colChange = 'available';
                    let value = 'away';
                    let update_case = 'away';

                    //we pass parameters, success function handles the response
                    //use the updateDivContent, and updateDivCss function in the call
                    //did this just to clean up the code

                    //see js/functions/updateBookDisplay.js
                    updateBookDisplay(displayId, colChange, value, update_case);

                }
                
            }
        },
        error: function(error){
            console.log("ERROR");
            console.log(error);
        }
    });
}//ends process Function


function updateIndex(){
    //grabs all the books from the page and puts them in an array
    addDivsToArray();

    //console.log("booksArray", booksArray);

    //loops through the books array and passes each bookId
    //to the process function

    let books = 1;
    //let books = booksArray.length;

    for(var i = 0; i < books; i++) {
        //console.log(booksArray[i]);
        var bookId = booksArray[i];
        process(bookId);
    }

    //this is the end of the function, this line needs to be last
    //clears the books Array
    booksArray = [];
}



$(document).ready(function(){
    //This is so these functions only run on the home page, this is set on the index.php page
    if(page == 'home'){

        console.log(page);

        //runs initial updateFunction
        updateIndex();

        //updates the index page every 5 seconds
        setInterval(function(){
            //updateIndex();
        }, 5000)
    }
});