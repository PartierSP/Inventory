<?php

include 'inc_header.php';

$id=gRequest('id',0);

$sql='SELECT `featid`, `feature`, `catid` '
	.'FROM `features` '
	.'WHERE `catid`='.$id;
$data=$dl->sql($sql);

foreach($data as $d_row){
	$sql='SELECT `specid`, `spec`, `featid` FROM `specs` where `featid`='.$d_row['featid'];
	$data_specs=$dl->sql($sql);
	
	$specs[$d_row['featid']]=$data_specs;
}

$sql='SELECT t1.`itemid` AS `itemid`, t1.`description` AS `description`, t1.`catid` AS `catid`, t1.`qty` AS `qty`, t2.`location` AS `location`, t1.`bin` AS `bin` '
	.'FROM `item` AS t1 '
	.'LEFT JOIN `location` AS t2 ON t1.`location`=t2.`locid` '
	.'WHERE ';

$filter='';
foreach($data as $d_row){
	foreach($specs[$d_row['featid']] as $row){
		$fltr=gRequest('cb'.$row['specid'],0);
		$cbv[$row['specid']]=$fltr;
		if ($fltr>0){
			if($filter<>''){
				$filter.=' OR ';
			}
			$filter.='`specid`='.$row['specid'];
		}
	}
}
if($filter==''){
	$sql.='`catid`='.$id. ' GROUP BY `itemid`';
} else {
	$sql.='`itemid` IN (SELECT `itemid` '
	.'FROM ('
		.'SELECT `itemid`, COUNT(`itemid`) AS `cnt` '
		.'FROM `itmspec` ' 
		.'WHERE ('.$filter.') '
		.'GROUP BY `itemid`'
	.') AS t4 '
	.'WHERE `cnt`= ('
		.'SELECT COUNT(`cnt`) AS `cnt` '
		.'FROM ('
			.'SELECT COUNT(`featid`) AS `cnt` '
			.'FROM `specs` '
			.'WHERE '.$filter.' ' 
			.'GROUP BY `featid`'
		.') AS t5'
	.'))';
}

$list=$dl->sql($sql);

$i=0;
foreach($list as $row){
	foreach($data as $d_row){
		$sql='SELECT t1.itemid AS itemid, t1.specid AS specid, t2.spec AS spec '
			.'FROM itmspec AS t1 '
			.'LEFT JOIN specs AS t2 ON t1.specid=t2.specid '
			.'WHERE itemid='.$row['itemid'].' AND t2.featid='.$d_row['featid'];
		$spec=$dl->sql($sql);
		$itemlist[$i][$d_row['featid']]=$spec[0];
	}
	$i++;
}

$lastid=$id;
do{
	$sql='SELECT * FROM `category` WHERE `catid`='.$lastid;
	$crumb=$dl->sql($sql);
	$crumbs[]=array('catid'=>$crumb[0]['catid'], 'cat'=>$crumb[0]['cat']);
	$lastid=$crumb[0]['parent'];
}while ($lastid>0);

$smarty->assign('data',$data);
$smarty->assign('specs',$specs);
$smarty->assign('list',$list);
$smarty->assign('itemlist',$itemlist);
$smarty->assign('ilcount', count($itemlist));
$smarty->assign('crumbs',$crumbs);
$smarty->assign('cbv', $cbv);
$smarty->assign('id',$id);
$smarty->display('class.tpl');
?>
