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
                                    <button type="text" name="save" class="btn btn-success text-white"
                                        onclick="printBarcode()">
                                        Generate
                                    </button>
                                    <button type="reset" name="reset" id="resetForm"
                                        class="btn btn-primary">Reset</button>
                                </div>
                                <div id="printLabel">
                                </div>
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