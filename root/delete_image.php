<?php # Script 17.5 - delete_image.php
// This page shows the messages in a thread.

$page_title = 'delete_posts';

//need header.html
include ('header.html');


$pid = FALSE;

// Check for a thread ID...
if (isset($_GET['imgid'])) {

	$dir = '../uploads'; // Define the directory to view.

	$files = scandir($dir); // Read all the images into an array.

	// Display each image caption as a link to the JavaScript function:
	foreach ($files as $image) {

		if (substr($image, 0, 1) != '.') {
			// Ignore anything starting with a period.

	// Create a shorthand version of the thread ID:
	$filename=$_GET['imgid'];
	if($image==$filename){
		$url_d=$dir.'/'.$image;
		unlink($url_d);
		echo'pic deleted';
	}
}
}
require ('includes/login_function.php');
redirect_user($page='images_admin.php');
}
