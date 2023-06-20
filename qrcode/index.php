<?php

//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = 'temp/';

include "qrlib.php";

//of course we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);


$filename = $PNG_TEMP_DIR . 'test.png';

//processing form input
//remember to sanitize user input in real-life solution !!!
$errorCorrectionLevel = 'H';
$matrixPointSize = 2;

if (isset($_REQUEST['data']) && isset($_REQUEST['pageno'])) {

    //it's very important!
    if (trim($_REQUEST['data']) == '')
        die('data cannot be empty! <a href="?">back</a>');

    echo '<div class="container">';

    for ($x = 1; $x <= $_REQUEST['pageno']; $x++) {
        // user data
        $filename = $PNG_TEMP_DIR . 'test' . md5($_REQUEST['data'] . $x . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);

        echo '<div class="column"><img src="' . $PNG_WEB_DIR . basename($filename) . '" />' . '<p>' . $_REQUEST['data'] . '+' . $x . ' </p></div>';
    }

    // Generate JavaScript code to open the print/preview page
    echo '
    <script>
        function printPreview() {
            // Open a new window for print/preview
            var printWindow = window.open("", "_blank");
            var htmlContent = \'<html><head><title>QR Code Print/Preview</title>\';
            htmlContent += \'<style>body { margin: 0; }</style>\';
            htmlContent += \'</head><body>\';

            // Append the QR code images to the print window
            var images = document.querySelectorAll(".column img");
            for (var i = 0; i < images.length; i++) {
                var imgSrc = images[i].getAttribute("src");
                htmlContent += \'<img src="\' + imgSrc + \'" />\';
            }

            htmlContent += \'</body></html>\';

            // Write the HTML content to the print window
            printWindow.document.open();
            printWindow.document.write(htmlContent);
            printWindow.document.close();
        }
    </script>';

    // Hide the form interface and add a button to trigger print/preview
    echo '
    <script>
        function toggleFormVisibility() {
            var form = document.getElementById("qrForm");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }
    </script>';

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
    <form id="qrForm" action="index.php" method="post" style="display: block;">
        <input name="data" value="' . (isset($_REQUEST['data']) ? htmlspecialchars($_REQUEST['data']) : 'PHP QR Code :)') . '" />
        <input type="tel" name="pageno" id="pageno" class="form-control demo" />
        <input type="submit" value="GENERATE" onclick="toggleFormVisibility(); printPreview(); return false;">
    </form>';

    echo '
    <button onclick="toggleFormVisibility(); printPreview();">Print/Preview</button>';

    echo '</div>';
}

?>