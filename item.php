<?php

include 'inc_header.php';
//$dl->debug=true;
$catid=gRequest('catid',0);
$new=gRequest('n',0);
$itemid=gRequest('itemid',0);
$search=gRequest('search','');

if(($catid==0 || $itemid==0) && $new==0){
	if($search>''){
		$sch=preg_split("/[\s,.-]+/",$search);
		$catid=$sch[0];
		$itemid=$sch[1];
	}else{
		$smarty->assign('fault',0);
		$smarty->display('search.tpl');
		exit();
	}
}

if(($new<>0 && $catid>0) || ($catid<>0 && $itemid<>0)){
	$sql='SELECT `featid`, `feature`, `catid`, 0 AS `selected` '
		.'FROM `features` '
		.'WHERE `catid`='.$catid;
	$data=$dl->sql($sql);

	if($new==1){
		$desc=gRequest('description',"");
		$qty=gRequest('qty',0);
		$bin=gRequest('bin',0);
		$location=gRequest('location',0);
		$newloc=gRequest('newlocation',"");
		
		if(($location==0) and ($newloc>"")){
			$insertarray=array('location'=>$newloc);
			$location=$dl->insert('location',$insertarray);
		}
		
		$insertarray=array('description'=>$desc,'catid'=>$catid,'qty'=>$qty,'location'=>$location,'bin'=>intval($bin));
		if($itemid==0){
			$newitemid=$dl->insert('item',$insertarray);
			$itemid=$newitemid;
		}else{
			$t=$dl->update('item',$insertarray,'itemid='.$itemid);
			$newitemid=$itemid;
			
			//FIXME: itmspec does not have a featid column to link back with.  So currently easier to delete
			//       and rebuild everything for this item.
			$sql='DELETE FROM `itmspec` WHERE `itemid`='.$itemid;
			$t=$dl->sql($sql);
		}
		
		foreach($data as $d_row){
			$feat[$d_row['featid']]=gRequest('feat'.$d_row['featid'],0);
			$nsp[$d_row['featid']]=gRequest('nsp'.$d_row['featid'],"");
			
			if(($feat[$d_row['featid']]==0) AND ($nsp[$d_row['featid']]>"")){
				//FIXME: should check to see if $nsp[$d_row['featid']] is a duplicate of an existing
				//       spec, then skip the following insert but set $feat[$d_row['featid']] to the
				//       existing specid instead.
				$insertarray=array('spec'=>$nsp[$d_row['featid']],'featid'=>$d_row['featid']);
				$feat[$d_row['featid']]=$dl->insert('specs',$insertarray);
			}
			
			$insertarray=array('itemid'=>$newitemid,'specid'=>$feat[$d_row['featid']]);
			$dl->insert('itmspec',$insertarray);
		}
	}

	foreach($data as $d_row){
		$sql='SELECT `specid`, `spec`, `featid` FROM `specs` WHERE `featid`='.$d_row['featid'].' ORDER BY `spec`';
		$data_specs=$dl->sql($sql);
		
		$specs[$d_row['featid']]=$data_specs;
	}

	$sql='SELECT * FROM location';
	$locations=$dl->sql($sql);

	$lastid=$catid;
	do{
		$sql='SELECT * FROM `category` WHERE `catid`='.$lastid;
		$crumb=$dl->sql($sql);
		$crumbs[]=array('catid'=>$crumb[0]['catid'], 'cat'=>$crumb[0]['cat']);
		$lastid=$crumb[0]['parent'];
	}while ($lastid>0);

	if($itemid>0){
		$sql='SELECT `itemid`, `description`, `catid`, `qty`, `location`, `bin` '
			.'FROM `item` '
			.'WHERE `itemid`='.$itemid;
		$item=$dl->sql($sql);
		
		foreach($data as $d_row){
			$sql='SELECT t1.`ifid` AS `ifid`, t1.`itemid` AS `itemid`, t1.`specid` AS `specid` '
				.'FROM `itmspec` AS t1 '
				.'LEFT JOIN `specs` AS t2 ON t1.`specid`=t2.`specid` '
				.'WHERE t2.`featid`='.$d_row['featid'] . ' AND `itemid`='.$itemid;
			$t=$dl->sql($sql);
			$data2[]=array('featid'=>$d_row['featid'],
				'feature'=>$d_row['feature'],
				'catid'=>$d_row['catid'],
				'selected'=>$t[0]['specid']);
		}
		$data=$data2;
		
		foreach($locations as $d_row){
			$data3[]=array('locid'=>$d_row['locid'],
				'location'=>$d_row['location'],
				'selected'=>$item[0]['location']);
		}
		$locations=$data3;
	}

	if((sizeof($data)>0 && sizeof($item[0])>0) || $new<>0){
		$smarty->assign('data',$data);
		$smarty->assign('specs',$specs);
		$smarty->assign('locations',$locations);
		$smarty->assign('crumbs',$crumbs);
		$smarty->assign('catid',$catid);
		$smarty->assign('itemid',$itemid);
		$smarty->assign('item',$item[0]);
		$smarty->display('item.tpl');
	}else{
		$smarty->assign('fault',2);
		$smarty->display('search.tpl');
	}
}else{
	$smarty->assign('fault',1);
	$smarty->display('search.tpl');
}
?>
