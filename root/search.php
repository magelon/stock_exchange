<?php # Script 17.8 - search.php
// This page displays and handles a search form.

// Include the HTML header:
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

include ('header2.html');
	// Clean the terms:
	$terms = mysqli_real_escape_string($dbc, htmlentities(strip_tags($_GET['terms'])));

	// Run the query...
	$q = "SELECT * FROM threads WHERE subject LIKE '%$terms%'";
	$r = mysqli_query($dbc, $q);
	if (mysqli_num_rows($r) > 0) {
		echo '<h2>Search Results</h2>';
	} else {
		echo '<p>No results found.</p>';
	}

}


?>
