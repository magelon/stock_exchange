<?php
$page_title = 'images';
// Include the header:
include ('header.html');

?>


<p>Click on an image to view it in a separate window.</p>
<ul>
<?php # Script 11.4 - images.php
// This script lists the images in the uploads directory.

if (isset($_SESSION['user_id'])) {

$dir = '../uploads'; // Define the directory to view.

$files = scandir($dir); // Read all the images into an array.

// Display each image caption as a link to the JavaScript function:
foreach ($files as $image) {

	if (substr($image, 0, 1) != '.') {
		// Ignore anything starting with a period.


		// Get the image's size in pixels:
		$image_size = getimagesize ("$dir/$image");

		// Make the image's name URL-safe:
		$image_name = urlencode($image);

		include('see_pic.php');

echo "<a href=\"delete_image.php?imgid=$image_name\">delete</a>";
				// Print the information:
		echo "<li><a href=\"javascript:create_window('$image_name',$image_size[0],$image_size[1])\">$image</a></li>";

	} // End of the IF.

} // End of the foreach loop.

}else{
	echo'login to use this page';
}
?>
</ul>
<hr>
<?php include ('includes/footer.html'); ?>
