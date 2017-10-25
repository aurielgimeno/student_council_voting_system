<?php 
include("../include/config.php");
$stud_id = $_POST["studID"];
$position = $_POST["position"];
$stmt = $conn->prepare("INSERT INTO tbl_candidate (stud_id_num,candidate_position) VALUES (?,?)");
$stmt->bind_param("is", $studID,$posit);


$studID = $stud_id;
$posit = $position;
$stmt->execute();
 $return[] = array(
		  'stud' => $studID,
	   );
	echo json_encode($return);
?>