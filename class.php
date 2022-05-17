<?php

include 'inc_header.php';
//$dl->debug=true;
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

$sql='SELECT t0.`itemid` AS `itemid`, t0.`description` AS `description`, t0.`catid` AS `catid`, t0.`qty` AS `qty`, t0.`location` AS `location`, t0.`bin` AS `bin` ';
$from=' FROM `item` AS t0 ';
foreach($data as $d_row){
	$select=$select.', ts'.$d_row['featid'].'.`spec` AS `'.$d_row['feature'].'`';
	$from=$from . ' LEFT JOIN `itmspec` AS t'.$d_row['featid'].' ON t0.itemid=t'.$d_row['featid'].'.itemid '
			. ' LEFT JOIN `specs` AS ts'.$d_row['featid'].' ON t'.$d_row['featid'].'.specid=ts'.$d_row['featid'].'.specid ';
	$where=$where . ' AND ts'.$d_row['featid'].'.featid='.$d_row['featid'].' ';
}
$sql=$sql.$select.$from.'WHERE `catid`='.$id.$where;
$itemlist=$dl->sql($sql);

$lastid=$id;
do{
	$sql='SELECT * FROM `category` WHERE `catid`='.$lastid;
	$crumb=$dl->sql($sql);
	$crumbs[]=array('catid'=>$crumb[0]['catid'], 'cat'=>$crumb[0]['cat']);
	$lastid=$crumb[0]['parent'];
}while ($lastid>0);


$smarty->assign('data',$data);
$smarty->assign('specs',$specs);
$smarty->assign('itemlist',$itemlist);
$smarty->assign('ilcount', count($itemlist));
$smarty->assign('crumbs',$crumbs);
$smarty->assign('id',$id);
$smarty->display('class.tpl');
?>
