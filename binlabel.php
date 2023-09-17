<?php
	include('inc_header.php');
	include('fpdfe.php');		//FPDF - PHP PDF Generator ver XXX (http://)
	
	$s=gRequest('s',0);
	$l=gRequest('l',0);
	$b=gRequest('b',0);
	
	class myPDF extends PDFe{
	
	}
	
	$mypdf=new myPDF();
	$mypdf->AddPage('L','Letter');
	Switch ($s){
		case 0:
			//Size Small
			$mypdf->Image('http://127.0.0.1/i/genqrc.php?d=0&l='.$l.'&b='.$b,7,1,11,11,'PNG');
			$mypdf->RoundedRect(0,0,32,13,2);
			$mypdf->Line(6,0,6,13);
			$mypdf->Line(26,0,26,13);
			$mypdf->SetFont('Arial','B',14);
			$mypdf->SetXY(18,1);
			$mypdf->Cell(7,11,$b,'C');
			break;
		case 1:
			//Size Medium
			$mypdf->Image('http://127.0.0.1/i/genqrc.php?d=0&l='.$l.'&b='.$b,7,1,20,20,'PNG');
			$mypdf->RoundedRect(0,0,60,40,2);
			$mypdf->SetFont('Arial','B',14);
			$mypdf->SetXY(18,1);
			$mypdf->Cell(7,11,$b,'C');
			break;
	}
	$mypdf->Output();
?>
