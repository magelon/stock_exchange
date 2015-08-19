<?php
// Start defining the URL...
// URL is http:// plus the host name plus the current directory:
$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

// Remove any trailing slashes:
$url = rtrim($url, '/\\');

// Add the page:
$page='show_image.php';

if(isset($tid)){
  //query of threads picture
  $qtp="select picture_t from threads where thread_id=$tid";

  $rtp=mysqli_query($dbc,$qtp);

  $row_tp = mysqli_fetch_array($rtp, MYSQLI_ASSOC);

$url .= '/' .$page.'?'.'image='.$row_tp['picture_t'];
}else{
  $url.='/'.'uploads/umaru00.png';
}
?>
