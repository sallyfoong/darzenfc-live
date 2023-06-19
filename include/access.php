<?php
 if(!isset($pagePin) && $pagePin == ''){
    header('Location: index.php');   
 }
 
 if(!isset($_SESSION['usr_pin']) && $_SESSION['usr_pin']==NULL && $pagePin != '0'){
	header('Location: index.php');   
}

 if(isset($_SESSION['usr_pin']) && !empty($_SESSION['usr_pin'])){
    $pin_arr = $_SESSION['usr_pin'];  
	
	if(!in_array($pagePin,$pin_arr) && $pagePin != '0'){
		header('Location: index.php');   
	}
 }

 function checkPinAccess($pagePin='') {
	global $pin_arr;
	if(!in_array($pagePin,$pin_arr) && $pagePin != '0'){
		return; 
	}
	return true;
 }
 
 ?>