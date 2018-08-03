import { getBookData } from './functions/getBookData';

export function printBooksForEdit(books){

	console.log('printBooksForEdit');
	console.log(books);

	const result = _.map(books, function(result, key){

		console.log(result['title']);

		$('.edit_book_wrapper').append("<div>Title: " + result['title'] + " </div>")

	})
}


if(page == 'rent'){
	const _ = require('lodash');
	console.log('edit_book');

	

	getBookData('all');
}


