<?php
	include("../include/config.php");
		$stud_id = $_POST["stud_id"];
		$selected_course = $_POST["selected_course"];
		$pres_candidate_id = $_POST["pres_id"];
		$rep1 = $_POST["rep1"];
		$rep2 = $_POST["rep2"];
		$rep3 = $_POST["rep3"];
		$rep4 = $_POST["rep4"];
		
		$return = array();
		
		$query1 = "SELECT * FROM tbl_student WHERE stud_id_num = '" .$stud_id. "' ";
		$result = mysqli_query($conn,$query1) or die (mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		if($row[7] == "0"){
		
			$query="INSERT INTO tbl_votes(stud_id_num,candidate_id_num,vote) VALUES('".$stud_id."','".$pres_candidate_id."','1');";
			$query .="INSERT INTO tbl_votes(stud_id_num,candidate_id_num,vote) VALUES('".$stud_id."','".$rep1."','1');";
			$query .="INSERT INTO tbl_votes(stud_id_num,candidate_id_num,vote) VALUES('".$stud_id."','".$rep2."','1');";
			$query .="INSERT INTO tbl_votes(stud_id_num,candidate_id_num,vote) VALUES('".$stud_id."','".$rep3."','1');";
			$query .="INSERT INTO tbl_votes(stud_id_num,candidate_id_num,vote) VALUES('".$stud_id."','".$rep4."','1');";
			$query .="UPDATE tbl_student SET stud_vote_status = 1 WHERE stud_id_num ='" .$stud_id. "'"; //update status
		
			mysqli_multi_query($conn,$query) or die (mysqli_error($conn));		
				
			$return = array(
				'success' => 'true'
			);
			
		}else{
			$return = array(
				'success' => 'true'
			);
		}
			
	echo json_encode($return);
?>