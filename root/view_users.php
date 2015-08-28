<?php # Script 9.6 - view_users.php #2
// This script retrieves all the records from the users table.

require('session.php');

$page_title = 'View the Current Users';
include ('header.html');

// Page header:
echo '<h1>Registered Users</h1>';

if($_SESSION['role']!='admin'){
	require ('includes/login_function.php');
	redirect_user();
}

//Number of records
$dispaly = 10;
//Determine how many pages there are...
if(isset($_GET['p'])&& is_numeric($_GET['p'])){
//Already been dtermined.
$pages=$_GET['p'];
}else{
//Need to determine.
$q="select count(user_id) as count_t from users";

$r= mysqli_query($dbc, $q);

$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

$records=$row['count_t'];
//Calculate the number of pages...
if($records>$dispaly){
//More than 1 page.
$pages=ceil($records/$dispaly);
}else{
$pages=1;
}

}//End of p IF

//Determine where is the database to start returning results...
if(isset($_GET['s'])&& is_numeric($_GET['s'])){
$start=$_GET['s'];
}else{
$start=0;
}
//Define the query:

// Make the query:
$q = "SELECT  name,balance, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr FROM users ORDER BY registration_date ASC limit $start,$dispaly";
$r = @mysqli_query ($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	echo "<p>There are currently $num registered users.</p>\n";

	// Table header.
	echo '<table align="center" cellspacing="8" cellpadding="4" width="75%">
	<tr>
	<td align="left"><b>Name</b></td>
	<td align="left"><b>Balance</b></td>
	<td align="left"><b>Date Registered</b></td>
	</tr>
';

	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo ' <table align="center" cellspacing="8" cellpadding="4" width="75%">
		<tr>
		<td align="left">' . $row['name'] .'</td>
		<td align="left">' . $row['balance'] . '</td>
		<td align="left">' . $row['dr'] . '</td>
		 </tr>
		';
	}

	echo '</table>'; // Close the table.

	//make the links to other pages,if necessary.
	if($pages>1){
	//Add some spacing and start a paragraph:

	echo'<br />
	<nav>
	<ul class="pagination">';
	//Determine what page the script is
	$current_page=($start/$dispaly)+1;
	//if it is not the first page, make a previous link:
	if($current_page !=1){
	echo'<li><a href="view_users.php?s='.($start-$dispaly).'&p='.$pages.'">Previous</a></li>';
	}
	//Make all the numbered pages:
	for ($i=1;$i<=$pages;$i++){

	if($i!=$current_page){
	echo '<li><a href="view_users.php?s='.(($dispaly*($i-1))).'&p='.$pages.'">'.$i.'</a></li>';
	}else{
	echo '<li class="active"><a >'.$i.'</a>'.'</li>';
	}
	}//End of FOR loop.

	 //If it's not the last page, make a Next button
	 if($current_page!=$pages){
	 echo '<li><a href="view_users.php?s='.($start+$dispaly).'&p='.$pages.'">Next</a></li>';
	 }
	 echo '
	 <ul>
	 <nav>';
	 //Close the paragraph.
	}//End of links section.
} else { // If no records were returned.

	echo '<p class="error">There are currently no registered users.</p>';

}

mysqli_close($dbc); // Close the database connection.

include ('includes/footer.html');
?>
