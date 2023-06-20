<?php    
   
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'H';

    $matrixPointSize = 2;


    if (isset($_REQUEST['data']) && isset($_REQUEST['pageno'])) { 
    
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            for ($x = 1; $x <= $_REQUEST['pageno']; $x++) {
            // user data
            $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
            QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);   
            echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  
           }
    }
        
    //display generated file
    
    
    //config form
    echo '<form action="index.php" method="post">
       <input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" />&nbsp';   
       echo '<input type="tel" name="pageno" id="pageno" class="form-control demo" />';
       echo '<input type="submit" value="GENERATE"></form>';