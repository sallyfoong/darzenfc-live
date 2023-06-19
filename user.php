<?php
$pagePin = '1';

include 'include/connection.php'; 

$page_action = 'Add';
$page_title = 'User';
$sub_db = 'user'; 
$back_url = SITEURL."/user_list.php";
$error_message = '';
$mode = input('mode');
$txtgetID = input('id');
$page_action = $mode == 'edit' ? 'Edit' : 'Add';
$txtid = $txtname = $txtemployer = $txtemployee = '';

$tblname1 = $sub_db;
$tblname2 = 'usergroup';
$screen_type1 = 'Add '.$page_title;
$screen_type2 = 'Edit '.$page_title;


if(isset($_POST['save'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $access_id = $_POST['access_id'];
    $encrypted_pwd = md5($password);

    if($name && $username && $email && $password && $access_id){
        if(mysqli_num_rows(mysqli_query($connect,"SELECT id FROM ".$sub_db." WHERE name = '".$name."' AND username='".$username."' AND email='".$email."' AND password='".$password."' AND access_id='".$access_id."' AND status = 'A'"))==0){
            $dataInfo = "INSERT INTO ".$sub_db." (name, username, email, password, password_alt, access_id, create_date, create_time, create_by, status) VALUES ('".$name."', '".$username."', '".$email."', '".$password."', '".$encrypted_pwd."', '".$access_id."','".$cdate."', '".$ctime."', '".$cby."', 'A')";
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
            $new_value1 = $txtname;
            $changes1   = "Name: ".$new_value1; 
            
            $new_value2 = $username;
            $changes2   = "Username: ".$new_value2;
            
            $new_value3 = $email;
            $changes3   = "Email: ".$new_value3;

            $new_value7 = $encrypted_pwd;
            $changes7   = "Password: ".$new_value7;

            $new_value8 = getUserRoleName($access_id);
            $changes8   = "User Group: ".$new_value8;
            
            $new_value4 = $cdate;
            $changes4   = "Create Date: ".$new_value4;
            
            $new_value5 = $ctime;
            $changes5  = "Create Time: ".$new_value5;
            
            $new_value6 = $cby;
            $changes6   = "Create By: ".$new_value6;
                        
            $new_value  = $new_value1.",".$new_value2.",".$new_value3.",".$new_value4.",".$new_value5.",".$new_value6.",".$new_value7.",".$new_value8;
            $new_value  = rtrim($new_value,',');
            $changes    = $changes1.",".$changes2.",".$changes3.",".$changes4.",".$changes5.",".$changes6.",".$changes7.",".$changes8;
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
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $access_id = $_POST['access_id'];

    $org_txtname = $_POST['org_txtname'];
    $org_txtusername = $_POST['org_txtusername'];
    $org_txtemail = $_POST['org_txtemail'];
    $org_txtpassword = $_POST['org_txtpassword'];
    $org_txtaccessid = $_POST['org_txtaccessid'];
    
    $encrypted_pwd = md5($password);
    $encrypted_pwd_old = md5($org_txtpassword);

    
    if(($name != $org_txtname) || ($username != $org_txtusername) || ($email!= $org_txtemail) || ($password!= $org_txtpassword) || ($access_id!= $org_txtaccessid)){
      if(mysqli_num_rows(mysqli_query($connect,"SELECT id FROM ".$sub_db." WHERE name = '".$name."' AND username='".$username."' AND email='".$email."' AND password='".$password."' AND access_id='".$access_id."' AND status = 'A'"))==0){
          $sqlupd = "UPDATE ".$sub_db." SET name = '".$name."', username = '".$username."', password = '".$password."', password_alt = '".$encrypted_pwd."', email = '".$email."', access_id = '".$access_id."', update_date = '".$cdate."', update_time = '".$ctime."', update_by = '".$cby."' WHERE id = '".$txtid."' AND status = 'A'";
          $query2 = mysqli_query($connect,$sqlupd);
          if ($query2){
              echo '<script language="javascript">';
                  echo 'alert("Update sucessful");document.location="'.$back_url.'";';
                  echo '</script>';
                  
                //Audit	
                $old_value1 = $org_txtname;
                $new_value1 = $name;
                if($old_value1 == $new_value1){ $changes1 = ''; }else{ $changes1 = "Name: ".$old_value1." to ".$new_value1; }

                $old_value2 = $org_txtusername;
                $new_value2 = $username;
                if($old_value2 == $new_value2){ $changes2 = ''; }else{ $changes2 = "Username: ".$old_value2." to ".$new_value2; }
                
                $old_value3 = $org_txtemail;
                $new_value3 = $email;
                if($old_value3 == $new_value3){ $changes3 = ''; }else{ $changes3 = "Email: ".$old_value3." to ".$new_value3; }
                
                $old_value4 = $encrypted_pwd_old;
                $new_value4 = $encrypted_pwd;
                if($old_value4 == $new_value4){ $changes4 = ''; }else{ $changes4 = "Password: ".$old_value4." to ".$new_value4; }
                
                $old_value5 = getUserRoleName($org_txtaccessid);
                $new_value5 = getUserRoleName($access_id);
                if($old_value5 == $new_value5){ $changes5 = ''; }else{ $changes5 = "User Group: ".$old_value5." to ".$new_value5; }
                
                $old_value = $old_value1.",".$old_value2.",".$old_value3.",".$old_value4.",".$old_value5;
                $old_value = rtrim($old_value,',');
                $new_value = $new_value1.",".$new_value2.",".$new_value3.",".$new_value34.",".$new_value53;
                $new_value = rtrim($new_value,',');
                $changes   = $changes1.",".$changes2.",".$changes3.",".$changes4.",".$changes5;
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
    $datainfo = "SELECT `id`, `name`, `username`, `email`, `access_id`, `create_date`, `create_time`, `create_by`, `update_date`, `update_time`, `update_by`, `status` FROM ".$sub_db." WHERE id ='".$txtgetID."' AND STATUS = 'A' LIMIT 1 ";
    $rowRetrieveInfo = mysqli_query($connect, $datainfo);
    $data = mysqli_fetch_assoc($rowRetrieveInfo);
    $txtid = $data['id'];
    $txtname = $data['name'];
    $txtusername = $data['username'];
    $txtemail = $data['email'];
    $txtaccessid = $data['access_id'];
}
     
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php echo $header; ?>
<script>
jQuery(document).ready(function() {
    const txtname = jQuery('#txtname');
    const txtusername = jQuery('#txtusername');
    const txtpassword = jQuery('#txtpassword');
    const txtemail = jQuery('#txtemail');
    const accessID = jQuery('#access-id-dropdown');

    jQuery("form").submit(function() {
        if (txtname.val() == "") {
            alert("Please fill the Name");
            txtname.focus();
            return false;
        }
        if (txtusername.val() == "") {
            alert("Please fill the Username");
            txtusername.focus();
            return false;
        }
        if (txtpassword.val().length < 6) {
            alert('Password must be at least 6 characters long');
            txtpassword.focus();
            return false;
        }
        if (txtemail.val() == "") {
            alert("Please fill the Email");
            txtemail.focus();
            return false;
        }
        var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!pattern.test(txtemail.val())) {
            alert('Please enter a valid email address');
            txtemail.focus();
            return false;
        }
        if (accessID.val() === '') {
            alert('Please select an access ID');
            accessID.focus();
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

                                    <div class="form-group">
                                        <label for="hue-demo">Name</label>
                                        <input type="text" name="name" id="txtname" class="form-control demo"
                                            data-control="hue" required autofocus value="<?php echo $txtname; ?>" />
                                        <input type="text" name="org_txtname" value="<?php echo $txtname; ?>"
                                            class="dnone">
                                    </div>

                                    <div class="form-group">
                                        <label for="hue-demo">Username</label>
                                        <input type="text" name="username" id="txtusername" class="form-control demo"
                                            data-control="hue" required value="<?php echo $txtusername; ?>"
                                            oninput="this.value = this.value.replace(/\s+/g, '');" />
                                        <input type="text" name="org_txtusername" value="<?php echo $txtusername; ?>"
                                            class="dnone">
                                    </div>

                                    <div class="form-group">
                                        <label for="hue-demo">Password</label>
                                        <input type="password" name="password" id="txtpassword"
                                            class="form-control demo" data-control="hue" required
                                            value="<?php echo $txtpassword; ?>" />
                                        <input type="password" name="org_txtpassword"
                                            value="<?php echo $txtpassword; ?>" class="dnone">
                                    </div>

                                    <div class="form-group">
                                        <label for="hue-demo">Email</label>
                                        <input type="email" name="email" id="txtemail" class="form-control demo"
                                            data-control="hue" required value="<?php echo $txtemail; ?>" />
                                        <input type="email" name="org_txtemail" value="<?php echo $txtemail; ?>"
                                            class="dnone">
                                    </div>

                                    <div class="form-group">
                                        <label for="accessID">Access ID</label>
                                        <select name="access_id" id="accessID" class="form-control" required>
                                            <?php
                                            $query = "SELECT `id`, `name` FROM ".$tblname2." WHERE status = 'A'";
                                            $result = mysqli_query($connect, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $selected = ($txtaccessid == $row['id']) ? 'selected' : '';
                                                echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="org_txtaccessid" value="<?php echo $txtaccessid; ?>"
                                        class="dnone">


                                    <div>
                                        <?php if($mode != 'edit'){ ?>
                                        <button type="submit" name="save" class="btn btn-success text-white">
                                            Save
                                        </button>
                                        <button type="reset" name="reset" id="resetForm"
                                            class="btn btn-primary">Reset</button>
                                        <?php }else{ ?>
                                        <button type="submit" name="edit" class="btn btn-info">Update</button>
                                        <?php } ?>
                                        <a href="<?php echo $back_url;?>">
                                            <button type="button" name="cancel" class="btn btn-danger text-white">
                                                Cancel
                                            </button>
                                        </a>
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
            $('#txtemployer').val('');
            $('#txtemployee').val('');
        });
        </script>
</body>

</html>