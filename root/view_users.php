<?php # Script 9.6 - view_users.php #2
// This script retrieves all the records from the users table.

require('session.php');

$page_title = 'View the Current Users';
include ('header.html');

// Page header:
echo '<h1>Registered Users</h1>';

if($_SESSION['role']!='admin'){

	echo'<p>forbidden</p>';
	require ('includes/login_function.php');
	redirect_user();
}


// Make the query:
$q = "SELECT  name,balance, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr FROM users ORDER BY registration_date ASC";
$r = @mysqli_query ($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	echo "<p>There are currently $num registered users.</p>\n";

	// Table header.
	echo '<table align="center" cellspacing="8" cellpadding="4" width="75%">
	<tr>
	<td align="left"><b>Name</b></td>
	<td><td align="left"><b>Balance</b></td>
	<td align="left"><b>Date Registered</b></td>
	</tr>
';

	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo ' <table align="center" cellspacing="8" cellpadding="1" width="75%">
		<tr>
		<td align="left">' . $row['name'] .'</td>
		<td >' . $row['balance'] . '</td>
		<td align="right">' . $row['dr'] . '</td>
		 </tr>
		';
	}

	echo '</table>'; // Close the table.

	mysqli_free_result ($r); // Free up the resources.

} else { // If no records were returned.

	echo '<p class="error">There are currently no registered users.</p>';

}

mysqli_close($dbc); // Close the database connection.

include ('includes/footer.html');
?>