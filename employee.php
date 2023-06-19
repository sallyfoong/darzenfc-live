<?php
$pagePin = '7';

include 'include/connection.php'; 

$page_action = 'Add';
$page_title = 'Employee';
$sub_db = 'employee'; 
$back_url = SITEURL."/employee_list.php";
$error_message = '';
$mode = input('mode');
$txtgetID = input('id');
$page_action = $mode == 'edit' ? 'Edit' : 'Add';
$txtid = $txtname = $surename = $txtic = $txtemail = $phone_no = $alt_phone_no = $gender = $birthday = $addressLine1 = $addressLine2 = $marital_status = $employment_type = $txtdepartment = $position = $allowance = $txtbankName = $bankACC = $epfAcc = $txtepfRate = $socsoACC = $incomeTaxNum = $txtAL = $txtML = $txtHospitalLeave = $txtpaternityLeave = $txtmaternityLeave = $txtcompassonateLeave = $reportTo = $txtremark = $txtsalary = '';

$tblname1 = $sub_db;
$tblname2 = 'marital_status';
$tblname3 = 'employment_type';
$tblname4 = 'department';
$tblname5 = 'bank';
$tblname6 = 'epf_rate';
$tblname7 = 'user';
$screen_type1 = 'Add '.$page_title;
$screen_type2 = 'Edit '.$page_title;
$sub_db_2 = 'salary_type';
$sub_db_3 = ' allowence';

