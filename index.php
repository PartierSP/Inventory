<?php

include 'inc_header.php';

$mode=gRequest('mode',0);
$parent=gRequest('parent',0);
$cat=gRequest('cat',"");
$id=gRequest('id',0);

if($mode==1){
	if($cat>""){
		$insert=array('cat'=>$cat,'parent'=>$parent);
		$dl->insert('category',$insert);
	}
}

$tree=getchildren(0, $dbserver, $dbusername, $dbpasswd, $dbname, $debug);

if($id>0){
	$lastid=$id;
	do{
		$sql='SELECT * FROM `category` WHERE `catid`='.$lastid;
		$crumb=$dl->sql($sql);
		$crumbs[]=$crumb[0]['catid'];
		$lastid=$crumb[0]['parent'];
	}while ($lastid>0);
}

$smarty->assign('id', $crumbs);
$smarty->assign('mode', $mode);
$smarty->assign('data', $tree);
$smarty->display('index.tpl');

//\\//\\//\\//\\//\\//\\//\\//\\//\\

function getchildren($parent, $dbserver, $dbusername, $dbpasswd, $dbname, $debug){

	$dl=new DataLayer();
	$dl->connect($dbserver, $dbusername, $dbpasswd, $dbname) or die($dl->geterror());
	$dl->debug=$debug;

	$sql='SELECT `catid`, `cat`, `parent` FROM `category` WHERE `parent`='.$parent.' ORDER BY `cat`';
	$results=$dl->sql($sql);

	foreach($results as $row){
		$gen=getchildren($row['catid'], $dbserver, $dbusername, $dbpasswd, $dbname, $debug);
		if(count($gen)<1){
			$gen='---';
		}
		$tree[]=array('catid'=>$row['catid'],'cat'=>$row['cat'],'parent'=>$row['parent'],'children'=>$gen);
	}

	return $tree;
}

?>
