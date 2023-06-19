<?php 

/***
1) specialCase = false (mean it support check in)

2) ACT type define:
E = edit 
D = delete
A = add
V = view
I = import
C = check
O = order
L = login
LO = logout
P = payment

3) actlog define: (must have value)
{username} {action}
***/

function audit_log($specialCase = true, $screen_type, $act_type, $tbl_name, $query_record, $old_value, $new_value, $changes, $actlog){
	global $connect, $cdate, $ctime, $cby, $logInName;
  	$new_value	= rtrim($new_value,',');

	if($specialCase){
	  $query_record = addslashes($query_record);
	  $qrsql = "INSERT INTO ".AUDIT_LOG." (screen_type, action_type, query_record, query_table, old_value, new_value, changes, create_date, create_time, create_by, actlog)VALUES('$screen_type','$act_type','$query_record','$tbl_name','$old_value','$new_value','$changes','$cdate','$ctime','$cby','$actlog')";  
	  $rsqrsql = @mysqli_query($connect,$qrsql); 
	}

}

function edit_log($specialCase = true, $screen_type, $act_type, $tbl_name, $query_record, $old_value, $new_value, $changes, $page){
	global $connect, $cdate, $ctime, $cby, $logInName;
  
	if($specialCase){
	  $actlog = $logInName.' Edit '.$page;
	  $query_record = addslashes($query_record);
	  $qrsql = "INSERT INTO ".AUDIT_LOG." (screen_type, action_type, query_record, query_table, old_value, new_value, changes, create_date, create_time, create_by, actlog)VALUES('$screen_type','$act_type','$query_record','$tbl_name','$old_value','$new_value','$changes','$cdate','$ctime','$cby','$actlog')";  
	  $rsqrsql = @mysqli_query($connect,$qrsql); 
	}
}

function view_log($specialCase = true, $screen_type, $act_type, $tbl_name){
	global $connect, $cdate, $ctime, $cby, $logInName;
	
	if($specialCase){
		$actlog = $logInName.' view '.$screen_type;
		$qrsql = "INSERT INTO ".AUDIT_LOG." (screen_type, action_type, query_table, create_date, create_time, create_by, actlog)VALUES('$screen_type','V','$tbl_name','$cdate','$ctime','$cby','$actlog')";  
		$rsqrsql = @mysqli_query($connect,$qrsql); 
	}
}
     
function login_log($specialCase = true){
	global $connect, $cdate, $ctime, $cby, $logInName;
	
	if($specialCase){
		$actlog = $logInName.' Login to the system';
		$qrsql = "INSERT INTO ".AUDIT_LOG." (screen_type, action_type, actlog, create_date, create_time, create_by) VALUES('Login Screen', 'L', '$actlog', '$cdate', '$ctime', '$cby')";
		$rsqrsql = @mysqli_query($connect,$qrsql);
	}
}


?>