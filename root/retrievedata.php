<!DOCTYPE html>
<html>
<body>

<?php
//connect and select:
$dbc=mysql_connect('localhost','username','password');
mysql_select_db('myblog',$dbc);

//Define the query:
$query = 'SELECT * FROM entries ORDER BY date_entered DESC';
if ($r=mysql_query($query,$dbc)){
	//Run the query
	//Retreve and print every record:
	while($row = mysql_fetch_array($r)){
		print"<p><h3>{$row['title']}</h3>
			{$row['entry']}<br />
			<a href=\"edit">
			<a href=\"delet">
			</p><hr />\n";
	}
}else{
	//Query didn't run
	print '<p style="color: red;">Could not retrieve the data because:<br />'.mysql_error($dbc).'.</p><p>The query being run was:'.$query.'</p>';
}//End of query IF
mysql_close($dbc);//Close the connection.
?>  

</body>
</html>