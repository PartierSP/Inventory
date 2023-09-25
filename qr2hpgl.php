<?php

function pagetest(){
	//Initialize Plotter
//	echo('IN;IP;RO90;VS;PU;SP2;');
	//Draw border and two vertical lines using pen 2
	echo('SP3;');
	for($i=1;$i<5;$i++){
		for($ii=0;$ii<2;$ii++){
			$xpos=$ii*4000+($ii*170)+64;
			$ypos=$i*2032-712;
			echo('PA'.$xpos.','.$ypos.';EA'.($xpos+4000).','.($ypos+2032).';');
		}
	}
	//Put pen away and eject plot
	echo('PU;SP0;PG;');
}

function pltsmlabel($link, $text, $xpos, $ypos){
	//Initialize Plotter
	echo('IN;IP;RO90;VS;PU;');
	//Draw border and two vertical lines using pen 2
	echo('SP2;PA'.$xpos.','.$ypos.';EA'.($xpos+1270).','.($ypos+560).';PA'.($xpos+1110).','.($ypos+560).';PD'.($xpos+1110).','.$ypos.';PU'.($xpos+160).','.($ypos+560).';PD'.($xpos+160).','.$ypos.';PU;');
	//Draw text label
	echo('PA'.($xpos+800).','.($ypos+180).';TD0;DT~;SD1,21,2,1,4,12,5,0,6,3,7,51;SS;LB'.$text.'~;');
	//Position for QR code and select pen 1
	echo('PU'.($xpos+200).','.$ypos.';SP1;');
	qr2hpgl($link,13.5,($xpos+200)/40,($ypos+10)/40,0.7);
	//Put pen away and end plot
	echo('PU;SP0;PG;');
}

function pltlglabel($link, $text, $col, $row){

	//Calc label starting position
	$xpos=$col*4000+($col*170)+64;
	$ypos=$row*2032-712;

	//Initialize Plotter
	echo('IN;IP;RO90;VS;PU;SP1;');

	//Position for QR code print code
	echo('PA'.($xpos+380).','.($ypos+380).';');
	qr2hpgl($link,31.5,($xpos+380)/40,($ypos+380)/40,0.7);
	
	//Draw text
	echo('SP2;PA'.($xpos+2100).','.($ypos+1500).';TD0;DT~;SD1,21,2,1,4,12,5,0,6,3,7,51;SS;LB'.$text.'~;');

	//Put pen away and eject plot
	//echo('PU;SP0;PG;');
	pagetest();
}

function qr2hpgl($text,$qrsize,$xpos,$ypos,$pensize){
	//$text = Data the QR code is to contain
	//$qrsize = Desired QR code size in millimeters
	//$xpos = X starting position in millimeters
	//$ypos = Y starting position in millimeters
	//$pensize = Pen width in millimeters

	//Use 'qrencode' to generate the code
	exec('qrencode -t ascii "'.$text.'"',$out);

	//Convert each line into sub arrays
	foreach($out as $t){
		$qr[]=str_split($t);
	}

	//X-Y zero is located at lower left of page.  Reverse QR array so draws upside right.
	$qr=array_reverse($qr);

	//Calculate scale, fill, and shift factors.
	$size=sizeof($qr);
	$yscale=$qrsize*40/$size;
	$xscale=$yscale/2;
	$linerepeat=1+(int)(2*$yscale/(40*$pensize));	//Pen widths are exagerated.  So double result with 2*...
	$xshift=$pensize*40/8;						//X shift amount to account for pen width overlaping white space
	$xoffset=$xpos*40;
	$yoffset=$ypos*40;

	//Initialize plotter
	echo('PU');

	//Scan each row of the QR code and draw horizantal lines where needed
	$row=0;
	$colmax=0;
	foreach($qr as $line){
		//Repeat each row with pen width offsets to fill in better
		$i=0;
		while($i<$linerepeat){
			//Scan each column to see if pen needs to be up or down
			$last=false;
			$col=0;
			foreach($line as $cell){
				if($cell=='#'){
					if($last==false){
						//Start of new filled in section
						echo((int)($xscale*$col+$xoffset+$xshift).','.(int)($yscale*($row+($i/$linerepeat))+$yoffset).';PD');
					}
					$last=true;
				}else{
					if($last==true){
						echo((int)($xscale*$col+$xoffset-$xshift).','.(int)($yscale*($row+($i/$linerepeat))+$yoffset).';PU');
						$last=false;
					}
				}
				$col++;
			}
			if($last==true){
				echo((int)($xscale*$col+$xoffset-$xshift).','.(int)($yscale*($row+($i/$linerepeat))+$yoffset).';PU');
				$last=false;
			}
			if($col>$colmax){
				$colmax=$col;
			}
			$i++;
		}
		$row++;
	}
	echo(';');
}

?>
