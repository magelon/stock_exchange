<?php # Script 17.7 - post_r.php
// This page handles the message post.
// It also displays the form if creating a new thread.
$page_title = 'post_r';
include ('session.php');
include ('header.html');
// Need the database connection:


if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Language ID is in the session.
	// Validate thread ID ($tid), which may not be present:
	// Validate thread ID ($tid), which may not be present:
	if (isset($_POST['tid']) && filter_var($_POST['tid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
		$tid = $_POST['tid'];
	}

	if (isset($_POST['pid']) && filter_var($_POST['pid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
		$pid = $_POST['pid'];
	}



	// Validate the body:
	if (!empty($_POST['body'])) {
		$body = htmlentities($_POST['body']);
	} else {
		$body = FALSE;
		echo '<p>Please enter a body for this post.</p>';
	}

	if ($body) { // OK!

		// Add the message to the database...
			// Add this to the replies table:
			//add to parent reply: update posts set parent_id =' 2' where post_id='3';
			$q = "INSERT INTO posts (thread_id, user_id, message,parent_id) VALUES ($tid, {$_SESSION['user_id']}, '" . mysqli_real_escape_string($dbc, $body) . "',$pid )";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) {
				echo '<p>Your post has been entered.</p>';

				header('Location: ' . $_SERVER['HTTP_REFERER']);
			} else {
				echo '<p>Your post could not be handled due to a system error.</p>';
			}


	}

}

?>
