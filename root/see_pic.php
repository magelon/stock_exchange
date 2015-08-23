
<?php
// Start defining the URL...
// URL is http:// plus the host name plus the current directory:
$url_t = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

// Remove any trailing slashes:
$url_t = rtrim($url_t, '/\\');

// Add the page:
$page='show_image.php';

$url_t .= '/' .$page.'?'.'image='.$image_name;

echo"<img id=\"t_img\" src=\" $url_t \" HEIGHT=\"60\" WIDTH=\"100\" BORDER=\"0\">";

?>