if(isset($_POST['save'])){
    $txtname = post('txtname');
    $surename = post('surename');
    $txtic = post('txtic');
    $txtemail = post('txtemail');
    $phone_no = post('phone_no');
    $alt_phone_no = post('alt_phone_no');
    $gender = post('gender');
    $birthday = post('birthday');
    $addressLine1 = post('addressLine1');
    $addressLine2 = post('addressLine2');
    $marital_status = post('marital_status');
    $employment_type = post('employment_type');
    $txtdepartment = post('txtdepartment');
    $position = post('position');
    $allowance = post('allowance');
    $txtbankName = post('txtbankName');
    $bankACC = post('bankACC');
    $epfAcc = post('epfAcc');
    $txtepfRate = post('txtepfRate');
    $socsoACC = post('socsoACC');
    $incomeTaxNum = post('incomeTaxNum');
    $txtAL = post('txtAL');
    $txtML = post('txtML');
    $txtsalary = post('txtsalary');
    $txtHospitalLeave = post('txtHospitalLeave');
    $txtpaternityLeave = post('txtpaternityLeave');
    $txtmaternityLeave = post('txtALtxtmaternityLeave');
    $txtcompassonateLeave = post('txtcompassonateLeave');
    $reportTo =  $_POST['reportTo'];
    $txtremark = post('txtremark');
    sort($reportTo);
	$reportTo_arr = implode(",",$reportTo); 
    
    if($txtname && $txtic && $phone_no && $employment_type && $txtsalary && $reportTo_arr && $gender && $bankACC && $txtbankName && $txtdepartment){
        $checkExistQuery = "SELECT id FROM ".$sub_db." WHERE name = '".$txtname."' AND ic='".$txtic."' AND phone_no='".$phone_no."' AND bank_account_number='".$bankACC."' AND status = 'A'";
        if(mysqli_num_rows(mysqli_query($connect,$checkExistQuery))==0){
            //INSERT INTO EMPLOYEE TABLE
           $dataInfo = "INSERT INTO ".$sub_db." (name, surename, ic, email, phone_no, alt_phone_no, gender, birthday, address_line1, address_line2, marital_status_id, employment_type_id, department_id, position, bank_id, bank_account_number, kwsp_no, epf_rate_id, socso_no, income_tax_no, leave_annual, leave_mc, leave_hospital, leave_paternity, leave_maternity, leave_compassionate, reportingTo, remark, create_date, create_time, create_by, status) VALUES ('".$txtname."', '".$surename."', '".$txtic."', '".$txtemail."', '".$phone_no."', '".$alt_phone_no."', '".$gender."', '".$birthday."', '".$addressLine1."', '".$addressLine2."', '".$marital_status."', '".$employment_type."', '".$txtdepartment."', '".$position."', '".$txtbankName."', '".$bankACC."', '".$epfAcc."', '".$txtepfRate."', '".$socsoACC."', '".$incomeTaxNum."', '".$txtAL."', '".$txtML."', '".$txtHospitalLeave."', '".$txtpaternityLeave."', '".$txtmaternityLeave."', '".$txtcompassonateLeave."', '".$reportTo_arr."', '".$txtremark."', '".$cdate."', '".$ctime."', '".$cby."', 'A')";
            
            $query1 = mysqli_query($connect,$dataInfo);
            if ($query1) {
                $last_insert_id = mysqli_insert_id($connect);
                //INSERT INTO SALARY TABLE
                $dataInfo_2 = "INSERT INTO ".$sub_db_2." (employee_id, salary_amount, create_date, create_time, create_by, status) VALUES ('".$last_insert_id."', '".$txtsalary."', '".$cdate."', '".$ctime."', '".$cby."', 'A')";
                $query2 = mysqli_query($connect,$dataInfo_2);

                //INSERT INTO Allowance TABLE
                $dataInfo_3 = "INSERT INTO ".$sub_db_3." (employee_id, allowance_amount, create_date, create_time, create_by, status) VALUES ('".$last_insert_id."', '".$allowance."', '".$cdate."', '".$ctime."', '".$cby."', 'A')";
                $query3 = mysqli_query($connect,$dataInfo_3);

                if ($query2 && $query3){ 
                    echo '<script language="javascript">';
                        echo 'alert("Insert sucessful");';
                        echo '</script>';
                }else{
                    echo '<script language="javascript">';
                    echo 'alert("Fail to Insert");';
                    echo '</script>';
                }
            }else{
                echo '<script language="javascript">';
                echo 'alert("Fail to Insert");';
                echo '</script>';
            }

            //Audit	
            $new_value_cdate = $cdate;
            $changes_date   = "Create Date: ".$new_value_cdate;
            
            $new_value_ctime = $ctime;
            $changes_ctime  = "Create Time: ".$new_value_ctime;
            
            $new_value_cby = $cby;
            $changes_cby   = "Create By: ".$new_value_cby;
                        

            $new_value1 = $txtname;
            $changes1   = "Name: ".$new_value1; 
            
            $new_value2 = $surename;
            $changes2   = "Surename: ".$new_value2;

            $new_value3 = $txtic;
            $changes3   = "IC: ".$new_value3;
            
            $new_value4 = $txtemail;
            $changes4   = "Email: ".$new_value4;
            
            $new_value5 = $phone_no;
            $changes5   = "Phone Number: ".$new_value5;
            
            $new_value6 = $alt_phone_no;
            $changes6   = "Alternate Phone Number: ".$new_value6;
            
            $new_value7 = getGenderName($gender);
            $changes7   = "Gender: ".$new_value7;
            
            $new_value8 = $birthday;
            $changes8   = "Birthday: ".$new_value8;
            
            $new_value9 = getMaritalStatusName($marital_status);
            $changes9   = "Marital Status: ".$new_value9;
            
            $new_value10 = $addressLine1;
            $changes10   = "Address Line 1: ".$new_value10;
            
            $new_value11 = $addressLine2;
            $changes11   = "Address Line 2: ".$new_value11;
            
            $new_value12 = $txtdepartment;
            $changes12   = "Department: ".$new_value12;

            $new_value13 = $allowance;
            $changes13   = "Allowance: ".$new_value13;
            
            $new_value14 = $position;
            $changes14   = "Position: ".$new_value14;
            
            $new_value15 = $txtsalary;
            $changes15   = "Salary: ".$new_value15;
            
            $new_value16 = $txtbankName;
            $changes16   = "Bank Name: ".$new_value16;
            
            $new_value17 = $bankACC;
            $changes17   = "Bank Account Number: ".$new_value17;
            
            $new_value18 = $epfAcc;
            $changes18   = "EPF Account Number: ".$new_value18;
            
            $new_value19 = $txtepfRate;
            $changes19   = "EPF Rate: ".$new_value19;
            
            $new_value20 = $socsoACC;
            $changes20   = "SOCSO Account Number: ".$new_value20;
            
            $new_value21 = $incomeTaxNum;
            $changes21   = "Income Tax Number / LHDN Employer Number: ".$new_value21;
            
            $new_value22 = $txtAL;
            $changes22   = "Annual Leave: ".$new_value22;
            
            $new_value23 = $txtML;
            $changes23   = "Medical Leave: ".$new_value23;
            
            $new_value24 = $txtHospitalLeave;
            $changes24   = "Hospital Leave: ".$new_value24;
            
            $new_value25 = $txtpaternityLeave;
            $changes25  = "Paternity Leave: ".$new_value25;
            
            $new_value26 = $txtmaternityLeave;
            $changes26   = "Maternity Leave: ".$new_value26;
            
            $new_value27 = $txtcompassonateLeave;
            $changes27   = "Compassionate Leave: ".$new_value27;
            
            $new_value28 = $reportTo;
            $changes28   = "Report to: ".$new_value28;
            
            $new_value29 = $txtremark;
            $changes29   = "Remark: ".$new_value29;
            
            
            $new_value  = $new_value_cdate.",".$new_value_ctime.",".$new_value_cby.",".$new_value1.",".$new_value2.",".$new_value3.",".$new_value4.",".$new_value5.",".$new_value6.",".$new_value7.",".$new_value8.",".$new_value9.",".$new_value10.",".$new_value11.",".$new_value12.",".$new_value13.",".$new_value14.",".$new_value15.",".$new_value16.",".$new_valu17.",".$new_value18.",".$new_value19.",".$new_value20.",".$new_value21.",".$new_value22.",".$new_value23.",".$new_value24.",".$new_value25.",".$new_value26.",".$new_value27.",".$new_value28.",".$new_value29;
            $new_value  = rtrim($new_value,',');
            $changes    = $changes_date.",".$changes_ctime.",".$changes_cby.",".$changes1.",".$changes2.",".$changes3.",".$changes4.",".$changes5.",".$changes6.",".$changes7.",".$changes8.",".$changes9.",".$changes10.",".$changes11.",".$changes12.",".$changes13.",".$changes14.",".$changes15.",".$changes16.",".$changes17.",".$changes18.",".$changes19.",".$changes20.",".$changes21.",".$changes22.",".$changes23.",".$changes24.",".$changes25.",".$changes26.",".$changes27.",".$changes28.",".$changes29;
            $changes    = rtrim($changes,',');
            $changes_arr = array_filter(explode(',', $changes));
            $changes_str = implode($changes_arr,',');
            
            $sqladd = $dataInfo;
            $old_value = '';
            audit_log('true',$screen_type1,$act_1,$tblname1,$dataInfo,$old_value,$new_value,$changes,$screen_type1);

            audit_log('true',$screen_type1,$act_1,$sub_db_2,$dataInfo_2,$old_value,$new_value,$changes,$screen_type1);

            audit_log('true',$screen_type1,$act_1,$sub_db_3,$dataInfo_3,$old_value,$new_value,$changes,$screen_type1);
            
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
    $txtname = post('txtname');
    $surename = post('surename');
    $txtic = post('txtic');
    $txtemail = post('txtemail');
    $phone_no = post('phone_no');
    $alt_phone_no = post('alt_phone_no');
    $gender = post('gender');
    $birthday = post('birthday');
    $addressLine1 = post('addressLine1');
    $addressLine2 = post('addressLine2');
    $marital_status = post('marital_status');
    $employment_type = post('employment_type');
    $txtdepartment = post('txtdepartment');
    $position = post('position');
    $allowance = post('allowance');
    $txtbankName = post('txtbankName');
    $bankACC = post('bankACC');
    $epfAcc = post('epfAcc');
    $txtepfRate = post('txtepfRate');
    $socsoACC = post('socsoACC');
    $incomeTaxNum = post('incomeTaxNum');
    $txtAL = post('txtAL');
    $txtML = post('txtML');
    $txtsalary = post('txtsalary');
    $txtHospitalLeave = post('txtHospitalLeave');
    $txtpaternityLeave = post('txtpaternityLeave');
    $txtmaternityLeave = post('txtALtxtmaternityLeave');
    $txtcompassonateLeave = post('txtcompassonateLeave');
    $reportTo =  $_POST['reportTo'];
    $txtremark = post('txtremark');
    sort($reportTo);
	$reportTo_arr = implode(",",$reportTo); 


    if($name){

      if(mysqli_num_rows(mysqli_query($connect,"SELECT id FROM ".$sub_db." WHERE name = '".$name."' AND remark='".$remark."' AND status = 'A'"))==0){
          $sqlupd = "UPDATE ".$sub_db." SET name = '".$name."', remark = '".$remark."', update_date = '".$cdate."', update_time = '".$ctime."', update_by = '".$cby."' WHERE id = '".$txtid."' AND status = 'A'";
          $query2 = mysqli_query($connect,$sqlupd);
          if ($query2){
              echo '<script language="javascript">';
                  echo 'alert("Update sucessful");document.location="'.$back_url.'";';
                  echo '</script>';
                  
                //Audit	
                $old_value1 = $org_txtname;
                $new_value1 = $name;
                if($old_value1 == $new_value1){ $changes1 = ''; }else{ $changes1 = "Name: ".$old_value1." to ".$new_value1; }

                $old_value2 = $org_remark;
                $new_value2 = $remark;
                if($old_value2 == $new_value2){ $changes2 = ''; }else{ $changes2 = "Remark: ".$old_value2." to ".$new_value2; }
                
                $old_value = $old_value1.",".$old_value2;
                $old_value = rtrim($old_value,',');
                $new_value = $new_value1.",".$new_value2;
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

if($mode == 'edit'){
    $datainfo = "SELECT `id`, `name`, `surename`, `email`, `phone_no`, `alt_phone_no`, `gender`, `ic`, `address_line1`, `address_line2`, `birthday`, `marital_status_id`, `join_date`, `employment_type_id`, `department_id`, `position`, `allowance`, `leave_annual`, `leave_mc`, `leave_hospital`, `leave_paternity`, `leave_maternity`, `leave_compassionate`, `epf_rate_id`, `remark`, `reportingTo`, `bank_id`, `bank_account_number`, `kwsp_no`, `socso_no`, `income_tax_no`, `resign_date`, `create_date`, `create_time`, `create_by`, `update_by`, `update_time`, `update_date`, `status` FROM ".$sub_db." WHERE id ='".$txtgetID."' AND STATUS = 'A' LIMIT 1 ";
    $rowRetrieveInfo = mysqli_query($connect, $datainfo);
    $data = mysqli_fetch_assoc($rowRetrieveInfo);
    $txtid = $data['id'];
    $txtname = $data['name'];
    $surename = $data['surename'];
    $txtic = $data['ic'];
    $txtemail = $data['email'];
    $phone_no = $data['phone_no'];
    $alt_phone_no = $data['alt_phone_no'];
    $gender = $data['gender'];
    $birthday = $data['birthday'];
    $addressLine1 = $data['addressLine1'];
    $addressLine2 = $data['addressLine2'];
    $marital_status = $data['marital_status_id'];
    $employment_type = $data['employment_type_id'];
    $txtdepartment = $data['department_id'];
    $position = $data['position'];
    $allowance = $data['allowance'];
    $txtbankName = $data['bank_id'];
    $bankACC = $data['bank_account_number'];
    $epfAcc = $data['kwsp_no'];
    $txtepfRate = $data['epf_rate_id'];
    $socsoACC = $data['socso_no'];
    $incomeTaxNum = $data['income_tax_no'];
    $txtAL = $data['leave_annual'];
    $txtML = $data['leave_mc'];
    $txtsalary = $data['txtsalary'];
    $txtHospitalLeave = $data['leave_hospital'];
    $txtpaternityLeave = $data['leave_paternity'];
    $txtmaternityLeave = $data['leave_maternity'];
    $txtcompassonateLeave = $data['leave_compassionate'];
    $reportTo = $data['reportingTo'];
    $txtremark = $data['remark'];
} 
    
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php echo $header; ?>
<script>
jQuery(document).ready(function() {
    jQuery("form").submit(function() {
        if (jQuery('#txtname').val() == "") {
            alert("Please fill the Name");
            return false;
        }

        jQuery("#epfform").submit();
    });
});
</script>
<style>
@media (min-width: 992px) {
    .containerLeftMargin {
        margin-left: 30px;
    }

}

@media (max-width: 992px) {
    .bankContainer {
        margin-top: 1rem;
    }
}

.rightColContainer {
    padding: 0 0 5px;
    border: 1px ridge #cccccc;
    border-radius: 5px;
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
                                <h4 class="card-title"><?php echo $page_action.' '.$page_title; ?></h4>
                                <form id="epfform" method="POST">
                                    <input type="text" name="txtid" value="<?php echo $txtid; ?>" class="dnone">
                                    <div class="row" style="margin:0 3px 20px 0">
                                        <div class="col-lg-6" style="border:1px ridge #cccccc; border-radius:5px;">
                                            <div class="row" style="padding: 0 0 5px;">
                                                <h4 class="col-lg-12 pt-2 pb-2"
                                                    style="background-color:#ff9999; color:#ffffff">Personal Information
                                                </h4>

                                                <div class=" form-group col-lg-6">
                                                    <label for="txtname">Name</label>
                                                    <input type="text" name="txtname" id="txtname"
                                                        class="form-control demo" data-control="hue" required autofocus
                                                        value="<?php echo $txtname; ?>" />
                                                    <input type="text" name="org_txtname"
                                                        value="<?php echo $txtname; ?>" class="dnone">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="position-bottom-left">Surename</label>
                                                    <input type="text" name="surename" id="txtsurename"
                                                        class="form-control demo" data-position="bottom left"
                                                        value="<?php echo $surename; ?>" />
                                                    <input type="text" name="org_txtsurename"
                                                        value="<?php echo $surename; ?>" class="dnone">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="txtic">IC</label>
                                                    <input type="text" name="txtic" id="txtic" class="form-control"
                                                        value="<?php echo $txtic; ?>" required />
                                                    <input type="text" name="org_txtic" value="<?php echo $txtic; ?>"
                                                        class="dnone">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="txtemail" id="txtemail"
                                                        class="form-control" value="<?php echo $txtemail; ?>" />
                                                    <input type="text" name="org_txtemail"
                                                        value="<?php echo $txtemail; ?>" class="dnone">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="phone_no">Phone Number</label>
                                                    <input type="tel" name="phone_no" id="phone_no" class="form-control"
                                                        value="<?php echo $phone_no; ?>" required />
                                                    <input type="text" name="org_phone_no"
                                                        value="<?php echo $phone_no; ?>" class="dnone">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="alt_phone_no">Alternate Phone Number</label>
                                                    <input type="tel" name="alt_phone_no" id="alt_phone_no"
                                                        class="form-control" value="<?php echo $alt_phone_no; ?>" />
                                                    <input type="text" name="org_alt_phone_no"
                                                        value="<?php echo $alt_phone_no; ?>" class="dnone">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label for="gender">Gender</label>
                                                    <select name="gender" id="gender" class="form-control" required>
                                                        <option value=""
                                                            <?php echo ($gender == '') ? 'selected' : ''; ?>>
                                                        </option>
                                                        <option value="M"
                                                            <?php echo ($gender == 'M') ? 'selected' : ''; ?>>
                                                            Male</option>
                                                        <option value="F"
                                                            <?php echo ($gender == 'F') ? 'selected' : ''; ?>>
                                                            Female
                                                        </option>
                                                        <option value="O"
                                                            <?php echo ($gender == 'O') ? 'selected' : ''; ?>>
                                                            Other</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label for="birthday">Birthday</label>
                                                    <input type="date" name="birthday" id="birthday"
                                                        class="form-control" value="<?php echo $birthday; ?>" />
                                                    <input type="text" name="org_birthday"
                                                        value="<?php echo $birthday; ?>" class="dnone">
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label for="marital_status">Marital Status</label>
                                                    <select name="marital_status" id="marital_status"
                                                        class="form-control" required>
                                                        <?php
                                                        $query = "SELECT `id`, `name` FROM ".$tblname2." WHERE status = 'A'";
                                                        $result = mysqli_query($connect, $query);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $selected = ($marital_status == $row['id']) ? 'selected' : '';
                                                            echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="addressLine1">Address Line 1</label>
                                                    <input type="text" name="addressLine1" id="addressLine1"
                                                        class="form-control" value="<?php echo $addressLine1; ?>" />
                                                    <input type="text" name="org_addressLine1"
                                                        value="<?php echo $addressLine1; ?>" class="dnone">
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="addressLine2">Address Line 2</label>
                                                    <input name="addressLine2" id="addressLine2"
                                                        class="form-control"><?php echo $addressLine2; ?></textarea>
                                                    <input type="text" name="org_addressLine2"
                                                        value="<?php echo $addressLine2; ?>" class="dnone">
                                                </div>


                                                <div class="form-group col-lg-4">
                                                    <label for="employment_type">Employment Status</label>
                                                    <select name="employment_type" id="employment_type"
                                                        class="form-control" required>
                                                        <?php
                                                $query = "SELECT `id`, `name` FROM ".$tblname3." WHERE status = 'A'";
                                                $result = mysqli_query($connect, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($employment_type == $row['id']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                                }
                                                ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label for="txtdepartment">Department</label>
                                                    <select name="txtdepartment" id="txtdepartment" class="form-control"
                                                        required>
                                                        <?php
                                                        echo "<option value=''></option>";
                                                $query = "SELECT `id`, `name` FROM ".$tblname4." WHERE status = 'A'";
                                                $result = mysqli_query($connect, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($txtdepartment == $row['id']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                                }
                                                ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label for="allowance">Allowance</label>
                                                    <input type="text" name="allowance" id="allowance"
                                                        class="form-control" value="<?php echo $allowance; ?>" />
                                                    <input type="text" name="org_allowance"
                                                        value="<?php echo $allowance; ?>" class="dnone">
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="position">Position</label>
                                                    <input type="text" name="position" id="position"
                                                        class="form-control" value="<?php echo $position; ?>" />
                                                    <input type="text" name="org_position"
                                                        value="<?php echo $position; ?>" class="dnone">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="txtsalary">Salary</label>
                                                    <input type="text" name="txtsalary" id="txtsalary"
                                                        class="form-control" value="<?php echo $txtsalary; ?>" require/>
                                                    <input type="text" name="org_txtsalary"
                                                        value="<?php echo $txtsalary; ?>" class="dnone">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-5 containerLeftMargin">
                                            <div class="col-lg-12">
                                                <div class=" row rightColContainer bankContainer">
                                                    <h4 class="col-lg-12 pt-2 pb-2"
                                                        style="background-color:#ff9999; color:#ffffff">Bank and Other
                                                        Account Details
                                                    </h4>

                                                    <div class=" form-group col-lg-6">
                                                        <label for="txtbankName">Bank Name </label>
                                                        <select name="txtbankName" id="txtbankName" class="form-control"
                                                            required>
                                                            <?php
                                                            echo "<option value=''></option>";
                                                            $query = "SELECT `id`, `name` FROM ".$tblname5." WHERE status = 'A'";
                                                            $result = mysqli_query($connect, $query);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $selected = ($txtbankName == $row['id']) ? 'selected' : '';
                                                                echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                                            }
                                                        ?>
                                                        </select>
                                                        <input type="text" name="org_txtbankName"
                                                            value="<?php echo $txtbankName; ?>" class="dnone">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="bankACC">Bank Account Number</label>
                                                        <input type="text" name="bankACC" id="bankACC"
                                                            class="form-control" value="<?php echo $bankACC; ?>"
                                                            required />
                                                        <input type="text" name="org_bankACC"
                                                            value="<?php echo $bankACC; ?>" class="dnone">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="epfAcc">EPF Account Number</label>
                                                        <input type="text" name="epfAcc" id="epfAcc"
                                                            class="form-control" value="<?php echo $epfAcc; ?>" />
                                                        <input type="text" name="org_epfAcc"
                                                            value="<?php echo $epfAcc; ?>" class="dnone">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="txtepfRate">EPF Rate</label>
                                                        <select name="txtepfRate" id="txtepfRate" class="form-control">
                                                            <?php
                                                            echo "<option value=''></option>";
                                                            $query = "SELECT `id`, `name`, employer_epf_rate, employee_epf_rate FROM ".$tblname6." WHERE status = 'A'";
                                                            $result = mysqli_query($connect, $query);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $selected = ($txtepfRate == $row['id']) ? 'selected' : '';
                                                                echo "<option value='" . $row['id'] . "' $selected>" .' Employer Rate:'.$row['employer_epf_rate'].'  Employee Rate:'.$row['employee_epf_rate'] . "</option>";
                                                            }
                                                        ?>
                                                        </select>
                                                        <input type="text" name="org_txtepfRate"
                                                            value="<?php echo $txtepfRate; ?>" class="dnone">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="socsoACC">SOCSO Account Number</label>
                                                        <input type="text" name="socsoACC" id="socsoACC"
                                                            class="form-control" value="<?php echo $socsoACC; ?>" />
                                                        <input type="text" name="org_socsoACC"
                                                            value="<?php echo $socsoACC; ?>" class="dnone">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="incomeTaxNum">Income Tax Number / LHDN Employer
                                                            Number</label>
                                                        <input type="text" name="incomeTaxNum" id="incomeTaxNum"
                                                            class="form-control" value="<?php echo $incomeTaxNum; ?>" />
                                                        <input type="text" name="org_incomeTaxNum"
                                                            value="<?php echo $incomeTaxNum; ?>" class="dnone">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="row mt-3 rightColContainer">
                                                    <h4 class="col-lg-12 pt-2 pb-2"
                                                        style="background-color:#ff9999; color:#ffffff">General Leave
                                                        Settings
                                                    </h4>

                                                    <div class="form-group col-lg-4">
                                                        <label for="txtAL">Annual Leave</label>
                                                        <input type="text" name="txtAL" id="txtAL" class="form-control"
                                                            value="<?php echo $txtAL; ?>" />
                                                        <input type="text" name="org_txtAL"
                                                            value="<?php echo $txtAL; ?>" class="dnone">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label for="txtML">Medical Leave</label>
                                                        <input type="text" name="txtML" id="txtML" class="form-control"
                                                            value="<?php echo $txtML; ?>" />
                                                        <input type="text" name="org_txtML"
                                                            value="<?php echo $txtML; ?>" class="dnone">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label for="txtHospitalLeave">Hospital Leave</label>
                                                        <input type="text" name="txtHospitalLeave" id="txtHospitalLeave"
                                                            class="form-control"
                                                            value="<?php echo $txtHospitalLeave; ?>" />
                                                        <input type="text" name="org_txtHospitalLeave"
                                                            value="<?php echo $txtHospitalLeave; ?>" class="dnone">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label for="txtpaternityLeave">Paternity Leave</label>
                                                        <input type="text" name="txtpaternityLeave"
                                                            id="txtpaternityLeave" class="form-control"
                                                            value="<?php echo $txtpaternityLeave; ?>" />
                                                        <input type="text" name="org_txtpaternityLeave"
                                                            value="<?php echo $txtpaternityLeave; ?>" class="dnone">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label for="txtmaternityLeave">Maternity Leave</label>
                                                        <input type="text" name="txtmaternityLeave"
                                                            id="txtmaternityLeave" class="form-control"
                                                            value="<?php echo $txtmaternityLeave; ?>" />
                                                        <input type="text" name="org_txtmaternityLeave"
                                                            value="<?php echo $txtmaternityLeave; ?>" class="dnone">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label for="txtcompassonateLeave">Compassionate Leave</label>
                                                        <input type="text" name="txtcompassonateLeave"
                                                            id="txtcompassonateLeave" class="form-control"
                                                            value="<?php echo $txtcompassonateLeave; ?>" />
                                                        <input type="text" name="org_txtcompassonateLeave"
                                                            value="<?php echo $txtcompassonateLeave; ?>" class="dnone">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="row mt-3"
                                                    style="padding: 0 0 5px;border:1px ridge #cccccc; border-radius:5px;">
                                                    <h4 class="col-lg-12 pt-2 pb-2"
                                                        style="background-color:#ff9999; color:#ffffff">Other
                                                        Information
                                                    </h4>

                                                    <div class="form-group col-lg-6">
                                                        <label for="reportTo">Report to</label>
                                                        <select class="select2 form-select shadow-none mt-3"
                                                            multiple="multiple" style="height: 36px; width: 100%"
                                                            name="reportTo[]" id="reportTo" required>
                                                            <?php
                                                            $query = "SELECT `id`, `name` FROM ".$tblname7." WHERE status = 'A'";
                                                            $result = mysqli_query($connect, $query);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $selected = ($reportTo == $row['id']) ? 'selected' : '';
                                                                echo "<option value='" . $row['id'] . "' $selected>" .$row['name']. "</option>";
                                                            }
                                                        ?> </select>
                                                        <input type="text" name="org_reportTo"
                                                            value="<?php echo $reportTo; ?>" class="dnone">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="txtremark">Remark</label>
                                                        <textarea name="txtremark" id="txtremark"
                                                            class="form-control col-lg-12"><?php echo $txtremark; ?></textarea>
                                                        <input type="text" name="org_txtremark"
                                                            value="<?php echo $txtremark; ?>" class="dnone">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-3">
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
    $(".select2").select2();

    $('#resetForm').click(function() {
        $('#txtname').val('');
        $('#txtemployer').val('');
        $('#txtemployee').val('');
    });
    </script>
</body>

</html>