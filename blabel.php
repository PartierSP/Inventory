<?php
	include('inc_header.php');
	include('qr2hpgl.php');
	
	$lablesize=gRequest('s',0);
	$location=gRequest('l',0);
	$bin=gRequest('b',0);
	
	$sql='SELECT t1.`catid` AS `catid`, t2.`cat` AS `cat`, t3.`location` AS `loc`, t1.`location` AS `location`, t1.`bin` AS `bin` '
		.'FROM `item` AS t1 '
		.'LEFT JOIN `category` AS t2 ON t1.`catid`=t2.`catid` '
		.'LEFT JOIN `location` AS t3 ON t1.`location`=t3.`locid` '
		.'WHERE t1.`location`='.$location.' AND t1.`bin`='.$bin.' '
		.'GROUP BY t1.`catid`';
	$categories=$dl->sql($sql);
	
	foreach($categories as $cat){
		$details.=$cat['cat']."\r\n";
	}
	$loc=$categories[0]['loc'];
	
	$bintxt='Bin:  '.$bin;
	
	//pagetest();
	//pltsmlabel($serveraddress.'binview.php?l='.$location.'&b='.$bin, $bin, 200, 0);
	pltlglabel($serveraddress.'binview.php?l='.$location.'&b='.$bin, $bintxt, $loc, $details, 0, 4);
?>
