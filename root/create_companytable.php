<!DOCTYPE html>
<html>
<body>

<?php
//create database selects databse create a table
//connect and select:
if($dbc = mysql_connect('localhost','root','1234')){
	//handle error if the database could not be selected;
	if(!@mysql_select_db('stockusers',$dbc)){
		print '<p style="color: red;">Could not select the databse because:<br />'.
		mysql_error($dbc).'.</p>';
		mysql_close($dbc);
		$dbc = FALSE;
	}
}else{
	//connection failure
	print '<p style="color: red;">Could not connect to MySql:<br />'.mysql_error().'.</p>';
}

if($dbc){
	//Define the query:
	$query ='CREATE TABLE company(
	company_id INT UNSIGNED NOT NULL
	AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	entry TEXT NOT NULL,
	data_entered DATETIME NOT NULL,
	UNIQUE (name)
	)';
	
	//Excute the query:
	if(@mysql_query($query,$dbc)){
		print '<p>The table has been created!</p>';
	}else{
		print '<p style="color:red;">Could not create the table because:<br />'.mysql_error($dbc).'.</p>
		<p>The query being run was:'.$query.'</p>';
	}
	mysql_close($dbc);//Close the connection.
}



?>  

</body>
</html>