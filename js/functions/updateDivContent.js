//Function does what it says

//Takes the id of the div we want to update
//The class inside of the id we want to change
//Third parameter is the content we are updating to

export function updateDivContent(divId, divClass, content){

	//console.log("update div content");

	divClass = "." + divClass;
	divId = "#" + divId;


	$(divId).find(divClass).html(content);
}


