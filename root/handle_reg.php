<!DOCTYPE html>
<html>
<head>
<meta />
<title>php script handle register html</title>
<style type="text/css" media="screen"> .error{color:red;}</style>
</head>
<body>
<h1>Register result</h1>
<?php//handle_reg.php/*receives values from regist thml
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