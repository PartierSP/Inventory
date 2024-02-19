<?php
	include('inc_header.php');
	include('qr2hpgl.php');
	
	$size=gRequest('s',0);
	$location=gRequest('l',0);
	$bin=gRequest('b',0);
	$row=gRequest('row',0);
	$col=gRequest('col',0);
	
	if ($row==0){
		//Need to select which label to print on.
		$smarty->assign('s', $size);
		$smarty->assign('l', $location);
		$smarty->assign('b', $bin);
		$smarty->display('pltlabel.tpl');
	} else {
		//We know what we're doing so lets go!
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
		
		Switch($size){
			case 0:
				//Size Large
				pltlglabel($serveraddress.'binview.php?l='.$location.'&b='.$bin, $bin, $loc, $details, $col-1, 5-$row);
				break;
			case 1:
				//Size Small
				pltsmlabel($serveraddress.'binview.php?l='.$location.'&b='.$bin, $bin, 200, 0);
				break;
			case 2:
				//Size Tiny
				plttnylabel($serveraddress.'binview.php?l='.$location.'&b='.$bin, $bin, 200,0);
				break;
		}
	}
?>
