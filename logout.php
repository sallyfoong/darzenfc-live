<?php
include 'include/connection.php';

$_SESSION = array();
session_start();
session_destroy();
redirect('index.php');

?>