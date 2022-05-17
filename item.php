<?php

include 'inc_header.php';
//$dl->debug=true;
$catid=gRequest('catid',0);

$sql='SELECT `featid`, `feature`, `catid` '
	.'FROM `features` '
	.'WHERE `catid`='.$catid;
$data=$dl->sql($sql);

foreach($data as $d_row){
	$sql='SELECT `specid`, `spec`, `featid` FROM `specs` where `featid`='.$d_row['featid'];
	$data_specs=$dl->sql($sql);
	
	$specs[$d_row['featid']]=$data_specs;
}

$lastid=$catid;
do{
	$sql='SELECT * FROM `category` WHERE `catid`='.$lastid;
	$crumb=$dl->sql($sql);
	$crumbs[]=array('catid'=>$crumb[0]['catid'], 'cat'=>$crumb[0]['cat']);
	$lastid=$crumb[0]['parent'];
}while ($lastid>0);

$smarty->assign('data',$data);
$smarty->assign('specs',$specs);
$smarty->assign('crumbs',$crumbs);
$smarty->display('item.tpl');
?>
