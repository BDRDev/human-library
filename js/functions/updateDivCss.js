<script type='module'>
export function updateDivCss(divId, divClass, classToAdd, action){

	divId = "#" + divId;
	classToAdd = classToAdd;

	//console.log('updateDivCss');
	
	switch(action){

			case('add'):
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
		
		break;
	 	//ends add
	case('remove'): 

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

		break;

	case('switch'): 

		//console.log('switch classes');

		//here there is no reason to check to see if there is a class being
		//targeted. We already know that there is

		//classToAdd = classToAdd;
		let testClass = divClass;
		divClass = '.' + divClass;


		// console.log('divId: ' + divId)
		// console.log('classToAdd: ' + classToAdd);
		// console.log('divClass: ' + divClass);

		$(divId).find(divClass).addClass(classToAdd);

		$(divId).find(divClass).removeClass(testClass);

	break;
		

	} //ends switch
} //ends function
</script>