
//Functions Imported
import { updateDivContent } from 'http://humanlibrary.us/js/functions/updateDivContent.js';
import { updateDivCss } from 'http://humanlibrary.us/js/functions/updateDivCss.js';
import { init } from 'http://humanlibrary.us/js/bookAlerts.js';

//Variables Imported
import { update_book_display_function_url } from 'http://humanlibrary.us/js/global_vars.js';


export function updateBookDisplay(displayId, colChange, value, update_case) {


	//one thing I think would be useful would be to have a file of constants that I import
	//into everyfile, that way for stuff like this I dont need to go into each individual file and
	//change them I can just change one and it will change them all

	const siteUrl = "http://localhost/humanLibrary/ajax/updateBookDisplay.php";

	 $.ajax({
	 	type: 'GET',
	 	url: update_book_display_function_url,
	 	data: { displayId : displayId, colChange : colChange, value : value },

        success: function(result){

            //console.log("idk ajax was success?");

            result = JSON.parse(result);
            console.log(result);



            
            //Below is how we handle the data we get in return as well as update the DOM

            switch(update_case){

            	case 'away':

            		//now we have the available col changed in the db and we have
            		//the new data returned to us
	            	let passAvail = '<strong>Available</strong>: ' + result.available;

		            updateDivContent(displayId, 'bookAva', passAvail);
		            
		            //next we want to have add a class that changes the background
		            //color of the main div
		            //Id of the div, class to add class to? , class to be added

		            //NOTE

		            //if we leave the divClass argument blank, it means that we are
		            //targeting the parent id
		            //The divClass is if we need to add a class to a child element
		            let action = '';

		            if(result.available === 'away'){ action = 'add' };
		            if(result.available === 'yes'){ action = 'remove' };


		            updateDivCss(displayId, ' ', 'bookAway', action);
	            		
	 				break;

 				case 'rent': 


 					//console.log('RENT');

 					//We have the database changed from yes to no.
 					//Now we need to have the row say: Available - no, TimeBack, and RETURN

 					//This changes available from yes -> no
 					updateDivContent(displayId, 'bookAvailability', result.available);
 					//This changes TimeBack from " " -> "time"

 					
 					//This changes Rent -> Return
 					updateDivContent(displayId, 'rentTableRent', 'RETURN');


 					updateDivCss(displayId, 'rentTableRent', 'rentTableReturn', 'switch');




 					//need to change classes for the rent/return row
 					//when rent - rentTableRent
 					//when return - rentTableReturn
 					init();
 					break;

 				case 'return':

 					//console.log("RETURN"); 

 					//We have the database changed from yes to no.
 					//Now we need to have the row say: Available - no, TimeBack, and RETURN

 					//This changes available from no -> yes
 					updateDivContent(displayId, 'bookAvailability', result.available);
 					//This changes Return -> Rent
 					updateDivContent(displayId, 'rentTableReturn', 'RENT');

 					updateDivCss(displayId, 'rentTableReturn', 'rentTableRent', 'switch');

 					init();
 					break;


				case 'timeBack':

					//console.log('change the timeBack');

					//Need to simplify the time process?
 					updateDivContent(displayId, 'bookTimeBack', result.timeBack);


					break;
 					
            }
           
        },
        error: function(){
            console.log("youre an idiot");

            
        }

    })//ends ajax
}