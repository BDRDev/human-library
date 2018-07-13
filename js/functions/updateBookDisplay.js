import { updateDivContent } from './updateDivContent';
import { updateDivCss } from './updateDivCss';

export function updateBookDisplay(displayId, colChange, value) {


	//one thing I think would be useful would be to have a file of constants that I import
	//into everyfile, that way for stuff like this I dont need to go into each individual file and
	//change them I can just change one and it will change them all

	const siteUrl = "http://localhost:8383/humanLibrary/ajax/updateBookDisplay.php";

	 $.ajax({
	 	type: 'GET',
	 	url: siteUrl,
	 	data: { displayId : displayId, colChange : colChange, value : value },

	 	//data: 'displayId=52&colChange=available&value=yes',
	 	//data: `displayId=${displayId}&colChange=${colChange}&value=${value}`,
        success: function(result){

            console.log("idk ajax was success?");

            result = JSON.parse(result);
            console.log(result);

            

            switch(colChange){

            	case 'available':

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
            }
           
        },
        error: function(){
            console.log("youre an idiot");

            
        }

    })//ends ajax
}