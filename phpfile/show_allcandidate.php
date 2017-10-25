<?php 
include("../include/config.php");

	$query = "SELECT * from tbl_show_candidate";//query to select top 10
	$result = mysqli_query($conn,$query) or die (mysqli_error($conn));
	
	$return = array();
	while($row = mysqli_fetch_array($result))
	{
	   $return[] = array(
		  'stud_id' => $row[0],
		  'stud_fname' => $row[1],
		  'stud_lname' => $row[2],
		  'stud_mname' => $row[3],
		  'stud_year' => $row[4],
		  'stud_position' => $row[9],
		  
	   );
	}
	
	echo json_encode($return);
?>