<?php
$pagePin = '0';

include 'include/connection.php'; 

	
	$return_url = array(
		"epf"=>"epf_rate", 
		"pin"=>"pin", 
		"usergroup"=>"usergroup", 
		"user"=>"user", 
		"bank"=>"bank", 
		"employment_type_status"=>"employment_type", 
		"marital_status"=>"marital_status", 
		"department"=>"department", 
		"product_name"=>"product", 
	);

	$txtid = $_GET['id'];
	$source = $_GET['source'];

	$source = strtolower($source);
	$source = str_replace(' ', '_', $source);
	
	switch ($source) {
		case "product_name":
		  $dbTable = "product";
		  break;
		case "department":
		  $dbTable = "department";
		  break;
		case "marital_status":
		  $dbTable = "marital_status";
		  break;
		case "employment_type_status":
		  $dbTable = "employment_type";
		  break;
		case "bank":
		  $dbTable = "bank";
		  break;
	  case "epf":
		$dbTable = "epf_rate";
		break;
	  case "pin":
		$dbTable = "pin";
		break;
	  case "usergroup":
		$dbTable = "usergroup";
		break;
	  case "user":
		$dbTable = "user";
		break;
	  default:
		$dbTable = "";
	}
	
	//update user info profile
	$query1 = "UPDATE ".$dbTable." SET status='D', update_date = '".$cdate."', update_time = '".$ctime."', update_by = '".$cby."' WHERE id ='".$txtid."'";
	$rs = mysqli_query($connect,$query1);
	header('Location: '.$return_url[$source].'_list.php?status=deleted');
	
	
	
	/* $query2 = mysqli_query($connect,"SELECT id,name FROM honorific WHERE id='".$txtid."'");
	while($roweditbranch = mysqli_fetch_array($query2)){
		$id = $roweditbranch['id'];
		$name = $roweditbranch['name'];
	} */
		
	//Audit	
	/* $old_value1 = $name;
	$new_value1 = $name;
	if($old_value1==$new_value1){ $changes1 = ''; }else{ $changes1 = 'Industry Name: '.$old_value1.' to '.$new_value1; }
	$old_value = $old_value1;
	$old_value = rtrim($old_value,',');
	$new_value = '';
	$changes = $changes1;
	$changes = rtrim($changes,',');
	$changes_arr = array_filter(explode(',', $changes));
	$changes_str = implode($changes_arr,',');	 
	$actlog = $cby.' - delete honorific.';
	audit_log($screen_type,$act_3,$tblname,$query1,$old_value,$new_value,$changes,$cdate,$ctime,$cby,$actlog);	
	
	header('Location: hlist1.php'); */
/* }else{
	header('Location: index.php');
}	 */			
?>