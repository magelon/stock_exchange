<?php # Script 17.6 - post_form_r.php
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

	echo '<form  action="post_r.php " method="post" accept-charset="utf-8">';

	// If on read.php...
	if (isset($tid) && $tid) {

		// Print a caption:


		// Add the thread ID as a hidden input:
		echo '<input name="tid" type="hidden" value="' . $tid . '" />';

	}

	// Create the body textarea:
	echo '<p> <textarea name="body" rows="4" cols="40">';

	if (isset($body)) {
		echo $body;
	}

	echo '</textarea></p>';

	// Finish the form:
	echo '<input name="submit" type="submit" />
	</form>';


}

?>
