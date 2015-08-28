<?php # Script 17.5 - read.php
// This page shows the messages in a thread.
$page_title = 'read_edit';
require('session.php');
//need header.html
include ('header.html');

$tid = FALSE;

// Check for a thread ID...
if (isset($_GET['tid']) && filter_var($_GET['tid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {

	// Create a shorthand version of the thread ID:
	$tid = $_GET['tid'];

	// Convert the date if the user is logged in:
	//if (isset($_SESSION['user_tz'])) {
	//	$posted = "CONVERT_TZ(p.posted_on, 'UTC', '{$_SESSION['user_tz']}')";
	//} else {
	//	$posted = 'p.posted_on';
	//}

	// Run the query:
	$q ="select subject, body_t, picture_t
	from threads
	where thread_id=$tid
	";
	//execute the query
	$r = mysqli_query($dbc, $q);

	while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){

	include('includes/post_form_edit.php');
	}
}



?>




<?php include ('includes/footer.html'); ?>
