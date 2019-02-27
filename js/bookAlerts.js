//Second iteration of the Book Alerts

import _ from 'lodash';

//helper functions
import { parseTime } from './functions/parseTime';
import { getMinutes } from './functions/getMinutes';
import { printAlert } from './functions/printAlert';
import { getReturnTime } from './functions/getReturnTime';
import { updateDivCss } from './functions/updateDivCss';

//Variables Imported
import { get_checked_out_books_url, return_book_url, rent_book_url } from './global_vars';

//This is my new way of getting the data
//all we need is to get the books where timeBack != null, constantly update from there
//can be async, when we get data just replace it

//Going to fix is this weekend, doing it this way will be a lot easier. I will still have to use some of
//these functions I have but I think I'll be able to remove a lot of them.

//I'll at least be able to split them up


//This is how we get the checked out books, will run this every 10 seconds, also whenever someone clicks the rent button

//One thing I have to decide is if I want to run it when they get returned or if we just want to remove them from the array
//probably just remove from the array
export const getCheckedOutBooks = async () => {

    console.log('getCheckedOutBooks');

    const result = await $.ajax({
        type: 'GET',
        url: get_checked_out_books_url,
        dataType: 'json',
    });

    createAlertColumn(result);

}


//for the remove we change it in ajax, then call the starter function

function createAlertColumn(checkedOutBooks){

    console.log("createAlertColumn");
    console.log("checkedOutBooks", checkedOutBooks);

    //here is where we get the array and me put them in order
    let orderedBooks = _.sortBy(checkedOutBooks, 'timeBack');

    console.log("orderedBooks", orderedBooks);

    let now  = new Date();
    let formattedTime = now.getHours() + ":";
    if(now.getMinutes() < 10){
        formattedTime += "0" + now.getMinutes();
    } else {
        formattedTime += now.getMinutes();
    }

   

    //console.log("formattedTime", formattedTime);

    //console.log("currentTime", currentTime);

    $(".rentedBooks").html("");
    orderedBooks.forEach(function(book){
        
        // console.log("bookMin", getMinutes(book.timeBack));
        // console.log("currentMin", getMinutes(formattedTime));

        let minLeft = getMinutes(book.timeBack) - getMinutes(formattedTime);

        //console.log("minLeft", minLeft);

        printAlert(book, minLeft);
    })

    //runs when all the buttons are on the page
    initButtons();
}

function returnBook(bookId){

    $.ajax({
        url: return_book_url,
        data: {
            bookId: bookId
        },
        dataType: 'json',
        success: function(result){
           
           console.log("result", result);
           getCheckedOutBooks();
        }
    })
}

const rentBook = async bookId => {

    //takes the current time and adds that many minutes to it as you pass
    let returnTime = getReturnTime(11);

    console.log("returnTime", returnTime);

    const result = await $.ajax({
        url: rent_book_url,
        data: {
            bookId: bookId,
            timeBack: returnTime
        },
        dataType: 'json',
    });

    if(result === 'SUCCESS'){
        getCheckedOutBooks();
    }
    

}

//we are targeting the rent and changing it to return
function toReturn(bookId){

    console.log('toReturn function', bookId);

    let rentClass = "rent_" + bookId;
    let returnClass = "return_" + bookId;

    console.log('rentClass', rentClass);
    console.log('returnClass', returnClass);

    $("." + rentClass).addClass(returnClass);
    $("." + returnClass).removeClass(rentClass);

    $("." + returnClass).html("RETURN");
    $("." + returnClass).addClass("rentTableReturn");
    $("." + returnClass).removeClass("rentTableRent");

    const targetId = `#book_${bookId}`;

    $(targetId).removeClass("rowAvail");
    $(targetId).addClass("rowNotAvail");

    console.log("#book_" + bookId + " .bookAvailability");

    $("#book_" + bookId + " .bookAvailability").html("no");

    initButtons();

}

//targeting the return and changing it to rent
function toRent(bookId){

    console.log("toRent function");

    let rentClass = "rent_" + bookId;
    let returnClass = "return_" + bookId;

    //First thing we need to do is add the return_ + bookId class;

    //we need to get this via the rent_ + bookId class

    //since we are going from return_ to rent_ we need to add the rent class and remove the return class
    $("." + returnClass).addClass(rentClass);
    $("." + rentClass).removeClass(returnClass);

    //$(fullClass).removeClass(rentClass);

    //console.log("fullClass", fullClass);
    console.log($("." + rentClass));

    $("." + rentClass).html("RENT");
    $("." + rentClass).addClass("rentTableRent");
    $("." + rentClass).removeClass("rentTableReturn");


    //Changing the color of the css
    $("#book_" + bookId).removeClass("rowNotAvail");
    $("#book_" + bookId).addClass("rowAvail");

    $("#book_" + bookId + " .bookAvailability").html("yes");
    



    initButtons();

}

export function initButtons(){

    console.log('initButtons');

    $(".rentedReturn").unbind().bind("click", function(){

        returnBook(this.id);
        toRent(this.id);
    })

    $(".rentTableRent").unbind().bind("click", function(){
        
        console.log('clicked the rent button');

        rentBook(this.id);
        toReturn(this.id);
    })

    $(".rentTableReturn").unbind().bind("click", function(){
        
        console.log("clicked return button");
        returnBook(this.id);
        toRent(this.id);
    })
}



$(document).ready(function(){

    if(page == 'rent'){

        console.log('Only runs on the rent page');


        

        getCheckedOutBooks();

        //runs bookAlerts every 10 sec
        setInterval(function(){
            //getCheckedOutBooks();
        }, 5000)
    }

});