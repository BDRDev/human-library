
//handles logging in the user

import { prefix } from './global_vars';
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
			window.location.href = `${prefix}/admin/index.php`;
		} else {
			window.location.href = `${prefix}/profile/index.php`;
		}
	}
}