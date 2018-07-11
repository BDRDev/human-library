export function updateDivCss(divId, divClass, classToAdd){

	divId = "#" + divId;
	classToAdd = classToAdd;

	if(divClass === ' '){

		//checks if the div has the class. If it doesnt, add it
		if(!$(divId).hasClass(classToAdd)) { $(divId).addClass(classToAdd) }
		

	} else if(divClass !== ' '){
		divClass = "." + divClass;


		if( !$(divId).find(divClass).hasClass(classToAdd)) {

			$(divId).find(divClass).addClass(classToAdd);
		}
	
	}
}