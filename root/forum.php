<?php # Script 17.4 - forum.php
// This page shows the threads in a forum.


// Need the database connection:

// Retrieve all the messages in this forum...

// If the user is logged in and has chosen a time zone,
// use that to convert the dates and times:
//if (isset($_SESSION['user_tz'])) {
//	$first = "CONVERT_TZ(p.posted_on, 'UTC', '{$_SESSION['user_tz']}')";
//	$last = "CONVERT_TZ(p.posted_on, 'UTC', '{$_SESSION['user_tz']}')";
//} else {
//	$first = 'p.posted_on';
//	$last = 'p.posted_on';
//}

// The query for retrieving all the threads in this forum, along with the original user,
// when the thread was first posted, when it was last replied to, and how many replies it's had:
$q = "SELECT t.thread_id, t.subject,name FROM threads AS t left join users  on users.user_id= t.user_id order by t.thread_id ";
$r = mysqli_query($dbc, $q);

if (mysqli_num_rows($r) > 0) {

	// Create a table:
	echo '<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
		<tr>
			<td align="left" width="50%"><em>subject</em>:</td>
			<td align="left"><em>editer</em>:</td>

		</tr>';



	// Fetch each thread:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {


		echo '<tr>
				<td align="left"><a href="read.php?tid=' . $row['thread_id'] . '">' . $row['subject'] . '</a></td>
				<td align="left"> '.$row['name'].'</td>
				</tr>
				';
		}




	echo '</table>'; // Complete the table.

} else {
	echo '<p>There are currently no messages in this forum.</p>';
}


?>
