<?php # Script 17.5 - read.php
// This page shows the messages in a thread.

session_start();
$page_title = 'read';
include ('header.html');
// Need the database connection:


// Check for a thread ID...
$tid = FALSE;
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
	$q = "select t.subject, t.body_t, u.name, p.message from threads as t inner join posts as p using (thread_id) inner join users as u on p.user_id=u.user_id where t.thread_id =$tid  ";
	$q2 ="select t.subject, t.body_t from threads as t where thread_id=$tid ";
	$r = mysqli_query($dbc, $q);
	if (!(mysqli_num_rows($r) > 0)) {
		$r = mysqli_query($dbc,$q2);
		$messages = mysqli_fetch_array($r, MYSQLI_ASSOC);
		echo "<h2>{$messages['subject']}</h2>\n<br />{$messages['body_t']}<br />";
		
	}

} // End of isset($_GET['tid']) IF.

if ($tid) { // Get the messages in this thread...

	$printed = FALSE; // Flag variable.

	// Fetch each:
	while ($messages = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

		// Only need to print the subject once!
		if (!$printed) {
			echo "<h2>{$messages['subject']}</h2>\n<br />{$messages['body_t']}<br />";
			$printed = TRUE;
		}

		// Print the message:
		echo "<p>{$messages['name']} \n<p>{$messages['message']} \n<hr></p>";

	} // End of WHILE loop.

	// Show the form to post a message:
	include ('includes/post_form.php');

} else { // Invalid thread ID!
	echo '<p>This page has been accessed in error.</p>';
}

?>
