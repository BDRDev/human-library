import { add_to_attending_url, remove_from_attending_url } from '../global_vars';

console.log(add_to_attending_url);

//class for the Sliders, was having a problem with encapsulation so we're going to give this a try
export class Slider {


        
        //Constructor runs anytime a new object is instantiated
        //this will be used to put the slider on the page
        constructor(size, appendTo, sliderId, position, eventId, userId){
            console.log("Create The Slider");
            
            this.size = size;
            this.appendTo = appendTo;
            this.sliderId = sliderId;
            this.position = position;
            this.eventId = eventId;
            this.userId = userId;



            this.container_size = this.size + "_slider_container";
            this.slider_size = this.size + "_slider";



            //prints the holder for the slider to the page
            $(this.appendTo).append("<div class='" + this.container_size + " " + this.sliderId + "'></div>");

            //Puts the slider in the holder
            $("." + this.sliderId).append("<div id='" + this.sliderId + "' class='jsSlider " + this.slider_size + "'></div>");

            //here is where we check to see if we need to add the positionTwo class or not
            if(position === 'true'){
                $("#" + this.sliderId).addClass('positionTwo');
            }

            $("#" + this.sliderId).click(() => this.sliderClick(this.sliderId, this.eventId, this.userId));

        }


        //here is where will check the position, animate the slider
        //as well as call the correct function
        sliderClick(sliderId, eventId, userId){
            console.log("The Slider was clicked");

            let slider = $("#" + sliderId);

            //console.log(slider);

            if(slider.hasClass('positionTwo')){
                console.log("In position Two");

                slider.animate({
                    'left': '39'
                }, 600, function(){
                    slider.removeClass("positionTwo");

                    //Moves from position two -> position one
                    //calls the function to not attend said event

                    //console.log("From PositionTwo -> PositionOne");

                    notAttend("not attending", eventId, userId);

                });
            } else {

                slider.animate({
                    'left' : '94'
                }, 600, function(){
                    slider.addClass("positionTwo");

                    //Mover from position one -> position two
                    //calls the function to attend said event

                    //console.log("From PositionOne -> PositionTwo");

                    attend("attending", eventId, userId);
                })
            }   

        } //end sliderClick method
        
        console(){
            console.log(this)
        }
}



 function attend(word, eventId, userId){
    console.log(word);
    console.log('eventId', eventId);
    console.log('userId', userId);

    //This adds this user to the attending table
    $.ajax({
        url: add_to_attending_url,
        data: {
            eventId: eventId,
            userId: userId
        },
        success: function(result){
            console.log("Adding was successful");
            console.log(result);
        }
    }) //ends ajax call
}

function notAttend(word, eventId, userId){
    console.log(word);
    console.log('eventId', eventId);
    console.log('userId', userId);

    //This removes this user from the attending table
    $.ajax({
        url: remove_from_attending_url,
        dataType: 'json',
        data: {
            eventId: eventId,
            userId: userId
        },
        success: function(result){
            console.log("removing was successful");
            console.log(result);
        }
    }) //ends ajax call
}