
//handles logging in the user

import { base } from './global_vars';
import { attemptLogin, getUserSessions, setUserSessions } from './functions/dataCalls';

if(page === 'login'){

	$(document).ready(() => {

		$('.loginForm').on('submit', (event) => {

			onFormSubmit();
			event.preventDefault();

		});
	});

	const onFormSubmit = async () => {

		let formData = {};

		$('.loginForm').serializeArray().forEach(({ name, value }) => {
	        formData[name] = value;
	    });

		const user = await attemptLogin(formData);

		setUserSessions("userId", user.userId);
		setUserSessions("user_role", user.role);
		
		if(user.role === 'admin'){
			window.location.href = base + "admin/index.php";
		} else {
			window.location.href = base + "profile/index.php";
		}
	}
}