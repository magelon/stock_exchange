<!DOCTYPE html>
<html>
<body>

<?php
if($dbc = @mysql_connect('localhost','root','1234')){
	print '<p>Successfully connect to MySQL!</p>';
	//try to creat database
	if(@mysql_query('CREATE DATABASE stockusers',$dbc)){
		print '<p>The database has been created!</p>';
	}else{
		//could not create database
		print '<p style="color: red;"> Could not create the database because:<br />'.mysql_error($bdc).'.</p>';
	//try to select the database
	if(@mysql_select_db('stockusers',$dbc)){
		print '<p>the database has been selected</p>';
	}else{
		print '<p style="color: red;">Could not select the database because:<br />'.
		mysql_error($dbc).'.</p>';
	}
	
	}
}
?>  

</body>
</html>