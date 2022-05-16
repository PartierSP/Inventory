<?php

include 'inc_header.php';

$catid=gRequest('catid',0);
$feature=gRequest('feature',"");

if($feature>""){
	$insert=array('feature'=>$feature,'catid'=>$catid);
	$dl->insert('features',$insert);
}

$sql="SELECT `featid`, `feature`, `catid` FROM `features` WHERE `catid`=".$catid;
$features=$dl->sql($sql);

$lastid=$catid;
do{
	$sql='SELECT * FROM `category` WHERE `catid`='.$lastid;
	$crumb=$dl->sql($sql);
	$crumbs[]=array('catid'=>$crumb[0]['catid'], 'cat'=>$crumb[0]['cat']);
	$lastid=$crumb[0]['parent'];
}while ($lastid>0);

$smarty->assign('catid',$catid);
$smarty->assign('crumbs',$crumbs);
$smarty->assign('features',$features);
$smarty->display('feature.tpl');

?>
