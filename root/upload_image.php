


<?php # Script 11.2 - upload_image.php


session_start(); // Start the session.
// Include the header:
$page_title = 'upload';
include ('header.html');


// Check if the form has been submitted:
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

} // End of the submitted conditional.
?>

<form enctype="multipart/form-data" action="upload_image.php" method="post">

	<input type="hidden" name="MAX_FILE_SIZE" value="1524288" />

	<fieldset><legend>Select a JPEG or PNG image of 1024KB or smaller to be uploaded:</legend>

	<p><b>File:</b> <input type="file" name="upload" /></p>

	</fieldset>
	<div align="center"><input type="submit" name="submit" value="Submit" /></div>

</form>

<?php include ('includes/footer.html'); ?>
