<?php
$pagePin = '16';

include 'include/connection.php'; 

$page_title = 'Generate Barcode';
$sub_db = PROJECT; 
$back_url = SITEURL."/generateBarcode.php";
$error_message = '';
$txtgetID = input('id');

$tblname1 = $sub_db;
$tblname3 = PRODUCT;
$screen_type1 = 'Add '.$page_title;
$screen_type2 = 'Edit '.$page_title;

//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = 'temp/';

include "qrcode/qrlib.php";

//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
mkdir($PNG_TEMP_DIR);


$filename = $PNG_TEMP_DIR.'test.png';

//processing form input
//remember to sanitize user input in real-life solution !!!
$errorCorrectionLevel = 'H';

$matrixPointSize = 2;

if (isset($_REQUEST['productName']) && isset($_REQUEST['pageno'])) {
    //it's very important!
    if (trim($_REQUEST['productName']) == '')
    die('data cannot be empty! <a href="?">back</a>');
    echo '<div class="container">';
        for ($x = 1; $x
        <= $_REQUEST['pageno']; $x++) { // user data
            $filename=$PNG_TEMP_DIR.'test'.md5($_REQUEST['productName'].$x.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
            QRcode::png($_REQUEST['dataproductName'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
            echo '<div class="column"><img src="' .$PNG_WEB_DIR.basename($filename).'" />'.'<p>'.$_REQUEST['productName'].'+'.$x.'
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
}

//display generated file

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php echo $header; ?>
<script>
jQuery(document).ready(function() {
    jQuery("form").submit(function() {
        if (jQuery('#pageno').val() == "") {
            alert("Please fill the Page No");
            return false;
        }

        jQuery("#epfform").submit();
    });
});
</script>
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

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php echo $menu; ?>
        <?php echo $sideMenu; ?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <?php echo $breadcrumb; ?>
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $page_title; ?> (One Page 33 barcode)
                                </h4>
                                <form action="index.php" method="post">
                                    <input type="text" name="txtid" value="<?php echo $txtid; ?>" class="dnone">
                                    <div class="form-group">
                                        <label for="hue-demo">Product</label>
                                        <select name="productName" id="productName" class="form-control">
                                            <?php
                                        $query = "SELECT `id`, `name`, brand FROM ".$tblname3." WHERE status = 'A'";
                                        $result = mysqli_query($connect, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='" . $row['brand'].' '.$row['name'] . "'>" . $row['Brand']. "  ".$row['name'] . "</option>";
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="hue-demo">How many Barcode</label>
                                        <input type="tel" name="pageno" id="pageno" class="form-control demo"
                                            data-control="hue" required autofocus value="<?php echo $pageno; ?>"
                                            onKeyPress="return isNumberKey(event);" />
                                    </div>
                                    <div>
                                        <button type="submit" name="save" class="btn btn-success text-white">
                                            Generate
                                        </button>
                                        <button type="reset" name="reset" id="resetForm"
                                            class="btn btn-primary">Reset</button>
                                    </div>
                                    <div id="printLabel">
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!-- editor -->

                        <!-- ============================================================== -->
                        <!-- End PAge Content -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Right sidebar -->
                        <!-- ============================================================== -->
                        <!-- .right-sidebar -->
                        <!-- ============================================================== -->
                        <!-- End Right sidebar -->
                        <!-- ============================================================== -->
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Container fluid  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <?php echo $footer; ?>
                </div>
                <!-- ============================================================== -->
                <!-- End Page wrapper  -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Wrapper -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- All Jquery -->
            <!-- ============================================================== -->
            <?php include_once "include/footerJquery.php"; ?>
            <script>
            //***********************************//
            // For select 2
            //***********************************//

            $('#resetForm').click(function() {
                $('#pageno').val('');
            });
            </script>
</body>

</html>