<?php
$pagePin = '8';

include 'include/connection.php'; 

$page_action = 'Add';
$page_title = 'Bank';
$sub_db = 'bank'; 
$back_url = SITEURL."/bank_list.php";
$error_message = '';
$mode = input('mode');
$txtgetID = input('id');
$page_action = $mode == 'edit' ? 'Edit' : 'Add';
$txtid = $txtname = $txtemployer = $txtemployee = '';

$tblname1 = $sub_db;
$screen_type1 = 'Add '.$page_title;
$screen_type2 = 'Edit '.$page_title;


if(isset($_POST['save'])){
    $name = $_POST['name'];
    if($name){
        if(mysqli_num_rows(mysqli_query($connect,"SELECT id FROM ".$sub_db." WHERE name = '".$name."' AND status = 'A'"))==0){
            $dataInfo = "INSERT INTO ".$sub_db." (name, create_date, create_time, create_by, status) VALUES ('".$name."', '".$cdate."', '".$ctime."', '".$cby."', 'A')";
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
        
            $new_value4 = $cdate;
            $changes4   = "Create Date: ".$new_value4;
            
            $new_value5 = $ctime;
            $changes5  = "Create Time: ".$new_value5;
            
            $new_value6 = $cby;
            $changes6   = "Create By: ".$new_value6;
                        
            $new_value  = $new_value1.",".$new_value4.",".$new_value5.",".$new_value6;
            $new_value  = rtrim($new_value,',');
            $changes    = $changes1.",".$changes4.",".$changes5.",".$changes6;
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
    $org_txtname = $_POST['org_txtname'];
    if($name){

      if(mysqli_num_rows(mysqli_query($connect,"SELECT id FROM ".$sub_db." WHERE name = '".$name."' AND status = 'A'"))==0){
          $sqlupd = "UPDATE ".$sub_db." SET name = '".$name."', update_date = '".$cdate."', update_time = '".$ctime."', update_by = '".$cby."' WHERE id = '".$txtid."' AND status = 'A'";
          $query2 = mysqli_query($connect,$sqlupd);
          if ($query2){
              echo '<script language="javascript">';
                  echo 'alert("Update sucessful");document.location="'.$back_url.'";';
                  echo '</script>';
                  
                //Audit	
                $old_value1 = $org_txtname;
                $new_value1 = $name;
                if($old_value1 == $new_value1){ $changes1 = ''; }else{ $changes1 = "Name: ".$old_value1." to ".$new_value1; }

                $old_value = $old_value1;
                $old_value = rtrim($old_value,',');
                $new_value = $new_value1;
                $new_value = rtrim($new_value,',');
                $changes   = $changes1;
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
    $datainfo = "SELECT `id`, `name`, `create_date`, `create_time`, `create_by`, `update_date`, `update_time`, `update_by`, `status` FROM ".$sub_db." WHERE id ='".$txtgetID."' AND STATUS = 'A' LIMIT 1 ";
    $rowRetrieveInfo = mysqli_query($connect, $datainfo);
    $data = mysqli_fetch_assoc($rowRetrieveInfo);
    $txtid = $data['id'];
    $name = $data['name'];
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
                                        <label for="hue-demo">Bank Name</label>
                                        <input type="text" name="name" id="txtname" class="form-control demo"
                                            data-control="hue" required autofocus value="<?php echo $name; ?>" />
                                        <input type="text" name="org_txtname" value="<?php echo $name; ?>"
                                            class="dnone">
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