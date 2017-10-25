<?php 
include("../include/config.php");

$username = $_POST["user"];
$pass = $_POST["pass"];
$allow = "";

$query = "SELECT * FROM tbl_admin WHERE admin_username = '".$username."' ";
$result = mysqli_query($conn,$query) or die (mysqli_error($conn));
$return = array();		
		if ($row = mysqli_fetch_array($result)) {
			$query = "SELECT * FROM tbl_admin WHERE admin_username = '" .$username. "' AND admin_password = '".$pass."'";
			$result = mysqli_query($conn,$query) or die (mysqli_error($conn));
			if ($row = mysqli_fetch_array($result)) {
				$return[] = array(
				'admin_id' => $row[0],
				'admin_fname'=>$row[1],
				'admin_lname'=>$row[2],
				'admin_mname'=>$row[3],
				'allow'=>'yes'
				);
			}	
			else{
				//wrong password
				$return[] = array('allow'=>'maybe');
			}
		}
		else{
			$return[] = array(
				
				'allow'=>'no'
			);

			}
			
	echo json_encode($return);;
?>