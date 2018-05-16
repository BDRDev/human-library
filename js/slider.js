//This section is for the slider mechanic

//grabs all of the sliders on the page
var slider = $(".jsSlider");

slider.bind("click", function(){
    //console.log("The slider was clicked");

    var sliderId = $(this).attr("id");
    slider = "#" + sliderId;
    slider = $(slider);

    var sliderContainerWidth = $(".jsSliderContainer").width();
    var sliderWidth = $(".jsSlider").width();

    //this is for the amount of padding on the container
    //the way you calc this is take the padding you have and
    //multiply it by 2

    var sliderMargin = 2 * (parseInt($(".jsSlider").css("margin-left")));

    //console.log(sliderContainerWidth);
    //console.log(sliderWidth);
    //console.log(sliderMargin);

    console.log(slider);

    if(slider.hasClass("positionTwo")){
        console.log("it is not in positionTwo");

        slider.animate({
            'left': '0'
        }, 700, function(){
            slider.removeClass("positionTwo");

            notAttendEvent(sliderId)

        });

    } else {
        console.log("it is in position two");

        //change this to be calculated
        slider.animate({
            'left' : '45'
        }, 700, function(){
            slider.addClass("positionTwo");

            attendEvent(sliderId)
        })

    }
});

//this function creates an HmlHttpRequest Object.
function createXmlHttpRequestObject() {
    // add your code here to create a XMLHttpRequest object compatible to most browsers
    if(window.ActiveXObject) { //for ie 6 or older
        return new ActiveXObject("Microsoft.XMLHTTP");
    } else if(window.XMLHttpRequest) { //for ie7+ and other browsers
        return new XMLHttpRequest();
    } else {
        return false; //failed to create the object
    }

}

function attendEvent(sliderId){
    console.log("attendEvent");

    var xmlHttp = new createXmlHttpRequestObject();

    console.log("sliderId: " + sliderId);

    xmlHttp.open("GET", "../indexUpdate/bookAttend.php?sliderId=" + sliderId, true);

    xmlHttp.onreadystatechange = function() {
        //console.log(xmlHttp.readyState);

        if(xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            console.log(xmlHttp.responseText);


        }
    };

    xmlHttp.send(null);
}

function notAttendEvent(sliderId){
    console.log("notAttendEvent");

    var xmlHttp = new createXmlHttpRequestObject();

    console.log("sliderId: " + sliderId);

    xmlHttp.open("GET", "../indexUpdate/bookNotAttend.php?sliderId=" + sliderId, true);

    xmlHttp.onreadystatechange = function() {
        //console.log(xmlHttp.readyState);

        if(xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            console.log(xmlHttp.responseText);


        }
    };

    xmlHttp.send(null);
}