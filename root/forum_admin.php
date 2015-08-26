<?php # Script 17.4 - forum.php
// This page shows the threads in a forum.
// Include the header:
$page_title = 'threads_admin';
include ('header.html');

// The query for retrieving all the threads in this forum, along with the original user,
// when the thread was first posted, when it was last replied to, and how many replies it's had:
$q = "SELECT thread_id, subject FROM threads order by thread_id ";
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

//print the thread link and edit link
		echo '<tr>
				<td align="left"><a href="read.php?tid=' . $row['thread_id'] . '">' . $row['subject'] . '</a></td>
				<td align="left"> <a href="read_edit.php?tid='. $row['thread_id'] .'">Edit</a></td>
					<td align="left"> <a href="delete_thread.php?tid='. $row['thread_id'] .'">Delete</a></td>
				</tr>
				';
		}

	echo '</table>'; // Complete the table.

} else {
	echo '<p>There are currently no messages in this forum.</p>';
}


?>
