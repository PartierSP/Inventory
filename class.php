<?php

include 'inc_header.php';
$dl->debug=true;
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

$sql='SELECT * FROM `item` WHERE `catid`='.$id;
$itemlist=$dl->sql($sql);

$smarty->assign('data',$data);
$smarty->assign('specs',$specs);
$smarty->assign('itemlist',$itemlist);
$smarty->assign('ilcount', count($itemlist));
$smarty->display('class.tpl');
?>
