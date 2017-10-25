<?php
	include("../include/config.php");
	$studID		= $_POST["stud_id"];
	$studFname	= $_POST["stud_fname"];
	$studLname	= $_POST["stud_lname"];
	$studMname	= $_POST["stud_mname"];
	$studYear	= $_POST["stud_year"];
	$studCourse	= $_POST["stud_course"];
	$studSY		= $_POST["stud_sy"];
	$return = array();	
	$query = "INSERT INTO tbl_student(stud_id_num,stud_fname,stud_lname,stud_mname,stud_year,stud_vote_status,course_id,sy_id) VALUES('".$studID."','".$studFname."','".$studLname."','".$studMname."','".$studYear."','0','".$studCourse."','".$studSY."')";
	$result = mysqli_query($conn,$query) or die (mysqli_error($conn));

	if($result){
		$return[] = array(
		  'message' => 'success',
	   );
		
	}else{
		$return[] = array(
		  'message' => 'error',
	   );
	}
		echo json_encode($return);
?>	