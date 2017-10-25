<?php
	include("../include/config.php");
	$message ="";
	$start = $_POST["syStart"];
	$end = $_POST["syEnd"];

$query = "UPDATE tbl_school_year SET sy_start = '".$start."', sy_end = '".$end."' where sy_id = '1'";
$result = mysqli_query($conn,$query) or die (mysqli_error($conn));

if($result){
	$message = "success";
	
}else{
	$message = "error";
}
	echo json_encode(array("umessage"=>$message));
?>	