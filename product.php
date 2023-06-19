<?php
$pagePin = '13';

include 'include/connection.php'; 

$page_action = 'Add';
$page_title = 'Product Name';
$sub_db = PRODUCT; 
$back_url = SITEURL."/product_list.php";
$error_message = '';
$mode = input('mode');
$txtgetID = input('id');
$page_action = $mode == 'edit' ? 'Edit' : 'Add';
$txtid = $txtname = $txtemployer = $txtemployee = '';

$tblname1 = $sub_db;
$tblname3 = BRAND;
$tblname4 = UNITOFMEASUREMENT;
$tblname5 = CURRENCY;
$tblname8 = ITEM;
$screen_type1 = 'Add '.$page_title;
$screen_type2 = 'Edit '.$page_title;


if(isset($_POST['save'])){
    $name = post('name');
    $brand = post('brand');
    $each_weight = post('each_weight');
    $each_amount = post('each_amount');
    $each_unit_of_measurement = post('each_unit_of_measurement');
    $each_cost = post('each_cost');
    $each_cost_currency = post('each_cost_currency');
    $main_item_name = post('main_item_name');
    $main_item_amount = post('main_item_amount');
    $main_item_unit_of_measurement = post('main_item_unit_of_measurement');
    $main_item_cost = post('main_item_cost');
    $sub_item_name = post('sub_item_name');
    $sub_item_amount = post('sub_item_amount');
    $sub_item_unit_of_measurement = post('sub_item_unit_of_measurement');
    $sub_item_price = post('sub_item_price');
    
    if($name && $brand){
        if(mysqli_num_rows(mysqli_query($connect,"SELECT id FROM ".$sub_db." WHERE name = '".$name."' AND brand='".$brand."' AND status = 'A'"))==0){
            $dataInfo = "INSERT INTO ".$sub_db." (name, brand, each_weight, each_amount, each_unit_of_measurement, each_cost, each_cost_currency, main_item_name, main_item_amount, main_item_unit_of_measurement, main_item_cost, sub_item_name, sub_item_amount, sub_item_unit_of_measurement, sub_item_price, create_date, create_time, create_by, status) VALUES ('".$name."', '".$brand."', '".$each_weight."', '".$each_amount."', '".$each_unit_of_measurement."', '".$each_cost."', '".$each_cost_currency."', '".$main_item_name."', '".$main_item_amount."', '".$main_item_unit_of_measurement."', '".$main_item_cost."', '".$sub_item_name."', '".$sub_item_amount."', '".$sub_item_unit_of_measurement."', '".$sub_item_price."', '".$cdate."', '".$ctime."', '".$cby."', 'A')";
            $query1 = mysqli_query($connect,$dataInfo);
            if ($query1){ 
                echo '<script language="javascript">';
                    echo 'alert("Insert sucessful");';
                    echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("Fail to Insert");';
                echo '</script>';
            }

            //Audit	
            $new_value71 = $cdate;
            $changes4   = "Create Date: ".$new_value71;
            
            $new_value72 = $ctime;
            $changes5  = "Create Time: ".$new_value72;
            
            $new_value73 = $cby;
            $changes6   = "Create By: ".$new_value73;
            
            $new_value1 = $txtname;
            $changes1   = "Name: ".$new_value1; 
            
            $new_value2 = $brand;
            $changes2   = "Brand: ".$new_value2;
            
            $new_value3 = $each_weight;
            $changes3   = "Each Weight: ".$new_value3;
            
            $new_value4 = $each_amount;
            $changes4   = "Each Amount: ".$new_value4;
            
            $new_value5 = $each_amount;
            $changes5   = "Each Amount: ".$new_value5;
            
            $new_value6 = $each_unit_of_measurement;
            $changes6   = "Each Unit of Measurement: ".$new_value6;
            
            $new_value7 = $each_cost;
            $changes7   = "Each Cost: ".$new_value7;
            
            $new_value8 = $each_cost_currency;
            $changes8   = "Each Cost Currency: ".$new_value8;
            
            $new_value9 = $main_item_name;
            $changes9   = "Main Item Name: ".$new_value9;
            
            $new_value10 = $main_item_amount;
            $changes10   = "Main Item Amount: ".$new_value10;
            
            $new_value11 = $main_item_unit_of_measurement;
            $changes11   = "Main Item Unit of Measurement: ".$new_value11;
            
            $new_value12 = $main_item_cost;
            $changes12   = "Main Item Cost: ".$new_value12;
            
            $new_value13 = $sub_item_name;
            $changes13   = "Sub Item Name: ".$new_value13;
            
            $new_value14 = $sub_item_unit_of_measurement;
            $changes14   = "Sub Item Unit of Measurement: ".$new_value14;
            
            $new_value15 = $sub_item_price;
            $changes15   = "Sub Item Cost: ".$new_value15;
        
                        
            $new_value  = $new_value71.",".$new_value72.",".$new_value73.",".$new_value1.",".$new_value2.",".$new_value4.",".$new_value5.",".$new_value6.",".$new_value7.",".$new_value8.",".$new_value9.",".$new_value10.",".$new_value11.",".$new_value12.",".$new_value13.",".$new_value14.",".$new_value15;
            $new_value  = rtrim($new_value,',');
            $changes    = $changes71.",".$changes72.",".$changes73.",".$changes1.",".$changes2.",".$changes3.",".$changes4.",".$changes5.",".$changes6.",".$changes7.",".$changes8.",".$changes9.",".$changes10.",".$changes11.",".$changes12.",".$changes13.",".$changes14.",".$changes15;
            $changes    = rtrim($changes,',');
            $changes_arr = array_filter(explode(',', $changes));
            $changes_str = implode($changes_arr,',');
            
            $sqladd = $dataInfo;
            $old_value = '';
            audit_log('true',$screen_type1,$act_1,$tblname1,$dataInfo,$old_value,$new_value,$changes,$screen_type1);
            
        }else{
            echo '<script language="javascript">';
            echo 'alert("Fail to Insert [Duplicate Data Info]");';
            echo '</script>';
        }
    }else{
        echo '<script language="javascript">';
        echo 'alert("Fail to connect database.");';
        echo '</script>';
    }
}

