

import { massEmailSection } from '../admin';

export const massEmail = () => {


	buildEmailForm();
}

export const buildEmailForm = () => {

	const form = 
		`<form class='massEmailForm generalForm'>` + 
			`<li>` + 
			`<input checked type='radio' id='target_books' name='admin_email_target' value='book' />` +
				`<label for='target_books'>Books</label>` +
			`</li>` +

			`<li>` + 
			`<input type='radio' id='target_librarians' name='admin_email_target' value='librarian' />` +
				`<label for='target_librarians'>Librarians</label>` +
			`</li>` +

			"<label for='admin_email_subject' class=''>Subject</label>" +
			"<input name='email_subject' id='email_subject' class=''" +  
			"value='qwcqwc' required/>" +

			"<label for='book_display_title' class=''>Content</label>" +
			"<textarea name='email_content' id='email_content' class='' />" +

			"<input type='submit' value='submit' />" + 


		"</form>";

	$(massEmailSection).append(form);

    $('.massEmailForm').on('submit', function(e) {

		onFormSubmit();

		e.preventDefault();
	})
}

const onFormSubmit = () => {

	let formData = {}

	$('.massEmailForm').serializeArray().forEach(({ name, value }) => {
		formData[name] = value;
	});

	console.log(formData);

	//next we would pass the new data obj to ajax and to php
}