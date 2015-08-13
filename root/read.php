<?php # Script 17.5 - read.php
// This page shows the messages in a thread.

session_start();
$page_title = 'read';
include ('header.html');



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
	$q = "select t.subject, t.body_t, t.value, u.name, p.message,p.post_id,p.parent_id from threads as t inner join posts as p using (thread_id) inner join users as u on p.user_id=u.user_id where t.thread_id =$tid order by p.post_id ";
	$q2 ="select t.subject, t.body_t, t.value from threads as t where thread_id=$tid ";
	$r = mysqli_query($dbc, $q);
	if (!(mysqli_num_rows($r) > 0)) {
		// condition only have body no posts
		$r = mysqli_query($dbc,$q2);
		$messages = mysqli_fetch_array($r, MYSQLI_ASSOC);
		include('body_t.php');

	}

} // End of isset($_GET['tid']) IF.

if ($tid) { // Get the messages in this thread...

	$printed = FALSE; // Flag variable.

	// Fetch each:
	while ($messages = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

		// Only need to print the subject once!
		if (!$printed) {
			include('body_t.php');
			$printed = TRUE;
		}

		// Print the message:
		echo "<div><p>{$messages['name']} \n</p><p>{$messages['message']} \n</p></div>";

		//check if can reply
		if (isset($_SESSION['user_id'])){

		//<a href="read_r.php?tid= '.$messages['post_id'].'">reply</a>
?>


<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Link with href
</a>

<div class="collapse" id="collapseExample">
<div class="well">

	<?php
		include('includes/post_form_r.php');
	}
?>

</div>
</div>

<?php
		//check parent_id
		if($messages['parent_id']!=0){
			echo"have child";
		}

	} // End of WHILE loop.

	// Show the form to post a message:

	include ('includes/post_form.php');


} else { // Invalid thread ID!
	echo '<p>This page has been accessed in error.</p>';
}

?>
<?php include ('includes/footer.html'); ?>
