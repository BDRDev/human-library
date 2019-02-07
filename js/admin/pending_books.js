
import { getPendingBooks, approveUser, sendEmail, getUserData } from '../functions/dataCalls';

import { pendingBooksSection } from '../admin';

export const pendingBooks = async () => {

	//First thing we do is get all of the pending books
	const books =  await getPendingBooks();

	//next we want to check to be sure that we have at least one book.
	//if we dont have any we do not want to show this section, or at the very least we just show a message

	if(books.length > 0){

		//next we need to print the headers
		$(pendingBooksSection).append("<div><span>Name</span> <span>Why book</span> <span>Book Overview</span> </div>");

		//next we will loop through the books and print their information
		books.forEach(({ userId, firstName, lastName, why_book, book_overview }) => {
			$(pendingBooksSection).append(
				`<div id='pendingBook${userId}'>${firstName} ${lastName} ${why_book}  ${book_overview} 
					<button id=${userId} class='pendingBook'>Approve</button>
				</div>`
			);
		});

		//when all of the books are printed we need to give the buttons their function
		$('.pendingBook').bind('click', async event => {

			//object destructuring, just taking id off event.target.id
			const { id } = event.target;
			//switch user from pending -> approved

			const approved = approveUser(id);

			//if we get true from the ajax call we will remove the book from the screen
			if(approved){
				$(`#pendingBook${id}`).remove();

				let result = await getUserData(id);

				//sendEmail('bookAccountApproved', result.email);
			}
		})

	}

}