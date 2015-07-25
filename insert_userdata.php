<!DOCTYPE html>
<html>
<body>

<?php
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
		$query = "INSERT INTO users (user_id,email,password,reg_date) VALUES (0,'$email','$password',NOW())";
		//Execute the query:
		if(@mysql_query($query,$dbc)){
			print '<p style="color:red;">Could not add user because:<br />'.mysql_error($dbc).'.</p><p>The query being run was:'.$query.'</p>';
		}
	}//No problem!
	mysql_close($dbc);//close the connection.
}//end of form submission if
//Dispaly the form:

?>

<form action="insert_userdata.php" method="post">

email:<br>
<input type="text" name="email">
password:<br>
<input type="password" name="password">
<br>
<input type="submit" value="Submit">
</form>



</body>
</html>
