<?php
session_start(); 
// $livemode = false; // true = test link, false = live link
$siteOrlocalMode = false;  //true = live site, false = localhost

date_default_timezone_set('Asia/Singapore');

define('dbuser', 'darzenfc_cms');
define('dbpwd', 'Sallyfoong1997@');
define('dbhost', '127.0.0.1:3306');
define('dbname', 'darzenfc_cms');
define('SITEURL', 'https://darzenfc.xyz/cms/live');
$SITEURL = SITEURL;
define('ROOT', dirname(__FILE__));

// //define date time
define('date_dis', date("Y-m-d"));
define('time_dis', date("G:i:s"));
define('yearMonth', strtolower(date('YM')));
define('comYMD', strtolower(date('Ymd')));
define('GlobalPin', $_SESSION['usr_pin']);
// define('memberImportDetail', yearMonth.'_importInfo');

$email_collect = 'sallyfoong0531@gmail.com';
$cdate = date_dis;
$ctime = time_dis;
$comYMD = comYMD;
$cby = $_SESSION['userid'];

$act_1    = 'I'; //Insert/ Add
$act_2    = 'E'; //Edit/ Update
$act_3    = 'D'; //Delete

// //session define
// $displayName = $_SESSION['login_name'];

// //call client url //demo link 
// if($livemode==true)
// 	$curl_ship_domain = 'https://demo.connect.easyparcel.sg/?ac=';
// else
// 	$curl_ship_domain = 'https://connect.easyparcel.sg/?ac=';

// //api courier
// $api = 'EP-Mqx0IKqqS';
// if($livemode==true)
// 	$authentication = 'zKpyWplgj9'; //demo authentication
// els
// 	$authentication = 'nYgGJWc9Hq'; //live authentication

// //error message default mean
// $error_msg = array('3'=>'Required api key', '4'=>'Invalid api key', '5'=>'Unauthorized user', '0'=>'Success', '1'=>'Required authentication key', '1'=>'Invalid authentication key', '6'=>'Invalid data format');

// //table name define
define('USR_USER', 'user');
define('USR_GROUP', 'usergroup');
// define('PRO_TYPE', 'product_type');
define('AUDIT_LOG', 'audit_log');
define('PIN', 'pin');
define("MARITAL_STATUS" , 'marital_status');
define("BRAND" , 'brand');
define("UNITOFMEASUREMENT" , 'unit_of_measurement');
define("CURRENCY" , 'currency');
define("ITEM" , 'item');
define("PRODUCT","product");
define("PROJECT","projects");
define("PLATFORM","platform");
define("ORDERSHIPMENT","order_list");

$connect = @mysqli_connect(dbhost, dbuser, dbpwd, dbname);

//define session
?>