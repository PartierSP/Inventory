<?php

function gPost($name, $default){
	if(isset($_POST[$name])){
		return $_POST[$name];
	} else {
		return $default;
	}
}

function gGet($name, $default){
	if(isset($_GET[$name])){
		return $_GET[$name];
	} else {
		return $default;
	}
}

function gRequest($name, $default){
	if(isset($_REQUEST[$name])){
		return $_REQUEST[$name];
	} else {
		return $default;
	}
}

?>
