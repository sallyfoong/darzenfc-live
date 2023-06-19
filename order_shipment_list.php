<?php 
$pagePin = '20';

include 'include/connection.php';

$actionUrl = 'order_shipment';

$sub_title = "Order / Shipment";
$action_dis = "Product Name Record";
$datainfo = "SELECT `id`, `name`, `brand`, `each_weight`, `each_amount`, `each_unit_of_measurement`, `each_cost`, `each_cost_currency`, `main_item_name`, `main_item_amount`, `main_item_unit_of_measurement`, `main_item_cost`, `sub_item_name`, `sub_item_amount`, `sub_item_unit_of_measurement`, `sub_item_price`, `create_date`, `create_time`, `create_by`, `update_date`, `update_time`, `update_by`, `status` FROM product  WHERE status ='A' ORDER BY id DESC";

$query = mysqli_query($connect,$datainfo); 
$rownumber = 0;

$status = input('status');
if($status == 'deleted'){
    echo '<script language="javascript">';
    echo 'alert("Deleted Successfully");';
    echo '</script>';
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php echo $header; ?>

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
            <?php echo $breadcrumb;?>
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-4 col-sm-12 d-grid mt-2 mb-2">
                                    <a href="<?php echo $actionUrl; ?>.php">
                                        <button type="button" class="btn btn-lg btn-success text-white" id="ts-info">
                                            Add <?php echo $sub_title; ?>
                                        </button>
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="display:none;">ID</th>
                                                <th>S/N</th>
                                                <th>Action</th>
                                                <th>Product Name</th>
                                                <th>Brand</th>
                                                <th>Each Weight (gram)</th>
                                                <th>Each Amount</th>
                                                <th>Each (Unit)</th>
                                                <th>Each Cost</th>
                                                <th>Each Cost Currency (Unit)</th>
                                                <th>Main Item Name</th>
                                                <th>Main Item Amount</th>
                                                <th>Main Item (Unit)</th>
                                                <th>Main Item Cost (1 unit)</th>
                                                <th>Sub Item Name</th>
                                                <th>Sub Item Amount</th>
                                                <th>Sub Item (Unit)</th>
                                                <th>Sub Item Cost (1 unit)</th>
                                                <th>Create date</th>
                                                <th>Create by</th>
                                                <th>Update date</th>
                                                <th>Update by</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($row = mysqli_fetch_array($query))
                                            { $rownumber++;  ?>
                                            <tr>
                                                <td style="display:none;"><?php echo $row['id'];$txtid=$row['id']; ?>
                                                </td>
                                                <td><?php echo $rownumber; ?></td>
                                                <td> <a href="<?php echo $actionUrl; ?>.php?id=<?php echo $txtid;?>&mode=edit"
                                                        title="Edit EPF"><span class="fas fa-pencil-alt"></span></a>
                                                    <a href="<?php echo SITEURL; ?>/deleteaction.php?id=<?php echo $txtid;?>&source=<?php echo $sub_title; ?>"
                                                        onclick="return confirm('Are you sure want to delete <?php echo $action_dis; ?> (<?php echo $row['name']; ?>) ?');"
                                                        title="Delete <?php echo $action_dis; ?>"><span
                                                            class="fas fa-trash-alt"></span></a>
                                                </td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo getBrandName($row['brand']); ?></td>
                                                <td><?php echo $row['each_weight']; ?></td>
                                                <td><?php echo $row['each_amount']; ?></td>
                                                <td><?php echo getUnitOfMeasurementName($row['each_unit_of_measurement']); ?>
                                                </td>
                                                <td><?php echo $row['each_cost']; ?></td>
                                                <td><?php echo getCurrencyName($row['each_cost_currency']); ?></td>
                                                <td><?php echo getProductItemName($row['main_item_name']); ?></td>
                                                <td><?php echo $row['main_item_amount']; ?></td>
                                                <td><?php echo getUnitOfMeasurementName($row['main_item_unit_of_measurement']); ?>
                                                </td>
                                                <td><?php echo $row['main_item_cost']; ?></td>
                                                <td><?php echo getProductItemName($row['sub_item_name']); ?></td>
                                                <td><?php echo $row['sub_item_amount']; ?></td>
                                                <td><?php echo getUnitOfMeasurementName($row['sub_item_unit_of_measurement']); ?>
                                                </td>
                                                <td><?php echo $row['sub_item_price']; ?></td>
                                                <td><?php echo $row['create_date']." ".$row['create_time']; ?></td>
                                                <td><?php echo getUserName($row['create_by']); ?></td>
                                                <td><?php echo $row['update_date']." ".$row['update_time']; ?></td>
                                                <td><?php echo getUserName($row['update_by']); ?></td>
                                            </tr>
                                            <?php  } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="display:none;">ID</th>
                                                <th>S/N</th>
                                                <th>Action</th>
                                                <th>Product Name</th>
                                                <th>Brand</th>
                                                <th>Each Weight (gram)</th>
                                                <th>Each Amount</th>
                                                <th>Each (Unit)</th>
                                                <th>Each Cost</th>
                                                <th>Each Cost Currency (Unit)</th>
                                                <th>Main Item Name</th>
                                                <th>Main Item Amount</th>
                                                <th>Main Item (Unit)</th>
                                                <th>Main Item Cost (1 unit)</th>
                                                <th>Sub Item Name</th>
                                                <th>Sub Item Amount</th>
                                                <th>Sub Item (Unit)</th>
                                                <th>Sub Item Cost (1 unit)</th>
                                                <th>Create date</th>
                                                <th>Create by</th>
                                                <th>Update date</th>
                                                <th>Update by</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $(document).ready(function() {

        $("#zero_config").DataTable({
            "bAutoWidth": false,
            "order": []
        });
    });
    </script>
</body>

</html>