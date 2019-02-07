

//JS file that will control all functions that has to do with the nav bar

import { getUserSessions, destroyUserSession } from './functions/dataCalls';

import { base } from './global_vars';

if(forNav === 'showing'){

	

	$(document).ready(() => {
		console.log("The nav bar is ready");


		//If the user logs out, need to take them to the homepage
		$(".logoutBtn").click(() => {
			console.log("The logout button was clicked");

			getUserSessions("userId", (session) => {
				console.log("session", session);
			});


			//I think that we can make this one, "destroy all sessions" function will look into later
			destroyUserSession("userId");
			destroyUserSession("user_role");

			//now we route the user back to the home page
			window.location = base;
		})
	})
}