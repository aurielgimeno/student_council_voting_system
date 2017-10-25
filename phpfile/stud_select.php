<?php 
include("../include/config.php");

$query = "SELECT * from tbl_student";//query to select top 10
	$result = mysqli_query($conn,$query) or die (mysqli_error($conn));
	
	$return = array();
	while($row = mysqli_fetch_array($result))
	{
	   $return[] = array(
		  'stud_id' => $row[0],
	   );
	}
	
	echo json_encode($return);
?>