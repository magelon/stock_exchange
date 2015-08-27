<?php
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
$q="select last_name,first_name as dr, user_id from
users order by date asc limit $start, $dispaly";
$r=@mysqli_query($dbc,$q);

//Table header:
echo'<table align="center" cellspacing="0" cellpadding="5" width="75%">';


//Fetch and print all the records..

while($row=mysqli_fetch_array($r,MYSQLI_ASSOC)){
echo' row';
}//END OF WHILE LOOP

echo'</table>';
mysqli_free_result($r);
mysqli_close($dbc);

//make the links to other pages,if necessary.
if($page>1){
//Add some spacing and start a paragraph:
echo'<br /><p>';
//Determine what page the script is
$current_page=($start/$dispaly)+1;
//if it is not the first page, make a previous link:
if($current_page !=1){
echo'<a href="view_users.php?s='.($start-$dispaly).'&p='.$pages.'">Previous</a>';
}
//Make all the numbered pages:
for ($i=1;$i<=$pages;$i++){
if($i!=$current_page){
echo '<a href="view_users.php?s='.(($dispaly*($i-1))).'&p='.$pages.'">'.$i.'</a>';
}else{
echo $i.' ';
}
}//End of FOR loop.

  //If it's not the last page, make a Next button:
  if($current_page!=$pages){
  echo '<a href="view_users.php?s='.($start+$dispaly).'&p='.$pages.'">Next</a>';
  }
  echo '</p>';
  //Close the paragraph.
}//End of links section.

include(footer);
?>









?>
