<?php # Script 17.4 - forum.php
// This page shows the threads in a forum.
// Include the header:
$page_title = 'threads_admin';
include ('header.html');

if($_SESSION['role']!='admin'){
	require ('includes/login_function.php');
	redirect_user();
}


	if($_SESSION['role']=='admin'){
//Number of records
$dispaly = 10;
//Determine how many pages there are...
if(isset($_GET['p'])&& is_numeric($_GET['p'])){
//Already been dtermined.
$pages=$_GET['p'];
}else{
//Need to determine.
$q="select count(thread_id) as count_t from threads";

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

// The query for retrieving all the threads in this forum, along with the original user,
// when the thread was first posted, when it was last replied to, and how many replies it's had:
$q = "SELECT thread_id, subject FROM threads order by thread_id limit $start,$dispaly";
$r = mysqli_query($dbc, $q);

if (mysqli_num_rows($r) > 0) {

	// Create a table:
	echo '<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
		<tr>
			<td align="left" width="50%"><em>subject</em>:</td>
			<td align="left"><em>editer</em>:</td>

		</tr>';

	// Fetch each thread:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

//print the thread link and edit link
		echo '<tr>
				<td align="left"><a href="read.php?tid=' . $row['thread_id'] . '">' . $row['subject'] . '</a></td>
				<td align="left"> <a href="read_edit.php?tid='. $row['thread_id'] .'">Edit</a></td>
					<td align="left"> <a href="delete_thread.php?tid='. $row['thread_id'] .'">Delete</a></td>
				</tr>
				';
		}

	echo '</table>'; // Complete the table.

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
  echo'<li><a href="forum_admin.php?s='.($start-$dispaly).'&p='.$pages.'">Previous</a></li>';
  }
  //Make all the numbered pages:
  for ($i=1;$i<=$pages;$i++){

  if($i!=$current_page){
  echo '<li><a href="forum_admin.php?s='.(($dispaly*($i-1))).'&p='.$pages.'">'.$i.'</a></li>';
  }else{
  echo '<li class="active"><a >'.$i.'</a>'.'</li>';
  }
  }//End of FOR loop.

 	 //If it's not the last page, make a Next button
 	 if($current_page!=$pages){
 	 echo '<li><a href="forum_admin.php?s='.($start+$dispaly).'&p='.$pages.'">Next</a></li>';
 	 }
 	 echo '
 	 <ul>
 	 <nav>';
 	 //Close the paragraph.
  }//End of links section.

} else {
	echo '<p>There are currently no messages in this forum.</p>';
}

}
?>

<hr>
<?php include ('includes/footer.html'); ?>
