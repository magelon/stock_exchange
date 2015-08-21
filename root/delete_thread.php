<?php # Script 17.5 - read.php
// This page shows the messages in a thread.
//start session read session information
session_start();

$page_title = 'read_edit';

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
	$q_delete_thread="delete
	from threads
	where thread_id=$tid
	";

	$q_delete_posts="
	delete from posts
	where thread_id=$tid
	";
	//execute the query
	$r_d_t = mysqli_query($dbc, $q_delete_thread);
	$r_d_p = mysqli_query($dbc,$q_delete_posts);


}



?>




<?php include ('includes/footer.html'); ?>
