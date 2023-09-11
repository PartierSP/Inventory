<?php
include('qrlib.php');  // PHP QR Code library ver 1.1.4 (https://phpqrcode.sourceforge.net/)
include('inc_variables.php');
include('inc_functions.php');

$dest=gRequest('d',0);
$item=gRequest('i',0);
$loc=gRequest('l',0);
$bin=gRequest('b',0);

$destination=array('binview','class');

$link=$serveraddress.$destination[$dest].'.php?';

switch($dest){
	case 0:
		$link=$link.'l='.$loc.'&b='.$bin;
		break;
	case 1:
		$link=$link.'i='.$item;
		break;
}

QRcode::png($link);
?>
