


<?php # Script 11.2 - upload_image_t.php

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {



?>

<form enctype="multipart/form-data" action="upload_image.php" method="post">

	
	<div align="center"><input type="submit" name="submit" value="Submit" /></div>

</form>

<?php include ('includes/footer.html'); ?>
