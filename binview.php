<?php
include 'inc_header.php';

$loc=gRequest('loc',0);
$bin=gRequest('bin',0);

$sql='SELECT `catid`, `location`, `bin` FROM `item` WHERE `location`='.$loc.' AND `bin`='.$bin.' GROUP BY `catid`';
$catids=$dl->sql($sql);

$i=0;
foreach($catids as $d_row){
	$sql='SELECT t1.`featid` AS `featid`, t1.`feature` AS `feature`, t1.`catid` AS `catid`, t2.`cat` AS `cat` '
		.'FROM `features` AS t1 LEFT JOIN `category` AS t2 ON t1.`catid`=t2.`catid` '
		.'WHERE t1.`catid`='.$d_row['catid'];
	$structure[]=$dl->sql($sql);
	
	$sql='SELECT t1.`itemid` AS `itemid`, t1.`description` AS `description`, t1.`catid` AS `catid`, t1.`qty` AS `qty`, t2.`location` AS `location`, t1.`bin` AS `bin` '
		.'FROM `item` AS t1 '
		.'LEFT JOIN `location` AS t2 ON t1.`location`=t2.`locid` '
		.'WHERE `catid`='.$d_row['catid'].' AND t1.`location`='.$loc.' AND `bin`='.$bin;
	$list[]=$dl->sql($sql);
	
	$ii=0;
	foreach($list[$i] as $row){
		foreach($structure[$i] as $s_row){
			$sql='SELECT t1.itemid AS itemid, t1.specid AS specid, t2.spec AS spec '
				.'FROM itmspec AS t1 '
				.'LEFT JOIN specs AS t2 ON t1.specid=t2.specid '
				.'WHERE itemid='.$row['itemid'].' AND t2.featid='.$s_row['featid'];
			$spec=$dl->sql($sql);
			$itemlist[$ii][$s_row['featid']]=$spec[0];
		}
		$ii++;
	}
	$il[]=$itemlist;
	$i++;
}

$smarty->assign('structure',$structure);
$smarty->assign('list',$list);
$smarty->assign('il',$il);
$smarty->assign('structure', $structure);
$smarty->display('binview.tpl');
?>
