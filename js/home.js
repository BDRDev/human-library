
//Js file that is going to control the home page

import { getAllBooks, getAvailableBooks } from './functions/dataCalls';


if(page === 'home'){

	//global vars for the home page

	var currentBooksShowing = "available";

	const printBooks = (books) => {

		console.log("print the books");

		$('.bookDisplay').empty();
		
		books.forEach((book) => {

			var classToAdd, available;
			classToAdd = available = '';

			if(book.timeBack !== null){
				available = 'unavailable';
			}

			if(book.available === 'away')
				classToAdd = 'bookAway';
			else if(book.available === 'no')
				classToAdd = 'bookRented';



			let bookCard = 

				`<div class='books ${classToAdd}' id='${book.displayId}'>` +
					`<div class='bookContent'>` + 
						`<span class='storyTitle'>${book.title}</span>` + 
						`<span class='bookHours'><strong>Time</strong>:<span class='bookTime'>${book.time}</span></span>` +
						`<div class='avaHolder' style='padding: 50px 0;'>` + 

							`<div class='bookAva'><strong>Available</strong>: ${book.available}</div>`;

							if(book.timeBack != null)
								bookCard += `<div class='bookAva time'><strong>Time Back</strong>: ${book.timeBack}</div>`;
								bookCard += `<div class='time'></div>`;
							

						bookCard += 
						`</div>` + 
					`</div>` + 

				`</div>`;

			$('.bookDisplay').append(bookCard);
		})
	}

	const bookDisplay = (id) => {

		//This is in effort to reduce the number of ajax calls
		//only runs if we click on the opposite button
		if(currentBooksShowing != id){

			if(id === "all")
				getAllBooks((allBooks) => {

					//once we have all the books we are going to print them to the dom
					console.log("allBooks", allBooks)
					printBooks(allBooks);

				});
			else if(id === 'available')
				getAvailableBooks((availableBooks) => {

					console.log("availableBooks", availableBooks);
					printBooks(availableBooks);
				});

			currentBooksShowing = id;

		}
	}

	


	$(document).ready(() => {
		console.log("home page is ready");

		//Right when the page loads we want all of the available books to be showing
		//we give the users the option to see all books

		

		getAvailableBooks((availableBooks) => {

			console.log("availableBooks", availableBooks);
			//printBooks(availableBooks);
		});

		//next we need to be sure that we are updating this
		//When the site is live we need to do this

		// setInterval(() => {
		// 	if(currentBooksShowing === "all")
		// 		getAllBooks((allBooks) => {

		// 			//once we have all the books we are going to print them to the dom
		// 			console.log("allBooks", allBooks);
		// 			printBooks(allBooks);

		// 		});
		// 	else if(currentBooksShowing === 'available');
		// 		getAvailableBooks((availableBooks) => {

		// 			console.log("availableBooks", availableBooks);
		// 			printBooks(availableBooks);
		// 		});
		// }, 5000);

		$(".displayBtns").click(() => {
			bookDisplay(event.target.id);
		});

	})

}