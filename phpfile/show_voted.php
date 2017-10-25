<?php
header("Content-Type: text/html; charset=UTF-8");
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'tbl_show_student_course';

// Table's primary key
$primaryKey = 'stud_id_num';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'stud_id_num', 'dt' => 0 ),
	array( 'db' => 'stud_lname',  'dt' => 1 ),
	array( 'db' => 'stud_fname',   'dt' => 2 ),
	array( 'db' => 'stud_mname',     'dt' => 3 ),
	array( 'db' => 'stud_year',     'dt' => 4 ),
	array( 'db' => 'course_name',     'dt' => 5 ),
	array( 'db' => 'school_year',     'dt' => 6 ),
	array( 'db' => 'stud_vote_status',     'dt' => 7 ),
	
);

// SQL server connection information
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'db_gc_sc_vs',
	'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );
$where ="stud_vote_status ='1'";
echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns,$where)
);


