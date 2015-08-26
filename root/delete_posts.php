<?php # Script 17.5 - read.php
// This page shows the messages in a thread.
$page_title = 'delete_posts';
//need header.html
include ('header.html');


$pid = FALSE;

// Check for a thread ID...
if (isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {

	// Create a shorthand version of the thread ID:
	$pid = $_GET['pid'];

	// Convert the date if the user is logged in:
	//if (isset($_SESSION['user_tz'])) {
	//	$posted = "CONVERT_TZ(p.posted_on, 'UTC', '{$_SESSION['user_tz']}')";
	//} else {
	//	$posted = 'p.posted_on';
	//}

	// Run the query:


	$q_delete_posts="
	delete from posts
	where post_id=$pid
	";


	//execute the query

	$r_d_p = mysqli_query($dbc,$q_delete_posts);

	if (mysqli_affected_rows($dbc) == 1) {
		echo'posts deleted';
	}


}

?>

<?php include ('includes/footer.html'); ?>
