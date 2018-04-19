<?php
include_once '../_includes/config.php';
?>



<form class="addBook" action="<?= URL_ROOT ?>/addBook/addBook_process.php" method="post" enctype="multipart/form-data">

    <h3>Add a Book</h3>

    <label for="title" class="">Title</label>
    <input type="text" name="title" id="title" value="" required />

    <label for="story" class="">Story</label>
    <textarea name="story" id="story"required rows="5"></textarea>

    <label for="chapters" class="">Chapters</label>
    <div id="editor" name="editor"></div>
    <input type="hidden" name="chapters" />

    <label for="#">Available</label>
    <div class="admin-decision">
        <input style="vertical-align: middle; margin: 0;" type="radio" name="available" value="yes" id="yes">
        <label for="yes">Yes</label>
    </div>

    <div class="admin-decision">
        <input style="vertical-align: middle; margin: 0;" type="radio" name="available" value="no" id="no">
        <label for="no">No</label>
    </div>

    <label for="#">Select Image to upload:</label>
    <input style="color: black;" type="file" name="imageUpload" id="imageUpload" />


    <input type="submit" value="Submit" name="submit" />

</form>

<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script>
  var quill = new Quill('#editor', {
    theme: 'snow'
  });

  var form = document.querySelector('.addBook');
  form.onsubmit = function() {
    // Populate hidden form on submit
    var about = document.querySelector('input[name=chapters]');
    about.value = quill.getContents();
  };
</script>