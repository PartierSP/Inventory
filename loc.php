<?php

include 'inc_header.php';

$loc=gRequest('locid',0);

$sql='SELECT `locid`, `location` FROM `location` WHERE `locid`='.$loc;
$location=$dl->sql($sql);

$sql='SELECT `location`, `bin` FROM `item` WHERE `location`='.$loc.' GROUP BY `bin` ORDER BY `bin`';
$items=$dl->sql($sql);

$smarty->assign('location',$location);
$smarty->assign('items',$items);
$smarty->display('loc.tpl');

?>
