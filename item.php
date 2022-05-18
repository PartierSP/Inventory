<?php

include 'inc_header.php';
//$dl->debug=true;
$catid=gRequest('catid',0);
$new=gRequest('n',0);

$sql='SELECT `featid`, `feature`, `catid` '
	.'FROM `features` '
	.'WHERE `catid`='.$catid;
$data=$dl->sql($sql);

if($new==1){
	$desc=gRequest('description',"");
	$qty=gRequest('qty',0);
	$bin=gRequest('bin',"");
	
	$insertarray=array('description'=>$desc,'catid'=>$catid,'qty'=>$qty,'bin'=>$bin);
	$newitemid=$dl->insert('item',$insertarray);
	
	foreach($data as $d_row){
		$feat[$d_row['featid']]=gRequest('feat'.$d_row['featid'],0);
		$nsp[$d_row['featid']]=gRequest('nsp'.$d_row['featid'],"");
		
		if(($feat[$d_row['featid']]==0) AND ($nsp[$d_row['featid']]>"")){
			$insertarray=array('spec'=>$nsp[$d_row['featid']],'featid'=>$d_row['featid']);
			$feat[$d_row['featid']]=$dl->insert('specs',$insertarray);
		}
		
		$insertarray=array('itemid'=>$newitemid,'specid'=>$feat[$d_row['featid']]);
		$dl->insert('itmspec',$insertarray);
	}
}

foreach($data as $d_row){
	$sql='SELECT `specid`, `spec`, `featid` FROM `specs` WHERE `featid`='.$d_row['featid'];
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
$smarty->assign('catid',$catid);
$smarty->display('item.tpl');
?>
