<?php

// Include external supporting files
include_once('inc_dbconnect.php');
include_once('inc_variables.php');
include_once('inc_functions.php');
include_once('inc_datalayer.php');
include_once('Smarty.class.php');

//Start Smarty
$smarty=new Smarty();

//Connect to database
$dl=new DataLayer();
$dl->connect($dbserver, $dbusername, $dbpasswd, $dbname) or die($dl->geterror());
$dl->debug=$debug;

