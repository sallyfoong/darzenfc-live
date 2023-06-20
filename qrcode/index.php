<?php //set it to writable location, a place for temp generated PNG files
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
echo '<div class="container">';
    for ($x = 1; $x
    <= $_REQUEST['pageno']; $x++) { // user data
        $filename=$PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].$x.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        echo '<div class="column"><img src="' .$PNG_WEB_DIR.basename($filename).'" />'.'<p>'.$_REQUEST['data'].'+'.$x.'
    </p>
</div>';// Automatically trigger the print action using JavaScript
echo '<script>
    window.onload = function() {
        var form = document.querySelector("form");
        form.submit();
        form.style.display = "none";
        window.print();
        form.style.display = "block";
    }
</script>';
}
}

//display generated file


//config form
echo '<style>
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
<form action="index.php" method="post">
    <input name="data"
        value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" />&nbsp';
    echo '<input type="tel" name="pageno" id="pageno" class="form-control demo" />';
    echo '<input type="submit" value="GENERATE">
</form>';echo '
<script>
    function printPage() {
        // Hide the form
        var form = document.querySelector("form");
        form.style.display = "none";

        // Print the page
        window.print();

        // Show the form again after printing
        form.style.display = "block";
    }
</script>
';
?>