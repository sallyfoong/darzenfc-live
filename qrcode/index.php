<?php    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //of course, we need rights to create a temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in a real-life solution !!!
    $errorCorrectionLevel = 'H';
    $matrixPointSize = 2;

    if (isset($_REQUEST['data']) && isset($_REQUEST['pageno'])) { 
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
        
        echo '<div class="container">';
        for ($x = 1; $x <= $_REQUEST['pageno']; $x++) {
            // user data
            $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].$x.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
            QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);   
            
            echo '<div class="column"><img src="'.$PNG_WEB_DIR.basename($filename).'" />'.'<p>'.$_REQUEST['data'].'+'.$x.' </p></div>';  
        }
        echo '</div>';
        
        // Add JavaScript to open the print dialog
        echo '
        <script>
            function printPage() {
                window.print();
                setTimeout(function() {
                    // Check if the print dialog is closed
                    if (!window.self || window.self.closed || typeof window.self.print === "undefined") {
                        // Clear the QR code images and return to the form action
                        document.getElementById("qrcode-images").innerHTML = "";
                        document.getElementById("qr-form").style.display = "block";
                    }
                }, 100);
            }
            window.onload = printPage;
        </script>';
        
        // Hide the form interface
        echo '<style>#qr-form { display: none; }</style>';
    }
        
    // Display the config form
    echo '
        <style>
            .container {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }
            .column {
                flex-basis: 20%;
                text-align: center;
                padding: 10px;
            }
            .column img {
                width: 100%;
                height: auto;
            }
            p {
                font-size: 11px;
                margin: 0;
            }
        </style>
        <div id="qrcode-images">
            <form id="qr-form" action="index.php" method="post">
                <input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" />&nbsp';
    echo '<input type="tel" name="pageno" id="pageno" class="form-control demo" />';
    echo '<input type="submit" value="GENERATE">
            </form>
        </div>';
?>