

import { addEventSection } from '../admin';

const jqueryValidation = require('jquery-validation');

import { add_event } from '../functions/adminCalls';
import _ from 'lodash';

export const addEvent = () => {

	//first we need to build the form
	buildEventForm();
}


const buildEventForm = () => {

	const form = 
		 '<form class="addEventForm">' +

            '<div class="eventSection">' +
                '<p>Event Name</p>' + 
                '<input id="newEventName" type="text" name="eventName"' +
                'value="Human lib 2" data-error="#event-name-error">' +
                '<span class="validation-error" id="event-name-error"></span>' + 
            '</div>' +

            '<div class="eventSection">' + 
                '<p>Date</p>' + 
                '<input  id="newEventDate" type="date" name="date" value="10/12/13" data-error="#event-date-error">' + 
                '<span class="validation-error" id="event-date-error"></span>' + 
            '</div>' +

            '<div class="newEventTime">' +

                '<div class="timeLabel">' +
                    'Start Time' + 
                '</div>' +

                '<div class="timeSelection">' +
                    '<input class="time" id="newEventStart" type="number" name="startTime" data-error="#event-start-error">' +
                    '<select class="period" name="startPeriod" id="startPeriod">' +
                        '<option value="am">am</option>' +
                        '<option value="pm">pm</option>' +
                    '</select>' +
                '</div>' +
                '<span class="validation-error" id="event-start-error"></span>' + 
            '</div>' +

            '<div class="newEventTime">' +
                '<div class="timeLabel">' +
                    'End Time' + 
                '</div>' +

                '<div class="timeSelection">' +
                    '<input class="time" id="newEventEnd" type="number" name="endTime" data-error="#event-end-error">' +
                    '<select class="period" name="endPeriod" id="endPeriod">' +
                        '<option value="am">am</option>' +
                        '<option value="pm">pm</option>' +
                    '</select>' +
                '</div>' +
                '<span class="validation-error" id="event-end-error"></span>' + 
            '</div>' +

            '<div class="eventSection">' +
                '<p>Address</p>' +
                '<input  id="newEventAddress" type="text" name="address" value="3467 south st." data-error="#event-address-error">' +
                '<span class="validation-error" id="event-address-error"></span>' + 
            '</div>' + 

            '<div class="cityState">' + 
                
                '<div class="city">' +
                    '<p>City</p>' +
                    '<input  id="newEventCity" type="text" name="city" value="Indianapolis" data-error="#event-city-error">' +
                    '<span class="validation-error" id="event-city-error"></span>' + 
                '</div>' +

            
                '<div class="state">' +
                    '<p>State</p>' + 
                    '<input id="newEventState" type="text" name="state" value="IN" data-error="#event-state-error">' +
                    '<span class="validation-error" id="event-state-error"></span>' + 
                '</div>' +
            
            '</div>' +

            '<div class="eventSection">' +
                '<p>Room</p>' + 
                '<input id="newEventRoom" type="text" name="room" value="430">' +
            '</div>' +
			
			'<input class="button" type="submit" value="Submit">' +
        '</form>';

    $(addEventSection).append(form);

    validateForm();
}

const toMilitary = (time, period) => {

    if(period === 'pm'){
        time = parseInt(time) === 12 ? parseInt(time) : parseInt(time) + 12;
    } else if(period === 'am'){
        time = parseInt(time) === 12 ? 0 : parseInt(time);
    }

    return time;
}

const validateForm = () => {

    $.validator.addMethod('timeCheck', (value, element) => {
        let startTime = parseInt($("#newEventStart").val());
        const startPeriod = $("#startPeriod").val();

        let endTime = parseInt(value);
        const endPeriod = $("#endPeriod").val();

        if(startPeriod === "pm"){
            startTime = parseInt(startTime) === 12 ? parseInt(startTime) : parseInt(startTime) + 12;
        } else if(startPeriod === "am"){
            startTime = parseInt(startTime) === 12 ? 0 : parseInt(startTime);
        }

        if(endPeriod === "pm"){
            endTime = parseInt(endTime) === 12 ? parseInt(endTime) : parseInt(endTime) + 12;
        } else if(endPeriod === "am"){
            endTime = parseInt(endTime) === 12 ? 0 : parseInt(endTime);
        }

        if(endTime > startTime){
            return true
        } else {
            return false;
        }

    }, 'End Time must be greater than Start Time');

    $(".addEventForm").validate({
        submitHandler: form => {

            let formData = {};

            $('.addEventForm').serializeArray().forEach(({ name, value }) => {
                formData[name] = value;
            });

            formData.startTime = toMilitary(formData.startTime, formData.startPeriod);
            formData.endTime = toMilitary(formData.endTime, formData.endPeriod);

            formData = _.omit(formData, ['startPeriod', 'endPeriod']);

            console.log('new form data', formData);

            add_event(formData);
        },
        rules: {
            eventName: {
                required: true
            },
            date: {
                required: true
            },
            startTime: {
                required: true,
                min: 1,
                max: 12
            },
            endTime: {
                required: true,
                min: 1,
                max: 12,
                timeCheck: true
            },
            address: {
                required: true
            },
            city: {
                required: true
            },
            state: {
                required: true,
                maxlength: 2
            }
           
        },
        messages: {
            eventName: "Event Name is required",
            date: "Date is required",
            startTime: {
                required: "Start Time is required",
                min: "Start Time must be greater then 1",
                max: "Start Time must be less than 12"
            },
            endTime: {
                required: "End Time is required",
                min: "End Time must be greater then 1",
                max: "End Time must be less than 12"
            },
            address: "Address is required",
            city: "City is required",
            state: { 
                required: "State is required",
                maxlength: "State Abbreviation only"
            }
        },
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');

          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
    });
}

