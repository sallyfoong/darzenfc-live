<?php
$multiArray = array(
    array(
        'Dashboard',
        'mdi mdi-view-dashboard',
        'dashboard.php',
        'n',
        'expand' => array(),
        'pin' => array('0'),
    ),
    array(
        'Setting',
        'mdi mdi-settings',
        'javascript:void(0)',
        'y',
       'expand' => array(
            array('Currency', 'mdi mdi-domain', 'currency_list.php','18'),
            array('Platform', 'mdi mdi-domain', 'platform_list.php','15'),
            array('Department', 'mdi mdi-domain', 'department_list.php','9'),
            array('Marital Status', 'mdi mdi-account-multiple', 'marital_status_list.php','11'),
            array('Employment Type Status', 'mdi mdi-account-settings-variant', 'employment_type_list.php','10'),
            array('Bank', 'mdi mdi-bank', 'bank_list.php','8'),
            array('Leave Type', 'mdi mdi-calendar-clock', 'leave_type_list.php','6'),
            array('EPF', 'mdi mdi-pot-mix', 'epf_rate_list.php','4'),
            array('Pin', 'mdi mdi-pin', 'pin_list.php','3'),
            array('User Group', 'mdi mdi-ungroup', 'usergroup_list.php','2'),
            array('User', 'mdi mdi-clipboard-account', 'user_list.php','1')
        ),
        'pin' => array('5','4','3','2','1','6','8','10','11','9','15','18'),
    ),
    array(
        'Employee',
        'mdi mdi-account-box',
        'employee_list.php',
        'n',
        'expand' => array(),
        'pin' => array('7'),
    ),
array(
"Product",
 'mdi mdi-codepen',
        'javascript:void(0)',
        'y',
       'expand' => array(
array('Brand', 'mdi mdi-domain', 'brand_list.php','12'),
array('Item', 'mdi mdi-domain', 'item_list.php','16'),
array('Create Barcode', 'mdi mdi-domain', 'generateBarcode.php','19'),
array('Product Name', 'mdi mdi-domain', 'product_list.php','18'),
),
        'pin' => array('12','16','18','19'),
),array(
"Product",
 'mdi mdi-codepen',
        'javascript:void(0)',
        'y',
       'expand' => array(
array('Brand', 'mdi mdi-domain', 'brand_list.php','12'),
array('Item', 'mdi mdi-domain', 'item_list.php','16'),
array('Create Barcode', 'mdi mdi-domain', 'generateBarcode.php','19'),
array('Product Name', 'mdi mdi-domain', 'product_list.php','18'),
),
        'pin' => array('12','16','18','19'),
),array(
    "Order",
     'mdi mdi-codepen',
            'javascript:void(0)',
            'y',
           'expand' => array(
    array('Order / Shipment', 'mdi mdi-domain', 'order_shipment_list.php','20'),
    ),
            'pin' => array('20'),
    ),
);

ob_start(); ?>

<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <?php 
                foreach ($multiArray as $key =>$innerArray) {
                    if(!empty(array_intersect($innerArray['pin'], GlobalPin))){
                    $extendMore = "";
                    $extendMore = $innerArray[3]=='y'?" has-arrow":"";
                    echo "<li class=\"sidebar-item\"><a class=\"sidebar-link ".$extendMore." waves-effect waves-dark\" href=\"".$innerArray[2]."\" aria-expanded=\"false\"><i class=\"".$innerArray[1]."\"></i><span class=\"hide-menu\">".$innerArray[0]."<span></a>"; 
                    echo "<ul aria-expandsed=\"false\" class=\"collapse first-level\">";
                    foreach ($innerArray['expand'] as $act=>$url) {      
                        if (in_array($url[3], GlobalPin)) {            
                        echo "<li class=\"sidebar-item\"><a href=\"".$url[2]."\" class=\"sidebar-link\"><i class=\"".$url[1]."\"></i><span class=\"hide-menu\"> ".$url[0]." </span></a></li>";
                        }
                    }
                    echo "</ul>";
                    echo "</li>";
                 }
                }
                ?>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<?php $sideMenu = ob_get_clean(); ?>