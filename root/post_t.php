<?php # Script 17.7 - post_t.php
// This page new a message post.
// It also displays the form if creating a new thread.
$page_title = 'post_t';
include ('session.php');
include ('header.html');
// Need the database connection:


if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.


	// Check for an uploaded file:
	if (isset($_FILES['upload'])) {

		// Validate the type. Should be JPEG or PNG.
		$allowed = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
		if (in_array($_FILES['upload']['type'], $allowed)) {

			//oldfilename
			$old_filename =$_FILES['upload']['name'];

			//a random number_form 1-9999
			$random_digit=rand(0000,9999);

			//new name
			$filename=$random_digit.$old_filename;



			// Move the file over.
			if (move_uploaded_file ($_FILES['upload']['tmp_name'], "../uploads/{$filename}")) {
				echo '<p><em>The file has been uploaded!</em></p>';


			} // End of move... IF.

		} else { // Invalid type.
			echo '<p class="error">Please upload a JPEG or PNG image.</p>';
		}

	} // End of isset($_FILES['upload']) IF.

	// Check for an error:
	if ($_FILES['upload']['error'] > 0) {
		echo '<p class="error">The file could not be uploaded because: <strong>';

		// Print a message based upon the error.
		switch ($_FILES['upload']['error']) {
			case 1:
				print 'The file exceeds the upload_max_filesize setting in php.ini.';
				break;
			case 2:
				print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
				break;
			case 3:
				print 'The file was only partially uploaded.';
				break;
			case 4:
				print 'No file was uploaded.';
				break;
			case 6:
				print 'No temporary folder was available.';
				break;
			case 7:
				print 'Unable to write to the disk.';
				break;
			case 8:
				print 'File upload stopped.';
				break;
			default:
				print 'A system error occurred.';
				break;
		} // End of switch.

		print '</strong></p>';

	} // End of error IF.

	// Delete the file if it still exists:
	if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) ) {
		unlink ($_FILES['upload']['tmp_name']);
	}


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
			$q = "INSERT INTO threads ( user_id, subject,body_t, value,picture_t) VALUES ( {$_SESSION['user_id']}, '" . mysqli_real_escape_string($dbc, $subject) . "','" . mysqli_real_escape_string($dbc, $bodyt) . "',10,'$filename')";
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

<?php include ('includes/footer.html'); ?>
