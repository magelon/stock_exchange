<?php # Script 17.4 - forum.php
// This page shows the threads in a forum.

// Retrieve all the messages in this forum...
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
$q = "SELECT t.thread_id,t.subject, name FROM threads AS t left join users  on users.user_id= t.user_id order by t.value limit $start,$dispaly";
$r = mysqli_query($dbc, $q);

if (mysqli_num_rows($r) > 0) {

	// Create a table:
	echo '<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
		<tr>
			<td align="left" width="50%"><em>subject</em>:</td>
			<td align="left"><em>replys</em>:<td>
			<td align="left">editer:</td>
		</tr>';

	// Fetch each thread:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

		$q_replys="select t.thread_id, count(p.post_id) as replys from threads as t inner join posts as p on p.thread_id=t.thread_id where p.thread_id={$row['thread_id']}";
		$r_replys=mysqli_query($dbc, $q_replys);

		$row2=mysqli_fetch_array($r_replys,MYSQLI_ASSOC);

		echo '<tr>
				<td align="left" width="50%"><a href="read.php?tid=' . $row['thread_id'] . '">' . $row['subject'] . '</a></td>
				<td align="left">'.$row2['replys'].'</td>
				<td align="left"> '.$row['name'].'</td>
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
 echo'<li><a href="index.php?s='.($start-$dispaly).'&p='.$pages.'">Previous</a></li>';
 }
 //Make all the numbered pages:
 for ($i=1;$i<=$pages;$i++){

 if($i!=$current_page){
 echo '<li><a href="index.php?s='.(($dispaly*($i-1))).'&p='.$pages.'">'.$i.'</a></li>';
 }else{
 echo '<li class="active"><a >'.$i.'</a>'.'</li>';
 }
 }//End of FOR loop.

	 //If it's not the last page, make a Next button
	 if($current_page!=$pages){
	 echo '<li><a href="index.php?s='.($start+$dispaly).'&p='.$pages.'">Next</a></li>';
	 }
	 echo '
	 <ul>
	 <nav>';
	 //Close the paragraph.
 }//End of links section.



} else {
	echo '<p>There are currently no messages in this forum.</p>';
}


?>
