<?php # Script 12.13 - loggedin.php #3
// The user is redirected here from login.php.

require('session.php');

// Set the page title and include the HTML header:
$page_title = 'Logged In!';
include ('header.html');

// Print a customized message:
echo "<h1>Logged In!</h1>
<p>You are now logged in, {$_SESSION['name']}!</p>
<p><a href=\"logout.php\">Logout</a></p>";

include ('includes/footer.html');
?>
