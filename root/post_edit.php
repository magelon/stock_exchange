<?php # Script 17.7 - post_r.php
// This page handles the message post.
// It also displays the form if creating a new thread.
$page_title = 'post_edit';
include ('session.php');
include ('header.html');
// Need the database connection:


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

				$q_up_tp="UPDATE threads set picture_t = '$filename' where thread_id={$_POST['tid']}";

				$p_up_tp= mysqli_query($dbc, $q_up_tp);

				if (mysqli_affected_rows($dbc) == 1) {
					echo '<p>picture stored.</p>';
				}

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
