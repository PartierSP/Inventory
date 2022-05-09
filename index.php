<?php

include 'inc_header.php';

$tree=getchildren(0, $dbserver, $dbusername, $dbpasswd, $dbname, $debug);

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
