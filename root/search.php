<?php # Script 17.8 - search.php
// This page displays and handles a search form.

// need database connection
require ('../mysqli_connect.php');

// Show the search form:
echo '<form action="search.php" method="get" accept-charset="utf-8">
<p><em>search</em>: <input name="terms" type="text" size="30" maxlength="60" ';

// Check for existing value:
if (isset($_GET['terms'])) {
	echo 'value="' . htmlspecialchars($_GET['terms']) . '" ';
}

// Complete the form:
echo '/><input name="submit" type="submit"  /></p></form>';

if (isset($_GET['terms'])) { // Handle the form.
$page_title = 'search';
include ('header_sear.html');
	// Clean the terms:
	$terms = mysqli_real_escape_string($dbc, htmlentities(strip_tags($_GET['terms'])));

	// Run the query...
	$q = "SELECT * FROM threads WHERE subject LIKE '%$terms%'";
	$r = mysqli_query($dbc, $q);
	if (mysqli_num_rows($r) > 0) {
		// Create a table:
		echo '<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
			<tr>
				<td align="left" width="50%"><em>subject</em>:</td>

			</tr>';

		// Fetch each thread:
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

			echo '<tr>
					<td align="left"><a href="read.php?tid=' . $row['thread_id'] . '">' . $row['subject'] . '</a></td>




				</tr>';

		}

		echo '</table>'; // Complete the table.
	} else {
		echo '<p>No results found.</p>';
	}

}


?>
