
import { sendEmail, getUserData } from '../functions/dataCalls';

import { approveUser, declineUser, getPendingLibrarians } from '../functions/adminCalls';

import { pendingLibrarianSection } from '../admin';

export const pendingLibrarians = async () => {

	//first thing we need to do is get the pending librarians
	const librarians = await getPendingLibrarians();

	//console.log(librarians);

	//now that we have the librarians we need to make sure we have atleast 1

	if(librarians.length > 0){

		//next we need to print the headers
		$(pendingLibrarianSection).append(
			`<div class='pendingSubHeaders'>
				<div class="subHeader">Why Librarian</div> 
				<div class="choice"></div>
			</div>`);

		//next we will loop through the books and print their information
		librarians.forEach(({ userId, firstName, lastName, why_book }) => {
			$(pendingLibrarianSection).append(
				`<div class='pendingUser' id='pendingLibrarian${userId}'>
					<div class='name'>${firstName} ${lastName} </div>
					<div class='contentSection'>
						<div class='textSection'>${why_book}</div>
					
					<div class='pendingChoice'>
						<div id='${userId}' class='choice pendingLibrarian approve'>Approve</div>
						<div id='${userId}' class='choice pendingLibrarian decline'>Decline</div>
					</div>	
					</div>
				</div>`
			);
		});

		//when all of the books are printed we need to give the buttons their function
		$('.pendingLibrarian').bind('click', async event => {


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
				$(`#pendingLibrarian${id}`).remove();

				let result = await getUserData(id);

				//sendEmail('librarianAccountApproved', result.email);
			}
		})
	}

}