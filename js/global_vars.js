//This file is used for all of the global vars that will 
//need to be changed based on where I am working on this project

//mostly urls for ajax calls so far but for whatever

//Blake: Laptop Base
// let base = 'http://localhost/humanLibrary/';

//Blake: Desktop Base
let base = 'http://localhost:8383/humanLibrary/';

//Blake: Server Base
// let base = 'http://www.humanlibrary.us/';


export const process_function_url = base + 'indexUpdate/bookUpdate.php';

export const update_book_display_function_url = base + 'ajax/updateBookDisplay.php';

export const get_book_data_function_url = base + 'ajax/getBookData.php';

export const add_to_attending_url = base + 'ajax/addToAttending.php';

export const remove_from_attending_url = base + 'ajax/removeFromAttending.php';

export const get_events_list_url = base + 'ajax/getEventsList.php';

export const get_specific_attend_list_url = base + 'ajax/getSpecificAttendList.php';