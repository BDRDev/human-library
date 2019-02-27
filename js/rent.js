

import { getAllBooks } from './functions/dataCalls';
import { initButtons, getCheckedOutBooks } from './bookAlerts';

if(page === 'rent'){


	const getBooks = async () => {
		
		const books = await getAllBooks();

		console.log('books', books);

		displayBooks(books);
	}

	const configBook = (title, available, displayId) => {

		let book;

		let availClass;
		let rentClass;
		let rentContent;

		if(available === 'yes'){ 
			availClass = 'rowAvail'; 
			rentClass = `rentTableRent rent_${displayId}`;
			rentContent = 'RENT';  

		} else if(available === 'no'){ 
			availClass = 'rowNotAvail';
			rentClass= `rentTableReturn return_${displayId}`;
			rentContent = 'RETURN';

		} else if(available === 'away'){ 
			availClass = 'rowAway';
			rentClass = 'rentTableReturn';
			rentContent = '';

		}

		book += `<tr class='tableRow ${availClass}' id='book_${displayId}' >`;

		book += `<td class='bookTitle'>${title}</td>`;

		book += `<td class='bookAvailability'>${available}</td>`;

		book += `<td class="${rentClass}" id="${displayId}">${rentContent}</td>`;

		book += `</td>`;

		return book;
	}



	const displayBooks = books => {

		books.forEach(({ title, available, displayId }) => {
			
			const bookDisplay = configBook(title, available, displayId);

			if( $(`#book_${displayId}`).length ){

				$(`#book_${displayId}`).replaceWith(bookDisplay);
			} else {
				$('.rentTable').append(bookDisplay);
			}
			
		})

		initButtons();
	}

	$(document).ready(() => {

		console.log('it is the rent page');

		getBooks();

		setInterval(function(){
            getCheckedOutBooks();
            getBooks();
        }, 5000)

  		
	})

}