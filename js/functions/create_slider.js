export function create_slider(size, appendTo){
	console.log("this is the create slider function");

	//we will just take the width, height, and border radius

	let container_size = size + "_slider_container";
	let slider_size = size + "_slider";


	$(appendTo).append("<div class='" + container_size + "''></div>");
		



	$("." + container_size).append("<div class='jsSlider " + slider_size + "'></div>");

}


var slider = $(".jsSlider");

slider.bind("click", function(){
    console.log("The slider was clicked");

    var sliderId = $(this).attr("id");
    slider = "#" + sliderId;
    slider = $(slider);

    var sliderContainerWidth = $(".jsSliderContainer").width();
    var sliderWidth = $(".jsSlider").width();

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