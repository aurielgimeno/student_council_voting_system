<?php 
include("../include/config.php");

$query = "SELECT * from tbl_count_votes WHERE position_name = 'BSIT Representatives' ORDER BY votes DESC";
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
		  'stud_course' => $row[5],
		  'stud_position' => $row[6],
		  'stud_votes' => $row[7]
	   );
	}
	
	echo json_encode($return);
?>