<?php # Script 17.5 - read.php
// This page shows the messages in a thread.

//start session read session information

session_start();

$page_title = 'read';

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
	$q = "select t.subject, t.body_t, t.value, u.name, p.message,p.post_id
	from threads as t
	inner join posts as p using (thread_id)
	inner join users as u on p.user_id=u.user_id
	where t.thread_id =$tid
	order by p.post_id asc
	";

	$q2 ="select t.subject, t.body_t, t.value
	from threads as t
	where thread_id=$tid
	";

$q4="create or replace view repview as
select p.message, u.name,u.user_id,p.post_id,p.parent_id
from threads as t
inner join posts as p using(thread_id)
inner join users as u on p.user_id=u.user_id
where t.thread_id=$tid
	";

$q5="create or replace view reppview as
select a.message,a.name,a.user_id,a.parent_id
from repview as a
inner join posts as b on a.parent_id=b.post_id
	";

$q7="
select name,user_id,message,post_id
from repview where parent_id=0
";

	//execute the query

	$r = mysqli_query($dbc, $q);
	if (!(mysqli_num_rows($r) > 0)) {
		// condition only have body no posts
		$r = mysqli_query($dbc,$q2);
		$messages = mysqli_fetch_array($r, MYSQLI_ASSOC);
		include('get_img_t.php');
		include('body_t.php');

	}

} // End of isset($_GET['tid']) IF.

if ($tid) { // Get the messages in this thread...

	$printed = FALSE; // Flag variable.
	mysqli_query($dbc,$q4);
	mysqli_query($dbc,$q5);
	$r7=mysqli_query($dbc,$q7);
	// Fetch each:
	while ($messages = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

		// Only need to print the subject once!

		if (!$printed) {
			include('get_img_t.php');
			include('body_t.php');

			$printed = TRUE;
		}

while($messages1=mysqli_fetch_array($r7,MYSQLI_ASSOC)){
		$postid =$messages1['post_id'];
		include('get_img_posts.php');
		$q6="
		select name,user_id,message
		from reppview where parent_id=$postid
			";

		$r3 = mysqli_query($dbc, $q6);





			echo "<div id=\"replys\">

			<p id=\"replys1\">	<img class=\"img-circle\" alt=\"Brand\" src=\" $url \" HEIGHT=\"30\" WIDTH=\"30\" BORDER=\"0\">
				{$messages1['name']} :{$messages1['message']}</p>

			";
							while ($messages2=mysqli_fetch_array($r3,MYSQLI_ASSOC)){

								include('get_img_reply.php');

								echo"
								<p>	<img class=\"img-circle\" alt=\"Brand\" src=\" $url \" HEIGHT=\"30\" WIDTH=\"30\" BORDER=\"0\">
									{$messages2['name']}:{$messages2['message']}</p>

								";
							}

			echo"	</div>";

		//check if can reply
		if (isset($_SESSION['user_id'])){

		//<a href="read_r.php?tid= '.$messages['post_id'].'">reply</a>
		$col_post_id=$messages1['post_id'];
?>

<?php
echo"
<a  data-toggle=\"collapse\" href=\"#$col_post_id\" aria-expanded=\"false\" aria-controls=\"$col_post_id\">
";
?>
  reply
</a>

<?php
echo"
<div class=\"collapse\" id=\"$col_post_id\">
";
?>

<div >

	<?php
		include('includes/post_form_r.php');
	}
?>

</div>
</div>

<?php

}

	} // End of WHILE loop.

	// Show the form to post a message:

	include ('includes/post_form.php');


} else { // Invalid thread ID!
	echo '<p>This page has been accessed in error.</p>';
}

?>
<?php include ('includes/footer.html'); ?>
