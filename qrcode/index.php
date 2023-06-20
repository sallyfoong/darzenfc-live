<?php

// set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

// html PNG location prefix
$PNG_WEB_DIR = 'temp/';

include "qrlib.php";

// of course, we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR)) {
    mkdir($PNG_TEMP_DIR);
}

$filename = $PNG_TEMP_DIR . 'test.png';

// processing form input
// remember to sanitize user input in a real-life solution !!!
$errorCorrectionLevel = 'H';
$matrixPointSize = 2;

if (isset($_REQUEST['data']) && isset($_REQUEST['pageno'])) {

    // it's very important!
    if (trim($_REQUEST['data']) == '') {
        die('data cannot be empty! <a href="?">back</a>');
    }

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
    </style>';

    echo '
    <script>
    function printPreview() {
        window.open("print_preview.php", "_blank");
    }
    </script>';

    echo '<div id="form-wrapper">';

    echo '<form action="index.php" method="post" onsubmit="printPreview(); return false;">';
    echo '<input name="data" value="' . (isset($_REQUEST['data']) ? htmlspecialchars($_REQUEST['data']) : 'PHP QR Code :)') . '" />&nbsp';
    echo '<input type="tel" name="pageno" id="pageno" class="form-control demo" />';
    echo '<input type="submit" value="GENERATE"></form>';

    echo '</div>';

    echo '<div id="preview-wrapper" style="display: none;">';

    echo '<h1>Print/Preview Page</h1>';

    $data = isset($_POST['data']) ? $_POST['data'] : 'PHP QR Code :)';
    $pageno = isset($_POST['pageno']) ? intval($_POST['pageno']) : 1;

    echo '<div class="container">';
    for ($x = 1; $x <= $pageno; $x++) {
        // user data
        $filename = $PNG_TEMP_DIR . 'test' . md5($data . $x . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        echo '<div class="column"><img src="' . $PNG_WEB_DIR . basename($filename) . '" /><p>' . $data . '+' . $x . ' </p></div>';
    }
    echo '</div>';

    echo '</div>';
} else {
    // display the form if no data is submitted
    echo '
    <style>
    #form-wrapper {
        display: block;
    }
    #preview-wrapper {
        display: none;
    }
    </style>';

    echo '<div id="form-wrapper">';

    echo '<form action="index.php" method="post" onsubmit="printPreview(); return false;">';
    echo '<input name="data" value="' . (isset($_REQUEST['data']) ? htmlspecialchars($_REQUEST['data']) : 'PHP QR Code :)') . '" />&nbsp';
    echo '<input type="tel" name="pageno" id="pageno" class="form-control demo" />';
    echo '<input type="submit" value="GENERATE"></form>';

    echo '</div>';

    echo '<div id="preview-wrapper">';
    echo '<h1>Print/Preview Page</h1>';
    echo '</div>';
}

?>

<script>
window.onload = function() {
    document.getElementById('form-wrapper').style.display = 'none';
    document.getElementById('preview-wrapper').style.display = 'block';
    window.print();
}
</script>