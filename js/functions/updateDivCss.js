export function updateDivCss(divId, divClass, classToAdd, action){

	divId = "#" + divId;
	classToAdd = classToAdd;

	console.log('updateDivCss');
	
	if(action === 'add'){
		console.log('add');

		if(divClass === ' '){

			//checks if the div has the class. If it doesnt, add it
			if(!$(divId).hasClass(classToAdd)) { $(divId).addClass(classToAdd) }
			

		} else if(divClass !== ' '){
			divClass = "." + divClass;


			if( !$(divId).find(divClass).hasClass(classToAdd)) {

				$(divId).find(divClass).addClass(classToAdd);
			}
		
		}
		
	} //ends add
	if(action === 'remove'){
		console.log('remove');

		if(divClass === ' '){

			//checks if the div has the class. If it does, remove it it
			if($(divId).hasClass(classToAdd)) { $(divId).removeClass(classToAdd) }
			

		} else if(divClass !== ' '){
			divClass = "." + divClass;


			if( !$(divId).find(divClass).hasClass(classToAdd)) {

				$(divId).find(divClass).removeClass(classToAdd);
			}
		
		}
		

	} //ends remove
} //ends function