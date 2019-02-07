export function printAlert(book, minLeft){

	let divColor;



	if(minLeft === 0){
		console.log("its zero");
		divColor = "red";
	} else if(minLeft > 0 && minLeft < 10){
		divColor = "yellow";
	} else {
		divColor = "green";
	}



    $(".rentedBooks").append(
        "<div class='rentedBook " + divColor + "' id='rented_" + book.displayId + "'>" +
        "<div class='rentedStory'>" + book.title + "</div>" +
        "<div class='rentedTime'>" + minLeft + "</div>" +

        "<div id='" + book.displayId + "' class='rentedReturn'>RETURN</div>" +
        "</div>"
    );
}