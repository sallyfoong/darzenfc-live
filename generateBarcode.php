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

if(isset($_POST['generate'])){
    $code=$_POST['pageno'];
    for ($x = 0; $x <= 10; $x++) {
        echo "<center><img alt='testing' src='barcode.php?codetype=Code39&size=50&text=".$code.$x."&print=true'/></center>";
      }
    
}
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
<script>
function printBarcode() {
    const pageno = document.getElementById("pageno").value; // get the value of the pageno input field
    var productid = document.getElementById("productName").value;
    const productname = productid;
    console.log(productname);
    if (!pageno) {
        alert("pageno is invalid");
    }
    var code;
    var url;
    var arrayOfBarcode = []; // create an empty array
    for (let i = 0; i < pageno; i++) {
        code = productName + i; // replace with the text you want to encode in the barcode
        url = `barcode/barcode.php?codetype=Code39&size=20&text=${code}&print=true`; // URL of the barcode image
        arrayOfBarcode.push(`<img src="${url}" alt="Barcode image" />`); // add the barcode image HTML to the array

    }

    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.responseType = "blob"; // set the response type to blob to retrieve the image data as a binary blob
    xhr.onload = function() {
        if (xhr.status === 200) {
            const imgData = xhr.response; // retrieve the binary image data
            const imgUrl = URL.createObjectURL(imgData); // create an object URL for the image data
            const a = window.open('', '', 'height=1480, width=1000');
            a.document.write('<html>');
            a.document.write('<div style="margin:0">');
            arrayOfBarcode.forEach(function(imageHtml) {
                a.document.write(imageHtml); // display the image in the new window
            });
            a.document.write('</div></html>');
            a.document.close();
            setTimeout(() => {
                a.print();
            }, 3000); // wait for 5 seconds before showing the print dialog
            URL.revokeObjectURL(imgUrl); // release the object URL to free up memory
        }
    };
    xhr.send();
}
</script>
<style>
@page {
    size: auto;
    /* auto is the initial value */
    margin: 0mm;
    padding: 0;
    /* this affects the margin in the printer settings */
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