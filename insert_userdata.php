<!DOCTYPE html>
<html>
<body>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	//Handel the form
	//Connect and select
	$dbc =mysql_connect('localhost','root','1234');
	mysql_select_db('stockusers',$dbc);
}
?>  

</body>
</html>