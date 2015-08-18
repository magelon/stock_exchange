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
	echo '<form action="post_edit.php" method="post" accept-charset="utf-8">';

	  // New thread

		// Print a caption:
		echo '<h3>edit_object</h3>';

		// Create subject input:
		echo '<p><em>subject</em>: <input name="subject" type="text" size="60" maxlength="100" ';


			echo "value= {$row['subject']} ";


		echo '/></p>';

		//define the tid

	// Create the body textarea:
	echo '<p><em>body</em>: <textarea name="body" rows="10" cols="60">';


		echo $row['body_t'];


	echo '</textarea></p>';
	//tid
	echo '<input name="tid" type="hidden" value="'.$tid.'">';
	// Finish the form:
	echo '<input name="submit" type="submit" />
	</form>';

} else {
	echo '<p>You must be logged in to post messages.</p>';
}

?>
