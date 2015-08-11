<?php # Script 17.7 - post.php
// This page handles the message post.
// It also displays the form if creating a new thread.
$page_title = 'post_t';
include ('session.php');
include ('header.html');
// Need the database connection:


if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Language ID is in the session.
	// Validate thread ID ($tid), which may not be present:

		$tid = FALSE;


	// If there's no thread ID, a subject must be provided:
	if (!$tid && empty($_POST['subject'])) {
		$subject = FALSE;
		echo '<p>Please enter a subject for this post.</p>';
	} elseif (!$tid && !empty($_POST['subject'])) {
		$subject = htmlspecialchars(strip_tags($_POST['subject']));
	} else { // Thread ID, no need for subject.
		$subject = TRUE;
	}

	// Validate the bodyt:
	if (!empty($_POST['body'])) {
		$bodyt = htmlentities($_POST['body']);
	} else {
		$bodyt = FALSE;
		echo '<p>Please enter a body for this post.</p>';
	}

	if ($subject && $bodyt) { // OK!

		// Add the message to the database...

		if (!$tid) { // Create a new thread.
			$q = "INSERT INTO threads ( user_id, subject,body_t, value) VALUES ( {$_SESSION['user_id']}, '" . mysqli_real_escape_string($dbc, $subject) . "','" . mysqli_real_escape_string($dbc, $bodyt) . "',10)";
			$q2="update users set balance=balance+10 where  user_id={$_SESSION['user_id']}  ";

			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) {
				$r2=mysqli_query($dbc, $q2);
					echo '<p>your balance is add up 10.</p>';
				$tid = mysqli_insert_id($dbc);
				echo '<p>Your post has been entered.</p>';

			} else {
				echo '<p>Your post could not be handled due to a system error.</p>';
			}
		} // No $tid.



	} else { // Include the form:
		include ('includes/post_form_t.php');
	}

} else { // Display the form:

	include ('includes/post_form_t.php');

}


?>
