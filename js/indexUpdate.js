
//Functions Imported
import { checkAvail } from './functions/availCheck';
import { updateBookDisplay } from './functions/updateBookDisplay';
import { updateDivContent } from './functions/updateDivContent';
import { updateDivCss } from './functions/updateDivCss';

import { process_function_url } from './global_vars';

console.log(process_function_url);


let booksArray = [];

//grabs each div with the class 'books' and adds them to an array
function addDivsToArray(){
    $("div.books").each(function(){

        let value = $(this).attr('id');

        booksArray.push(value);

    })

} //ends addDivsToArray

//gets all of the information of the book based off the bookId
function process(displayId) {

    $.ajax({
    type: 'GET',
    url: process_function_url,
    data: { displayId : displayId },
    dataType: "json",
    success: function(result){
        
        console.log(result);

        //result = JSON.parse(result);

        console.log(result);

        let returnedObject = checkAvail(result);

        console.log(returnedObject);

        if(returnedObject.available){

                //this handles if the book is available
                //we need to do a check to see if the resultJSON.available is == 'not here'
                //if thats true we need to set it to 'yes' and take away the class associated with the book not being there

                console.log("book is here")

                //console.log(result);

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

    console.log(booksArray);

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
    
    if(page == 'home'){

        console.log(page);

        console.log('Only runs on home')

        //runs initial updateFunction
        updateIndex();

        //updates the index page every 5 seconds
        setInterval(function(){
            //updateIndex();
        }, 5000)
    }
});