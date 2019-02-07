
import { getPendingLibrarians, approveUser, sendEmail, getUserData } from '../functions/dataCalls';

import { pendingLibrarianSection } from '../admin';

export const pendingLibrarians = async () => {

	//first thing we need to do is get the pending librarians
	const librarians = await getPendingLibrarians();

	//console.log(librarians);

	//now that we have the librarians we need to make sure we have atleast 1

	if(librarians.length > 0){

		//next we need to print the headers
		$(pendingLibrarianSection).append("<div><span>Name</span> <span>Why Librarian</span></div>");

		//next we will loop through the books and print their information
		librarians.forEach(({ userId, firstName, lastName, why_book }) => {
			$(pendingLibrarianSection).append(
				`<div id='pendingLibrarian${userId}'>${firstName} ${lastName} ${why_book}
					<button id=${userId} class='pendingLibrarian'>Approve</button>
				</div>`
			);
		});

		//when all of the books are printed we need to give the buttons their function
		$('.pendingLibrarian').bind('click', async event => {

			//object destructuring, just taking id off event.target.id
			const { id } = event.target;
			//switch user from pending -> approved

			const approved = approveUser(id);

			//if we get true from the ajax call we will remove the book from the screen
			if(approved){
				$(`#pendingLibrarian${id}`).remove();

				let result = await getUserData(id);

				//sendEmail('librarianAccountApproved', result.email);
			}
		})
	}

}