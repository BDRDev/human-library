
import { addNewEvent } from '../functions/dataCalls';

import { addEventSection } from '../admin';

export const addEvent = () => {

	//first we need to build the form
	buildEventForm();
}


const buildEventForm = () => {

	const form = 
		 '<form class="addEventForm">' +
            'Event Name:<br>' + 
            '<input id="newEventName" type="text" name="eventName" value="Human lib 2">' + 
            '<br>' +

            'Date:<br>' + 
            '<input  id="newEventDate" type="date" name="date" value="10/12/13">' + 
            '<br>' +

            'Start Time:<br>' + 
            '<input id="newEventStart" type="number" name="startTime">' +
            '<select name="startPeriod">' +
                '<option value="am">am</option>' +
                '<option value="pm">pm</option>' +
            '</select>' +
            '<br>' +

            'End Time:<br>' + 
            '<input id="newEventEnd" type="number" name="endTime">' +
            '<select name="endPeriod">' +
                '<option value="am">am</option>' +
                '<option value="pm">pm</option>' +
            '</select>' +
            '<br>' +



            'Address:<br>' +
            '<input  id="newEventAddress" type="text" name="address" value="3467 south st.">' +
            '<br>' +

            'City:<br>' +
            '<input  id="newEventCity" type="text" name="city" value="Indianapolis">' + 
            '<br>' +

            'State:<br>' + 
            '<input id="newEventState" type="text" name="state" value="IN">' +
            '<br>' +

            'Room:<br>' + 
            '<input id="newEventRoom" type="text" name="room" value="430">' +
            '<br>' +
			
			'<br><br>' +
			'<input type="submit" value="Submit">' +
        '</form>';

        $(addEventSection).append(form);

        $('.addEventForm').on('submit', function(e) {

			onFormSubmit();

			e.preventDefault();
	});
}

const onFormSubmit = () => {

    let formData = {}

    $('.addEventForm').serializeArray().forEach(({ name, value }) => {
        formData[name] = value;
    });

    formData = adjustTimes(formData);

    console.log(formData);

    //next we would pass the new data obj to ajax and to php

    addNewEvent(formData);
}

const adjustTimes = formData => {

    if(formData.startPeriod === 'pm'){
        formData.startTime = parseInt(formData.startTime) === 12 ? parseInt(formData.startTime) : parseInt(formData.startTime) + 12;
    }

    if(formData.endPeriod === 'pm'){
        formData.endTime = parseInt(formData.endTime) === 12 ? parseInt(formData.endTime) : parseInt(formData.endTime) + 12;
    }

    return formData;

}