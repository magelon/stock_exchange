<?php
// Start defining the URL...
// URL is http:// plus the host name plus the current directory:
$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

// Remove any trailing slashes:
$url = rtrim($url, '/\\');



if(isset($messages1['user_id'])){
  $q="select picture from users where user_id={$messages1['user_id']}";

  $r=mysqli_query($dbc,$q);

  $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

$url .= '/' .$page.'?'.'image='.$row['picture'];
}else{
  $url.='/'.'uploads/umaru00.png';
}
?>
