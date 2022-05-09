<?php

include 'inc_header.php';

$id=gRequest('id',0);

$sql='SELECT t1.featid as featid, t1.feature as feature, t2.categid as categid '
	.'FROM featlist as t2 '
	.'LEFT JOIN features as t1 '
	.'ON t2.featid=t1.featid '
	.'WHERE t2.categid='.$id;
$data=$dl->sql($sql);

foreach($data as $d_row){
	$sql='SELECT `specid`, `spec`, `featid` FROM `specs` where `featid`='.$d_row['featid'];
	$data_specs=$dl->sql($sql);
	
	$specs[$d_row['featid']]=$data_specs;
}

$sql='SELECT * FROM `item` WHERE `type`='.$id;
$itemlist=$dl->sql($sql);

$smarty->assign('data',$data);
$smarty->assign('specs',$specs);
$smarty->assign('itemlist',$itemlist);
$smarty->display('class.tpl');
?>
