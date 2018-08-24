
//This imports the create_slider function .. here is where I need to insert how to use it
import { create_slider } from './functions/create_slider.js';

//eventually this will need to be a function but for now I will import all of it.
import * as SliderMechanics from './slider.js';


//for now I am just going to have it showing but eventually it will be conditional if it shows up or not
//based on the event table

//This is actually going to be easier then I thought


if(page == 'profile'){


	console.log("is it the profile page");

	create_slider('small', '.profile_holder');

	//This section is for the slider mechanic
}