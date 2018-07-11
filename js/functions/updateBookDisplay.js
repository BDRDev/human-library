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

            return(JSON.parse(result));

            //we could change the val here but I do not want to


        },
        error: function(){
            console.log("youre an idiot");

            
        }

    })//ends ajax
}