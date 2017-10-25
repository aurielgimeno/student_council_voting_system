<?php 
include("../include/config.php");

$username = $_POST["user"];
$query = "SELECT * FROM tbl_show_student_course WHERE stud_id_num = '" .$username. "' ";
$result = mysqli_query($conn,$query) or die (mysqli_error($conn));
$return = array();
	if($row = mysqli_fetch_array($result))
	{
		$return[] = array(
				'stud_id' => $row[0],
				'stud_fname'=>$row[1],
				'stud_lname'=>$row[2],
				'stud_mname'=>$row[3],
				'stud_vote_status'=>$row[7],
				'stud_course_name'=>$row[10],
				'stud_sy'=>$row[11],
				'allow'=>'yes',
				);
	}
	else
	{
			$return[] = array(
				
				'allow'=>'no',
			);
	}
	echo json_encode($return);;
?>