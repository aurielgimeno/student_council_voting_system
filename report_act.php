<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
// mysql connection 
$con = mysqli_connect("localhost","root","","db_gc_sc_vs"); 
  if(!$con) 
      { 
      die(mysqli_error()); 
      } 
     
// get data from users table 

$query = "SELECT * from tbl_count_votes where position_name = 'ACT Representatives' ORDER BY votes DESC";//query to select top 10
$result = mysqli_query($con,$query) or die (mysqli_error($con)); 
// create new PDF document
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '<h1>Tally of Votes(ACT Representatives)</h1>
<table border="1"  cellpadding="2">
<thead>
	<tr bgcolor="#d2d2cd">
		<th  align="center">Student ID</th>
		<th  align="center">First Name</th>
		<th  align="center">Last Name</th>	
		<th  align="center">Year</th>	
		<th  align="center">Course</th>
		<th  align="center">Votes</th>
	</tr>
</thead>';



	while($row = mysqli_fetch_array($result))
	{
	   $return = array(
		  'stud_id' => $row[0],
		  'stud_fname' => $row[1],
		  'stud_lname' => $row[2],
		  'stud_mname' => $row[3],
		  'stud_year' => $row[4],
		  'stud_course' => $row[5],
		  'stud_votes' => $row[7]
	   ); 
	   
	   $html .='<tbody><tr>
				<td>'.$return['stud_id'].'</td>
				<td>'.$return['stud_fname'].'</td>
				<td>'.$return['stud_lname'].'</td>
				<td>'.$return['stud_year'].'</td>
				<td>'.$return['stud_course'].'</td>
				<td>'.$return['stud_votes'].'</td>
				
				
			</tr></tbody>';
	}	
$html .='</table>';	
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
