<!DOCTYPE html>
<html>
<body>

<?php
//script delete entry.php
$dbc=mysql_connect('localhost','username','password');
mysql_select_db('myblog',$dbc);
if(isset($_GET['id'])&& is_numeric($_GET['id'])){
	//dispaly the entry in a form:
	//Define the query
	$query="SELECT titile,entry FROM entries WHERE entry_id={$_GET['id']}";
	if($r=mysql_query($query,$dbc)){
		//run the query
		$row = mysql_fetch_array($r);//Retrieve the information.
		//Make the form:
		print'<form action="deletedata.php" method="post">
		<p>Are you want to delecte this entry?</p><h3>'.$row['titile'].'</h3>'.$row['entry'].'<br />
		<input type="hidden" name="id" value="'.$_GET['id'].'"/>
		<input type="submit" value="Delete this Entry!" /></p>
		</form>';
	}else{
		//Couldn't get the information.
		print '<p style="color: red;">Could not retrieve the blog entry because:<br />'.
		mysql_error($dbc).'.</p><p> the query being run was:'.$query.'</p>';
	}
}elseif(isset($_POST['id']) && is_numeric($_POST['id'])){
	//Handle the form.
	//Defiene the query:
	$query="Delete FROM entries WHERE entry_id={$_POST['id']} LIMIT1";
	$r = mysql_query($query,$dbc);//execute the query.
	//Report on the result:
	if(mysql_affected_rows($dbc) == 1){
		print '<p>The blog entry has been deleted.</p>';
	}else{
		print '<p style="color: red;"> Could not delete the blog entry because:<br />'.
		mysql_error($dbc).'.</p><p>The query being run was：'.$query. '</p>';
	}
	
}else{
	//No id received.
	print '<p style="color: red;"> this page has been accessed in error.</p>';
}//end of main if.
mysql_close($dbc);//close the connection.

?>  

</body>
</html>