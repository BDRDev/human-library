//console.log("connected");

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


//The rentBook function gets the current time and sets that
//time in the database for the book to be returned


function rentBook(bookId){

    var xmlHttp = new createXmlHttpRequestObject();

    xmlHttp.open("GET", "../indexUpdate/rentBook.php?bookId=" + bookId, true);

    xmlHttp.onreadystatechange = function(){

        if(xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            //console.log(xmlHttp.responseText);

            var resultJSON = JSON.parse(xmlHttp.responseText);

            //console.log(resultJSON);

            display(bookId, resultJSON);
        }
    };

    xmlHttp.send(null);
}

//the returnBook function sets the timeBack to NULL in the database
function returnBook(bookId){
    console.log("return: " + bookId);

    var xmlHttp = new createXmlHttpRequestObject();

    xmlHttp.open("GET", "../indexUpdate/returnBook.php?bookId=" + bookId, true);

    xmlHttp.onreadystatechange = function(){

        if(xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            //console.log(xmlHttp.responseText);

            var resultJSON = JSON.parse(xmlHttp.responseText);

            //console.log(resultJSON);


            display(bookId, resultJSON);
        }
    };

    xmlHttp.send(null);
}


//the display function displays the time that book is going ot be back
//it also changes the button from rent to return
function display(bookId, JSON){
    var id = "#" + bookId;

    $(id).children("div.employee-bookInformation").children("div.indexAva").html("Available: " + JSON.available);

    if(JSON.timeBack !== null) {
        $(id).children("div.employee-bookInformation").children("div.employee-TimeBack").html("Time Back: " + JSON.timeBack);
    } else {
       $(id).children("div.employee-bookInformation").children("div.employee-TimeBack").html("");

    }


    if(JSON.available !== "yes") {
        $(id).children("div.rentReturn").html("<div class='employee-Return' id='" + JSON.bookId + "'>RETURN</div>");
    } else {

        $(id).children("div.rentReturn").html("<div class='employee-Rent' id='" + JSON.bookId + "' >RENT</div>");
    }

    init();
}

//.unbind.bind is very crucial
function init(){

    $(".employee-Rent").unbind().bind("click", function(){
        rentBook(this.id);
    });

    $(".employee-Return").unbind().bind('click', function(){
        returnBook(this.id);
    })
}



$(document).ready(function(){

    init();



});