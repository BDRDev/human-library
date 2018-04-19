
//JQuery Code for scrolling up and down

$("nav a").click(function(e) {
    var btnID = e.currentTarget.id + "Section";
    $("html, body").animate({
        scrollTop: $("#" + btnID).offset().top
    }, 700);

});

//this function creates an HmlHttpRequest Object.
function createXmlHttpRequestObject()
{
    // add your code here to create a XMLHttpRequest object compatible to most browsers
    if(window.ActiveXObject) { //for ie 6 or older
        return new ActiveXObject("Microsoft.XMLHTTP");
    } else if(window.XMLHttpRequest) { //for ie7+ and other browsers
        return new XMLHttpRequest();
    } else {
        return false; //failed to create the object
    }

}

var booksArray = [];

//grabs each div with the class 'books' and adds them to an array
function addDivsToArray(){
    $("div.books").each(function(){
        //console.log($(this).attr('id'));

        var value = $(this).attr('id');

        booksArray.push(value);

    })

} //ends addDivsToArray

//gets all of the information of the book based off the bookId
function process(bookId) {
    //creates a new XmlHttpRequest Object.
    var xmlHttp = new createXmlHttpRequestObject();

    xmlHttp.open("GET", "indexUpdate/bookUpdate.php?bookId=" + bookId, true);

    xmlHttp.onreadystatechange = function() {
        //console.log(xmlHttp.readyState);

        if(xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            //console.log(xmlHttp.responseText);

            var resultJSON = JSON.parse(xmlHttp.responseText);

            //console.log(resultJSON);

            display(resultJSON, bookId);
        }
    };

    xmlHttp.send(null);
}

function display(bookResults, bookId){
    //give the bookId a css ID
    //console.log("from display: " + bookId);
    var id = "#" + bookId;

    //console.log(id);

    //var currentDiv = $(id);

    //console.log($(id).children().children("div.bookAva"));
    //console.log("available: " + bookResults.available);

    //firstName, lastName, story, timeBack

    $(id).children().children("div.story").html(bookResults.story);

    $(id).children().children("div.name").html(bookResults.firstName + " " + bookResults.lastName);

    $(id).children().children("div.avaHolder").children("div.bookAva").html("Available: " + bookResults.available);


    console.log($(id).children().children("div.avaHolder").children("div.bookAva").html());

    console.log(bookResults.timeBack);

    if(bookResults.timeBack === null) {
        $(id).children().children("div.avaHolder").children("div.time").html(" ");
    } else {
        $(id).children().children("div.avaHolder").children("div.time").html("Time Back: " + bookResults.timeBack);
    }

    if(bookResults.timeBack === null){
        $(id).css({
        })
    }


}

function updateIndex(){
    //grabs all the books from the page and puts them in an array
    addDivsToArray();

    console.log(booksArray);

    //loops through the books array and passes each bookId
    //to the process function

    //when it works for sure, change i < 1 to < booksArray.length
    for(var i = 0; i < booksArray.length; i++) {
        //console.log(booksArray[i]);
        var bookId = booksArray[i];
        process(bookId);
    }


    //this is the end of the function, this line needs to be last
    //clears the books Array
    booksArray = [];
}


$(document).ready(function(){
   console.log("connected w jQuery");


   //for one test
   //updateIndex();


   //updates the index page every 5 seconds
   setInterval(function(){
       updateIndex();
   }, 5000)

});