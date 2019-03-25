
import { sendEmail, getUserData } from '../functions/dataCalls';

import { approveUser, declineUser, getPendingBooks } from '../functions/adminCalls';

import { pendingBooksSection } from '../admin';

export const pendingBooks = async () => {

	//First thing we do is get all of the pending books
	const books =  await getPendingBooks();

	//next we want to check to be sure that we have at least one book.
	//if we dont have any we do not want to show this section, or at the very least we just show a message

	if(books.length > 0){

		//next we need to print the headers
		$(pendingBooksSection).append(
			`<div class='pendingSubHeaders'>
				<div class="subHeader">Why book</div> 
				<div class="subHeader">Book Overview</div>
				<div class="choice"></div>
			</div>`
		);

		//<button id=${userId} class='pendingBook'>Approve</button>


		//next we will loop through the books and print their information
		books.forEach(({ userId, firstName, lastName, why_book, book_overview }) => {
			$(pendingBooksSection).append(
				`<div class='pendingUser' id='pendingBook${userId}'>
					<div class='name'>${firstName} ${lastName} </div>
					<div class='contentSection'>
						<div class='textSection'>${why_book}</div>
						<div class='textSection'>${book_overview}</div> 

						<div class='pendingChoice'>
							<div id='${userId}' class='choice pendingBook approve'>Approve</div>
							<div id='${userId}' class='choice pendingBook decline'>Decline</div>
						</div>						
					</div>
				</div>`
			);
		});

		//when all of the books are printed we need to give the buttons their function
		$('.pendingBook').bind('click', async event => {

			//object destructuring, just taking id off event.target.id
			const { id } = event.target;
			
			let result;

			if($(event.target).hasClass('approve')){
				//run approveUser
				//switch user from pending -> approved
				result = await approveUser(id);
				
			} else {
				//run declineUser
				//switch user from pending -> declined
				result = await declineUser(id);
				
			}


			//if we get true from the ajax call we will remove the book from the screen

			if(result){
				$(`#pendingBook${id}`).remove();

				let result = await getUserData(id);

				console.log('approve or decline was successful')

				//sendEmail('bookAccountApproved', result.email);
			}
		})

	}

}