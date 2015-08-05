<!DOCTYPE html>
<html>
<body>

<h1>mysql connection</h1>

<?php
if($dbc = mysql_connect('localhost','root','1234')){
print '<p>Successfully connected to MySql!</p>';
mysql_close($dbc);
}else{
	print '<p style="color: red;">Could not connect to MySql.</p>';
	
}

?>

</body>
</html>