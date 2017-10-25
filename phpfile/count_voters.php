<?php 
include("../include/config.php");

	$query1 = "SELECT * from tbl_show_student_course";
	$result1 = mysqli_query($conn,$query1) or die (mysqli_error($conn));
	$total_voters = mysqli_num_rows($result1);
	
	$query2 = "SELECT * from tbl_show_student_course WHERE stud_vote_status = 1";
	$result2 = mysqli_query($conn,$query2) or die (mysqli_error($conn));
	$voted = mysqli_num_rows($result2);
	
	$query3 = "SELECT * from tbl_show_student_course WHERE stud_vote_status = 0";
	$result3 = mysqli_query($conn,$query3) or die (mysqli_error($conn));
	$pending = mysqli_num_rows($result3);

	
	$return[] = array(
		  'total_voters' => $total_voters,
		  'voted' => $voted,
		  'pending' => $pending
	   );
	   
	echo json_encode($return);
?>