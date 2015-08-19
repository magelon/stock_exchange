<?php
//for tests
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

<img class="media-object" src="http://localhost/stock_exchange/root/show_image_admin.php?image=1133be9df7a920963c870bda6f887c139ebe_m.jpg" HEIGHT="40" WIDTH="40" BORDER="0" alt="...">

<div class="media">
	<div class="media-left">
		<a href="#">
			<img class="media-object" src="uploads/umr.png" alt="umaru">
		</a>
	</div>
	<div class="media-body">
		<h4 class="media-heading">Media heading</h4>
	</div>
<br>
<div>
<?php include ('forum.php' ); ?>
</div>
<hr>


</div>



<?php include ('includes/footer.html'); ?>
