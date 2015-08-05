<!DOCTYPE html>
<html>
<head>
<meta />
<title>php script handle login html</title>
<style type="text/css" media="screen"> .error{color:red;}</style>
</head>
<body>
<h1>Register result</h1>

if($_SERVER['REQUEST_METHOD']=='POST'){
	//Handel the form
	//Connect and select
	$dbc =mysql_connect('localhost','root','1234');
	mysql_select_db('stockusers',$dbc);
	//Validate the form data:
	$problem = FALSE;
	if(!empty($_POST['email']) && !empty($_POST['password'])){
		//remove space in both side string
		$email=trim(strip_tags($_POST['email']));
		$password=trim(strip_tags($_POST['password']));
	}else{
		print '<p style="color:red;">Please submit both email and password</p>';
		$problem=TRUE;
	}
	if(!$problem){
		//Define the query:
		$pass='';
		$query = "SELECT password from users WHERE email='$email' LIMIT 1 ";
		//Execute the query:
		if(!$){
			print '<p style="color:red;">Could not add user because:<br />'.mysql_error($dbc).'.</p><p>The query being run was:'.$query.'</p>';
		}
	}//No problem!
	mysql_close($dbc);//close the connection.
}//end of form submission if



<?php//handle_login.php/*receives values from login html
//flag variable to track success:
$okay=TRUE;
//validate the email address:
if(empty($_POST['email'])){
	print '<p class="error">please enter email</p>';
	$okay=FALSE;
}//validate the password:
if(empty($_POST['password'])){
	print '<p class="error">Please enter your password.</p>';
	$oaky=FALSE;
}
//validate the password:

//if there were no error, print a success message:
if($okay){
	print'<p>you have been sccessfully registered .</p>';
}



?>

</body>
</html>
