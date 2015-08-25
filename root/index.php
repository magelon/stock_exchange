<?php

session_start();
// Start the session.

// Include the header:
$page_title = 'index';

include ('header.html');

// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

?>
<?php
include('get_img.php');
?>


<br>
<div>
<?php include ('forum.php' ); ?>
</div>
<hr>



<?php include ('includes/footer.html'); ?>
