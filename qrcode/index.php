<?php 

$connect = @mysqli_connect("127.0.0.1:3306", "darzenfc_cms", 'Sallyfoong1997@', "darzenfc_cms");

$tblname3 = "product";

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


if (isset($_REQUEST['productName']) && isset($_REQUEST['pageno'])) {
    $datainfo="SELECT barcode_prefix, barcode_next_number FROM projects WHERE id='1'";
    $rowRetrieveInfo = mysqli_query($connect, $datainfo);
    $data = mysqli_fetch_assoc($rowRetrieveInfo);
    $barcode_next_number = $data['barcode_next_number'];
    echo '<div class="container">';
    for ($x = $barcode_next_number; $x
    <= $_REQUEST['pageno']; $x++) { 
        $filename=$PNG_TEMP_DIR.'test'.md5($_REQUEST['productName'].$x.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['productName'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        echo '<div class="column"><img src="' .$PNG_WEB_DIR.basename($filename).'" />'.'<p>'.$_REQUEST['productName'].' '.$x.'
            </p>
        </div>';// Automatically trigger the print action using JavaScript
        echo '<script>
            window.onload = function() {
                var form = document.querySelector("form");
                form.submit(); 
                form.style.display = "none";
                window.print();
            }
        </script>';
    }
    $finalBarcodeNo = $barcode_next_number + $_REQUEST['pageno'];
    $sqlupd = "UPDATE projects SET barcode_next_number = '".$finalBarcodeNo."' WHERE id = '1'";
    $query2 = mysqli_query($connect,$sqlupd); 
}

//display generated file

?>
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
<form action="index.php" method="post">
        <select name="productName" id="productName" class="form-control">
        <?php
            $query = "SELECT `id`, `name`, brand FROM ".$tblname3." WHERE status = 'A'";
            $result = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['brand'].' '.$row['name'] . "'>" . $row['Brand']. "  ".$row['name'] . "</option>";
            }
        ?>
        </select>
    <input type="tel" name="pageno" id="pageno" class="form-control demo" placeholder="How many Barcode"/>
    <input type="submit" value="GENERATE">
</form>
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
