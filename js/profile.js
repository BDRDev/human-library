import { create_slider } from './functions/create_slider';


if(page == 'profile'){
	console.log("is it the profile page");

	create_slider('small', '.profile_holder');

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







}