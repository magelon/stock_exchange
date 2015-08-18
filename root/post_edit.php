<?php # Script 17.7 - post_r.php
// This page handles the message post.
// It also displays the form if creating a new thread.
$page_title = 'post_edit';
include ('session.php');
include ('header.html');
// Need the database connection:


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


	if (empty($_POST['subject'])) {
		$subject = FALSE;
		echo '<p>Please enter a subject for this post.</p>';
	} else{
		$subject = htmlspecialchars(strip_tags($_POST['subject']));
	}

	// Validate the bodyt:
	if (!empty($_POST['body'])) {
		$bodyt = htmlentities($_POST['body']);
	} else {
		$bodyt = FALSE;
		echo '<p>Please enter a body for this post.</p>';
	}

	if ($subject && $bodyt) {
		$q2=" update threads set subject='$subject',body_t='$bodyt' where thread_id={$_POST['tid']} ";
		$r = @mysqli_query($dbc, $q2);

		if (mysqli_affected_rows($dbc) == 1) {
			echo'<p>Your post has been update.</p>';
		}else{
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q2 . '</p>';
		}



	}else { // Include the form:
		include ('includes/post_form_edit.php');
	}


}else { // Display the form:

	include ('includes/post_form_edit.php');

}


?>
