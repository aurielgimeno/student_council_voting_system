<?php 
include("../include/config.php");
$selected_course = $_POST["selected_course"];
if($selected_course == "ACT"){
	$position_id = 5;
}else if($selected_course == "BSCS"){
	$position_id = 6;
}else if($selected_course == "BSIT"){
	$position_id = 7;
}
$query = "SELECT * from tbl_show_candidate WHERE position_id = $position_id ORDER BY stud_lname ASC";//query to select top 10
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
		  'stud_position_name' => $row[9],
		  
	   );
	}
	
	echo json_encode($return);
?>
