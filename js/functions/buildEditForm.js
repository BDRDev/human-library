

export const buildEditForm = (bookData, nextEvent, attending, callback) => {

	console.log('displayEditForm');

	const { title, chapter_one, chapter_two, chapter_three, description, available } = bookData;

	const yes = true
	const no = false

	let form = `

		<form class='admin_edit_form'>
			<label for='edit_title' >Title</label>
			<input type='text' name='edit_title' id='edit_title' value='${title}' />

			<label for='edit_description' >description</label>
			<input type='text' name='edit_description' id='edit_description' value='${description}' />

			<label for='edit_chapter_one' >Chapter One</label>
			<input type='text' name='edit_chapter_one' id='edit_chapter_one' value='${chapter_one}' />

			<label for='edit_chapter_two' >Chapter two</label>
			<input type='text' name='edit_chapter_two' id='edit_chapter_two' value='${chapter_two}' />

			<label for='edit_chapter_three' >Chapter three</label>
			<input type='text' name='edit_chapter_three' id='edit_chapter_three' value='${chapter_three}' />

			<label for='edit_available'>Available</label>
			<select name="edit_available" id='edit_available'>
				<option ${available === 'yes' ? 'selected' : "" } value="yes">Yes</option>
				<option ${available === 'no' ? 'selected' : "" } value="no">No</option>
				<option ${available === 'away' ? 'selected' : "" } value="away">Away</option>
			</select>

			<label for='edit_attending_next_event'>Attending Next Event</label>
			<select name="edit_attending_next_event" id='edit_attending_next_event'>
				<option ${attending ? 'selected' : "" } value='true' >Yes</option>
				<option ${attending ? "" : 'selected' } value='false' >No</option>
			</select>
			

			<input class='edit_submit button' type='submit' value='submit' />

		</form>`;

	$('.admin_edit_form_wrapper').html(form);

	$('.admin_edit_form').on('submit', e => {

		callback();
		
		e.preventDefault();
	})


}

// <label for='edit_available' >available</label>
// <input type='text' name='edit_available' id='edit_available'
// value='${available}' />