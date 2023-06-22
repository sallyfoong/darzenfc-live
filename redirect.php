<?php

$host="127.0.0.1:3306";
$username="darzenfc_shorten_url";
$password="Sallyfoong1997@";
$databasename="darzenfc_shorten_url";
$connect = @mysqli_connect($host,$username,$password,$databasename);

if(isset($_GET['param']))
{
    $url=$_GET["param"];

    $datainfo="SELECT long_url FROM short_url WHERE short_url='$url'";
    $rowRetrieveInfo = mysqli_query($connect, $datainfo);
    $data = mysqli_fetch_assoc($rowRetrieveInfo);
    if($data['long_url']){
    header('Location: '.$data['long_url']);
 }else{
    header('Location: https://www.beyourdiary.co/');
 }
}
?>