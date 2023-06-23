<?php 

$connect = @mysqli_connect("127.0.0.1:3306", "darzenfc_cms", 'Sallyfoong1997@', "darzenfc_cms");

$barcode = $_REQUEST['barcode'];
$productId = $_REQUEST['pid'];
$warehouseId = $_REQUEST['wid'];

if($barcode && $productId && $warehouseId){
    $datainfo="SELECT barcode_prefix, barcode_next_number FROM projects WHERE id='1'";
    $rowRetrieveInfo = mysqli_query($connect, $datainfo);
    $data = mysqli_fetch_assoc($rowRetrieveInfo);
    $barcode_next_number = $data['barcode_next_number'];

    if($barcode <= $barcode_next_number) {
        $prdInfo = "SELECT id, name, brand FROM product WHERE status = 'A' AND id ='".$productId."'";
        $rowPrdRetrieveInfo = mysqli_query($connect, $prdInfo);
        $dataPrd = mysqli_fetch_assoc($rowPrdRetrieveInfo);
        $prdName = $dataPrd['name'];
        $brandId = $dataPrd['brand'];
        $prdId = $dataPrd['id'];
        if($prdId){
            $warehouseInfo = "SELECT id, name FROM warehouse WHERE status = 'A' AND id ='".$warehouseId."'";
            $rowWarehouseRetrieveInfo = mysqli_query($connect, $warehouseInfo);
            $dataWarehouse = mysqli_fetch_assoc($rowWarehouseRetrieveInfo);
            $warehouseId = $dataWarehouse['id'];
            if($warehouseId){
                $sqlupd = "INSERT INTO ".$sub_db." (brand_id, product_id, stock_in_date , barcode, create_date, create_time, create_by, status) VALUES ('".$brandId."', '".$prdId."', NOW(), '".$barcode."', '".$cdate."', '".$ctime."', '".$cby."', 'A')";
                $query2 = mysqli_query($connect,$sqlupd); 
            }
        }
    }
}