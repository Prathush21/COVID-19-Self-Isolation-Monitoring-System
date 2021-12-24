
<?php

require('fpdf/fpdf.php');
require_once 'classes/db.php';
session_start();


class PDF extends FPDF {

	// Page header
	function Header() {
		
		// Add logo to page
		//$this->Image('gfg1.png',10,8,33);
		
		// Set font family to Arial bold
		$this->SetFont('Arial','B',20);
		
		// Move to the right
		$this->Cell(80);
		
		// Header
		$this->Cell(50,10,'Self-Quarantine Report',2,0,'C');
		
		// Line break
		$this->Ln(20);
	}

	// Page footer
	function Footer() {
		
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		
		// Page number
		$this->Cell(0,10,'Page ' .
			$this->PageNo() . '/{nb}',0,0,'C');
	}
}


$uname = $_SESSION['username'];
$db=Db::getInstance();
$patient_details=$db->getCommon('patient','username',$uname);
$patient_no=$patient_details['patient_no'];
$patient_name=$patient_details['patient_name'];
$nic=$patient_details['NIC'];
$dob=$patient_details['DOB'];
$gender=$patient_details['gender'];
$today=date('Y-m-d');
//$age=$today-$dob;
$diff = date_diff(date_create($dob), date_create($today));
$age=$diff->format('%y');

$record_no=$_SESSION['record'] ;
$record_details=$db->getCommon('patient_record','patient_record_no',$record_no);
$reason=$record_details['reason'];
$start=$record_details['start_date'];
$end=$record_details['end_date'];
$doc_no=$record_details['assigned_doctor_no'];

$doctor_details=$db->getCommon('doctor','doctor_no',$doc_no);
$doc_name=$doctor_details['doctor_name'];


// Instantiation of FPDF class
$pdf = new PDF();

// Define alias for number of pages
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',14);

// for($i = 1; $i <= 30; $i++)
// 	$pdf->Cell(0, 10, 'line number '
// 			. $i, 0, 1);
$pdf->SetFont('Times','B',18);
$pdf->Cell(0,20,'Patient Details',0,1);
$pdf->SetFont('Times','',14);
$pdf->Cell(0,10,'Patient Name:-'.$patient_name,0,1);
$pdf->Cell(0,10,'Patient NIC number:-'.$nic,0,1);
$pdf->Cell(0,10,'Patient age:-'.$age,0,1);
$pdf->Cell(0,10,'Patient gender:-'.$gender,0,1);
$pdf->SetFont('Times','B',18);
$pdf->Cell(0,20,'Quarantine Record Details',0,1);
$pdf->SetFont('Times','',14);
$pdf->Cell(0,10,'Reason for self quarantine:-'.$reason,0,1);
$pdf->Cell(0,10,'Period of self quarantine:-'.$start .' -> ' .$end,0,1);
$pdf->Cell(0,10,'Assigned Doctor Name:-'.$doc_name,0,1);
$pdf->Output();

?>
