<?php # Script 17.6 - post_form_t.php
// This page shows the form for posting messages.
// It's included by other pages, never called directly.

// Redirect if this page is called directly:
//if (!isset($words)) {
//	header ("Location: http://www.example.com/index.php");
//	exit();
//}

// Only display this form if the user is logged in:
if (isset($_SESSION['user_id'])) {

	// Display the form:
	echo '<form enctype="multipart/form-data" action="post_t.php" method="post" accept-charset="utf-8">';

	  // New thread

		// Print a caption:
		echo '<h3>new_object</h3>';

		// Create subject input:
		echo '<p><em>subject</em>: <input name="subject" type="text" size="60" maxlength="100" ';

		// Check for existing value:
		if (isset($subject)) {
			echo "value=\"$subject\" ";
		}

		echo '/></p>';



	// Create the body textarea:
	echo '<p><em>body</em>: <textarea name="body" rows="10" cols="60">';

	if (isset($bodyt)) {
		echo $bodyt;
	}

	echo '</textarea></p>';


//upload picture
	echo'

	<input type="hidden" name="MAX_FILE_SIZE" value="1524288" />

	<fieldset><legend>Select a JPEG or PNG image of 1024KB or smaller to be uploaded:</legend>

	<p><b>File:</b> <input type="file" name="upload" /></p>

	</fieldset>

	';

	// Finish the form:
	echo '<input name="submit" type="submit" />


	</form>';

} else {
	echo '<p>You must be logged in to post messages.</p>';
}

?>
