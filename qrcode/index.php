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

//barcode + product id + warehouse id

if (isset($_REQUEST['productName']) && isset($_REQUEST['pageno'])) {
    //it's very important!
    if (trim($_REQUEST['productName']) == '')
    die('data cannot be empty! <a href="?">back</a>');
    
    //get barcode start number
    $datainfo="SELECT barcode_prefix, barcode_next_number FROM projects WHERE id='1'";
    $rowRetrieveInfo = mysqli_query($connect, $datainfo);
    $data = mysqli_fetch_assoc($rowRetrieveInfo);
    $barcode_next_number = $data['barcode_next_number'];

    //get the product info
    $prdInfo = "SELECT id, name, brand FROM ".$tblname3." WHERE status = 'A' AND id ='".$_REQUEST['productName']."'";
    $rowPrdRetrieveInfo = mysqli_query($connect, $prdInfo);
    $dataPrd = mysqli_fetch_assoc($rowPrdRetrieveInfo);
    $prdName = $dataPrd['name'];
    $brandId = $dataPrd['brand'];
    $prdId = $dataPrd['id'];
    
    $brandInfo = "SELECT id, name FROM brand WHERE status = 'A' AND id='" . $brandId . "'";
    $rowBrandRetrieveInfo = mysqli_query($connect, $brandInfo);
    $dataBrand = mysqli_fetch_assoc($rowBrandRetrieveInfo);
    $brandName = $dataBrand['name'];

    $combineBrandPrdName = $brandName.' '.$prdName;
    
    $countOP = 0;
    $finalBarcodeNo = $barcode_next_number + $_REQUEST['pageno'];
    echo '<div class="container">';
        for ($x = 1; $x
        <= $_REQUEST['pageno']; $x++) { // user data
            $urlRtn = "https://darzenfc.xyz/?barcode=".($barcode_next_number + $x)."&pid=".$prdId;
            $filename=$PNG_TEMP_DIR.'test'.md5($urlRtn.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
            QRcode::png($urlRtn, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
            echo '<div class="column"><img src="' .$PNG_WEB_DIR.basename($filename).'" />'.'<p class="title">'.$combineBrandPrdName.' '.$barcode_next_number + $x.'
        </p>
    </div>';
    }
    $sqlupd = "UPDATE projects SET barcode_next_number = '".$finalBarcodeNo."' WHERE id = '1'";
    $query2 = mysqli_query($connect,$sqlupd); 
    // Automatically trigger the print action using JavaScript
        echo '<script>
            window.onload = function() {
                var form = document.querySelector("form");
                form.style.display = "none";
                window.print();
            }
            window.onafterprint = function() {
                // Print page has been closed
                // Remove the content of the container
                var container = document.querySelector(".container");
                container.innerHTML = "";
                
                // Show the form again
                var form = document.querySelector("form");
                form.style.display = "block";
            }
        </script>';

    echo '</div>';
}

//display generated file

?>
<style>
@media print {
    body {
        margin: 0;
        padding: 0;
    }

    .container {
        margin: 0;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .column {
        flex-basis: 20%;
        text-align: center;
        padding: 0px;
    }

    .column img {
        width: 100%;
        height: auto;
    }

    .title {
        font-size: 11px;
        margin: 0;
        padding: 0 5px 5px;
    }
}
</style>
<form action="index.php" method="post">
    <select name="productName" id="productName" class="form-control">
        <?php
            $query = "SELECT `id`, `name`, brand FROM ".$tblname3." WHERE status = 'A'";
            $result = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['Brand']. "  ".$row['name'] . "</option>";
            }
        ?>
    </select>

    <input type="tel" name="pageno" id="pageno" class="form-control demo" placeholder="How many Barcode" />
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