if(isset($_POST['edit'])){
    $txtid = $_POST['txtid'];
    $name = post('name');
    $brand = post('brand');
    $each_weight = post('each_weight');
    $each_amount = post('each_amount');
    $each_unit_of_measurement = post('each_unit_of_measurement');
    $each_cost = post('each_cost');
    $each_cost_currency = post('each_cost_currency');
    $main_item_name = post('main_item_name');
    $main_item_amount = post('main_item_amount');
    $main_item_unit_of_measurement = post('main_item_unit_of_measurement');
    $main_item_cost = post('main_item_cost');
    $sub_item_name = post('sub_item_name');
    $sub_item_amount = post('sub_item_amount');
    $sub_item_unit_of_measurement = post('sub_item_unit_of_measurement');
    $sub_item_price = post('sub_item_price');

    $org_name = post('org_name');
    $org_brand = post('org_brand');
    $org_each_weight = post('org_each_weight');
    $org_each_amount = post('org_org_each_amount');
    $org_each_unit_of_measurement = post('each_unit_of_measurement');
    $org_each_cost = post('org_each_cost');
    $org_each_cost_currency = post('org_each_cost_currency');
    $org_main_item_name = post('org_main_item_name');
    $org_main_item_amount = post('org_main_item_amount');
    $org_main_item_unit_of_measurement = post('org_main_item_unit_of_measurement');
    $org_main_item_cost = post('org_main_item_cost');
    $org_sub_item_name = post('org_sub_item_name');
    $org_sub_item_amount = post('org_sub_item_amount');
    $org_sub_item_unit_of_measurement = post('org_sub_item_unit_of_measurement');
    $org_sub_item_price = post('org_sub_item_price');
    
    if(($name != $org_name) || ($brand != $org_brand) || ($each_weight != $org_each_weight) || ($each_amount != $org_each_amount) || ($each_unit_of_measurement != $org_each_unit_of_measurement) || ($each_cost != $org_each_cost) || ($each_cost_currency != $org_each_cost_currency) || ($main_item_name != $org_main_item_name) || ($main_item_amount != $org_main_item_amount) || ($main_item_unit_of_measurement != $org_main_item_unit_of_measurement) || ($main_item_cost != $org_main_item_cost) || ($sub_item_name != $org_sub_item_name) || ($sub_item_amount != $org_sub_item_amount) || ($sub_item_unit_of_measurement != $org_sub_item_unit_of_measurement) || ($sub_item_price != $org_sub_item_price)){

      if(mysqli_num_rows(mysqli_query($connect,"SELECT id FROM ".$sub_db." WHERE name = '".$name."' AND remark='".$remark."' AND status = 'A'"))==0){
          $sqlupd = "UPDATE ".$sub_db." SET name = '".$name."', brand = '".$brand."', each_weight = '".$each_weight."', each_amount = '".$each_amount."', each_unit_of_measurement = '".$each_unit_of_measurement."', each_cost = '".$each_cost."', each_cost_currency = '".$each_cost_currency."', main_item_name = '".$main_item_name."', main_item_amount = '".$main_item_amount."', main_item_unit_of_measurement = '".$main_item_unit_of_measurement."', main_item_cost = '".$main_item_cost."', sub_item_name = '".$sub_item_name."', sub_item_amount = '".$sub_item_amount."', sub_item_unit_of_measurement = '".$sub_item_unit_of_measurement."', sub_item_price = '".$sub_item_price."', update_date = '".$cdate."', update_time = '".$ctime."', update_by = '".$cby."' WHERE id = '".$txtid."' AND status = 'A'";
          $query2 = mysqli_query($connect,$sqlupd);
          if ($query2){
              echo '<script language="javascript">';
                  echo 'alert("Update sucessful");document.location="'.$back_url.'";';
                  echo '</script>';
                  
                //Audit	
               // Comparison for first set of variables
                $old_value1 = $org_name;
                $new_value1 = $name;
                if($old_value1 == $new_value1){
                    $changes1 = '';
                } else {
                    $changes1 = "Name: ".$old_value1." to ".$new_value1;
                }

                $old_value2 = $org_brand;
                $new_value2 = $brand;
                if($old_value2 == $new_value2){
                    $changes2 = '';
                } else {
                    $changes2 = "Brand: ".$old_value2." to ".$new_value2;
                }

                $old_value3 = $org_each_weight;
                $new_value3 = $each_weight;
                if($old_value3 == $new_value3){
                    $changes3 = '';
                } else {
                    $changes3 = "Each weight: ".$old_value3." to ".$new_value3;
                }

                $old_value4 = $org_each_amount;
                $new_value4 = $each_amount;
                if($old_value4 == $new_value4){
                    $changes4 = '';
                } else {
                    $changes4 = "Each amount: ".$old_value4." to ".$new_value4;
                }

                $old_value5 = $org_each_unit_of_measurement;
                $new_value5 = $each_unit_of_measurement;
                if($old_value5 == $new_value5){
                    $changes5 = '';
                } else {
                    $changes5 = "Each unit of measurement: ".$old_value5." to ".$new_value5;
                }

                $old_value6 = $org_each_cost;
                $new_value6 = $each_cost;
                if($old_value6 == $new_value6){
                    $changes6 = '';
                } else {
                    $changes6 = "Each cost: ".$old_value6." to ".$new_value6;
                }

                $old_value7 = $org_each_cost_currency;
                $new_value7 = $each_cost_currency;
                if($old_value7 == $new_value7){
                    $changes7 = '';
                } else {
                    $changes7 = "Each cost currency: ".$old_value7." to ".$new_value7;
                }

                $old_value8 = $org_main_item_name;
                $new_value8 = $main_item_name;
                if($old_value8 == $new_value8){
                    $changes8 = '';
                } else {
                    $changes8 = "Main item name: ".$old_value8." to ".$new_value8;
                }

                $old_value9 = $org_main_item_amount;
                $new_value9 = $main_item_amount;
                if($old_value9 == $new_value9){
                    $changes9 = '';
                } else {
                    $changes9 = "Main item amount: ".$old_value9." to ".$new_value9;
                }

                $old_value10 = $org_main_item_unit_of_measurement;
                $new_value10 = $main_item_unit_of_measurement;
                if($old_value10 == $new_value10){
                    $changes10 = '';
                } else {
                    $changes10 = "Main item unit of measurement: ".$old_value10." to ".$new_value10;
                }

                $old_value11 = $org_main_item_cost;
                $new_value11 = $main_item_cost;
                if($old_value11 == $new_value11){
                    $changes11 = '';
                } else {
                    $changes11 = "Main item cost: ".$old_value11." to ".$new_value11;
                }

                $old_value12 = $org_sub_item_name;
                $new_value12 = $sub_item_name;
                if($old_value12 == $new_value12){
                    $changes12 = '';
                } else {
                    $changes12 = "Sub item name: ".$old_value12." to ".$new_value12;
                }

                $old_value13 = $org_sub_item_amount;
                $new_value13 = $sub_item_amount;
                if($old_value13 == $new_value13){
                    $changes13 = '';
                } else {
                    $changes13 = "Sub item amount: ".$old_value13." to ".$new_value13;
                }
                
                $old_value14 = $org_sub_item_unit_of_measurement;
                $new_value14 = $sub_item_unit_of_measurement;
                if($old_value14 == $new_value14){
                    $changes14 = '';
                } else {
                    $changes14 = "Sub item unit of measurement: ".$old_value14." to ".$new_value14;
                }

                $old_value15 = $org_sub_item_price;
                $new_value15 = $sub_item_price;
                if($old_value15 == $new_value15){
                    $changes15 = '';
                } else {
                    $changes15 = "Sub item cost: ".$old_value15." to ".$new_value15;
                }
                $old_value = '';

                for ($i = 1; $i <= 15; $i++) {
                if ($i > 1) {
                    $old_value .= ',';
                }
                $old_value .= '$old_value'.$i;
                }
                $old_value = rtrim($old_value,',');
                $new_value = '';
                for ($i = 1; $i <= 15; $i++) {
                if ($i > 1) {
                    $new_value .= ',';
                }
                $new_value .= '$new_value'.$i;
                }

                $new_value = rtrim($new_value,',');
                $changes   = $changes1.",".$changes2;
                $changes   = rtrim($changes,',');
                $changes_arr = array_filter(explode(',', $changes));
                $changes_str = implode($changes_arr,',');
                edit_log('true',$screen_type2,$act_2,$tblname1,$sqlupd,$old_value,$new_value,$changes,$page_title);	
                
            }else{
              echo '<script language="javascript">';
              echo 'alert("Fail to Update");';
              echo '</script>';
          }
      }else{
          echo '<script language="javascript">';
          echo 'alert("Fail to Update [No Data Info can be edit.]");';
          echo '</script>';
      }
  }else{
      echo '<script language="javascript">';
      echo 'alert("Fail to connect database.");';
      echo '</script>';
  }
  
}
if($mode == 'edit'){
    $datainfo = "SELECT `id`, `name`, `brand`, `each_weight`, `each_amount`, `each_unit_of_measurement`, `each_cost`, `each_cost_currency`, `main_item_name`, `main_item_amount`, `main_item_unit_of_measurement`, `main_item_cost`, `sub_item_name`, `sub_item_amount`, `sub_item_unit_of_measurement`, `sub_item_price`, `create_date`, `create_time`, `create_by`, `update_date`, `update_time`, `update_by`, `status` FROM ".$sub_db." WHERE id ='".$txtgetID."' AND STATUS = 'A' LIMIT 1 ";
    $rowRetrieveInfo = mysqli_query($connect, $datainfo);
    $data = mysqli_fetch_assoc($rowRetrieveInfo);

    $txtid = $data['id'];
    $name = $data['name'];
    $brand = $data['brand'];
    $each_weight = $data['each_weight'];
    $each_amount = $data['each_amount'];
    $each_unit_of_measurement = $data['each_unit_of_measurement'];
    $each_cost = $data['each_cost'];
    $each_cost_currency = $data['each_cost_currency'];
    $main_item_name = $data['main_item_name'];
    $main_item_amount = $data['main_item_amount'];
    $main_item_unit_of_measurement = $data['main_item_unit_of_measurement'];
    $main_item_cost = $data['main_item_cost'];
    $sub_item_name = $data['sub_item_name'];
    $sub_item_amount = $data['sub_item_amount'];
    $sub_item_unit_of_measurement = $data['sub_item_unit_of_measurement'];
    $sub_item_price = $data['sub_item_price'];


} 
  
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php echo $header; ?>
<script>
jQuery(document).ready(function() {
    jQuery("form").submit(function() {
        var nameId = '#txtname';
        var brandId = '#brand';
        var eachWeightId = '#each_weight';
        var eachAmountId = '#each_amount';
        var eachUnitOfMeasurementId = '#each_unit_of_measurement';
        var eachCostId = '#each_cost';
        var eachCostCurrencyId = '#each_cost_currency';

        if (jQuery(nameId).val() == "") {
            alert("Please fill the Name");
            jQuery(nameId).focus();
            return false;
        }
        if (jQuery(brandId).val() == "") {
            alert("Please fill the Brand");
            jQuery(brandId).focus();
            return false;
        }
        if (jQuery(eachWeightId).val() == "") {
            alert("Please fill the Each Weight");
            jQuery(eachWeightId).focus();
            return false;
        }
        if (jQuery(eachAmountId).val() == "") {
            alert("Please fill the Each Amount");
            jQuery(eachAmountId).focus();
            return false;
        }
        if (jQuery(eachUnitOfMeasurementId).val() == "") {
            alert("Please fill the Each Unit of Measurement");
            jQuery(eachUnitOfMeasurementId).focus();
            return false;
        }
        if (jQuery(eachCostId).val() == "") {
            alert("Please fill the Each Cost");
            jQuery(eachCostId).focus();
            return false;
        }
        if (jQuery(eachCostCurrencyId).val() == "") {
            alert("Please fill the Each Cost Currency");
            jQuery(eachCostCurrencyId).focus();
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
                                <h4 class="card-title"><?php echo $page_action.' '.$page_title; ?></h4>
                                <form id="epfform" method="POST">
                                    <input type="text" name="txtid" value="<?php echo $txtid; ?>" class="dnone">
                                    <div class="row">
                                        <div class="form-group col-lg-4">
                                            <label for="hue-demo">Product Name</label>
                                            <input type="text" name="name" id="txtname" class="form-control demo"
                                                data-control="hue" required autofocus value="<?php echo $name; ?>" />
                                            <input type="text" name="org_txtname" value="<?php echo $name; ?>"
                                                class="dnone">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="hue-demo">Brand</label>
                                            <select name="brand" id="brand" class="form-control">
                                                <?php
                                                $query = "SELECT `id`, `name` FROM ".$tblname3." WHERE status = 'A'";
                                                $result = mysqli_query($connect, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($brand == $row['id']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="text" name="org_brand" value="<?php echo $brand ; ?>"
                                                class="dnone">
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="hue-demo">Each Weight (gram)</label>
                                            <input type="text" name="each_weight" id="each_weight"
                                                class="form-control demo" data-control="hue"
                                                value="<?php echo $each_weight ; ?>" />
                                            <input type="text" name="org_each_weight"
                                                value="<?php echo $each_weight ; ?>" class="dnone">
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="hue-demo">Each Amount</label>
                                            <input type="text" name="each_amount" id="each_amount"
                                                class="form-control demo" data-control="hue"
                                                value="<?php echo $each_amount ; ?>" />
                                            <input type="text" name="org_each_amount"
                                                value="<?php echo $each_amount ; ?>" class="dnone">
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="hue-demo">Each Unit of Measurement</label>
                                            <select name="each_unit_of_measurement" id="each_unit_of_measurement"
                                                class="form-control">
                                                <?php
                                                $query = "SELECT `id`, `name` FROM ".$tblname4." WHERE status = 'A'";
                                                $result = mysqli_query($connect, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($each_unit_of_measurement == $row['id']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="text" name="org_each_unit_of_measurement"
                                                value="<?php echo $each_unit_of_measurement ; ?>" class="dnone">
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="hue-demo">Each Cost</label>
                                            <input type="text" name="each_cost" id="each_cost" class="form-control demo"
                                                data-control="hue" value="<?php echo $each_cost ; ?>" />
                                            <input type="text" name="org_each_cost" value="<?php echo $each_cost ; ?>"
                                                class="dnone">
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="hue-demo">Each Cost Currency</label>
                                            <select name="each_cost_currency" id="each_cost_currency"
                                                class="form-control">
                                                <?php
                                                $query = "SELECT `id`, `name` FROM ".$tblname5." WHERE status = 'A'";
                                                $result = mysqli_query($connect, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($each_cost_currency == $row['id']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="text" name="org_each_cost_currency"
                                                value="<?php echo $each_cost_currency ; ?>" class="dnone">
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="hue-demo">Main Item Name</label>
                                            <select name="main_item_name" id="main_item_name" class="form-control">
                                                <?php
                                                $query = "SELECT `id`, `name` FROM ".$tblname8." WHERE status = 'A'";
                                                $result = mysqli_query($connect, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($main_item_name == $row['id']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="text" name="org_main_item_name"
                                                value="<?php echo $main_item_name ; ?>" class="dnone">
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="hue-demo">Main Item Amount</label>
                                            <input type="text" name="main_item_amount" id="main_item_amount"
                                                class="form-control demo" data-control="hue"
                                                value="<?php echo $main_item_amount ; ?>" />
                                            <input type="text" name="org_main_item_amount"
                                                value="<?php echo $main_item_amount ; ?>" class="dnone">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="main_item_unit_of_measurement">Main Item Unit of
                                                Measurement</label>
                                            <select name="main_item_unit_of_measurement"
                                                id="main_item_unit_of_measurement" class="form-control">
                                                <?php
                                                $query = "SELECT `id`, `name` FROM ".$tblname4." WHERE status = 'A'";
                                                $result = mysqli_query($connect, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($main_item_unit_of_measurement == $row['id']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="text" name="org_main_item_unit_of_measurement"
                                                value="<?php echo $main_item_unit_of_measurement; ?>" class="dnone">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="main_item_cost">Main Item Cost (1 unit)</label>
                                            <input type="text" name="main_item_cost" id="main_item_cost"
                                                class="form-control demo" data-control="hue"
                                                value="<?php echo $main_item_cost; ?>" />
                                            <input type="text" name="org_main_item_cost"
                                                value="<?php echo $main_item_cost; ?>" class="dnone">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="sub_item_name">Sub Item Name</label>
                                            <select name="sub_item_name" id="main_item_namesub_item_name"
                                                class="form-control">
                                                <?php
                                                $query = "SELECT `id`, `name` FROM ".$tblname8." WHERE status = 'A'";
                                                $result = mysqli_query($connect, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($sub_item_name == $row['id']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="text" name="org_sub_item_name"
                                                value="<?php echo $sub_item_name; ?>" class="dnone">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="sub_item_amount">Sub Item Amount</label>
                                            <input type="text" name="sub_item_amount" id="sub_item_amount"
                                                class="form-control demo" data-control="hue"
                                                value="<?php echo $sub_item_amount; ?>" />
                                            <input type="text" name="org_sub_item_amount"
                                                value="<?php echo $sub_item_amount; ?>" class="dnone">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="sub_item_unit_of_measurement">Sub Item Unit of
                                                Measurement</label>
                                            <select name="sub_item_unit_of_measurement"
                                                id="sub_item_unit_of_measurement" class="form-control">
                                                <?php
                                                $query = "SELECT `id`, `name` FROM ".$tblname4." WHERE status = 'A'";
                                                $result = mysqli_query($connect, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($sub_item_unit_of_measurement == $row['id']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="text" name="org_sub_item_unit_of_measurement"
                                                value="<?php echo $sub_item_unit_of_measurement; ?>" class="dnone">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="sub_item_price">Sub Item Cost (1 unit)</label>
                                            <input type="text" name="sub_item_price" id="sub_item_price"
                                                class="form-control demo" data-control="hue"
                                                value="<?php echo $sub_item_price; ?>" />
                                            <input type="text" name="org_sub_item_price"
                                                value="<?php echo $sub_item_price; ?>" class="dnone">
                                        </div>

                                        <div>
                                            <?php if($mode != 'edit'){ ?>
                                            <button type="submit" name="save" class="btn btn-success text-white">
                                                Save
                                            </button>
                                            <?php }else{ ?>
                                            <button type="submit" name="edit" class="btn btn-info">Update</button>
                                            <?php } ?>
                                            <button type="reset" name="reset" id="resetForm"
                                                class="btn btn-primary">Reset</button>
                                            <a href="<?php echo $back_url;?>">
                                                <button type="button" name="cancel" class="btn btn-danger text-white">
                                                    Cancel
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
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
            $('#txtname').val('');
            $('#brand').val('');
            $('#each_weight').val('');
            $('#each_amount').val('');
            $('#each_unit_of_measurement').val('');
            $('#each_cost').val('');
            $('#each_cost_currency').val('');
            $('#main_item_name').val('');
            $('#main_item_amount').val('');
            $('#main_item_unit_of_measurement').val('');
            $('#main_item_cost').val('');
            $('#sub_item_name').val('');
            $('#sub_item_amount').val('');
            $('#sub_item_unit_of_measurement').val('');
            $('#sub_item_price').val('');
        });
        </script>
</body>

</html>