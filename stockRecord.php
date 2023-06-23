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
                $stockInfo = "SELECT id FROM stock_record WHERE status = 'A' AND barcode ='".$barcode."'";
                $rowStockRetrieveInfo = mysqli_query($connect, $stockInfo);
                $dataStock = mysqli_fetch_assoc($rowStockRetrieveInfo);
                $stockId = $dataStock['id'];

                if($stockId){
                    //stock out
                    /**
                     * stock_out_date
                     * platform_id
                     * stock_out_person_in_charges
                     * stock_out_customer_purchase_id
                     */
                    echo '<script language="javascript">';
                    echo 'alert("need update");';
                    echo '</script>';
                }else{
                    //stock in
                    $sqlupd = "INSERT INTO stock_record (brand_id, product_id, stock_in_date , barcode, warehouse_id, create_date, create_time, status) VALUES ('".$brandId."', '".$prdId."', NOW(), '".$barcode."', '".$warehouseId."', NOW(), NOW(), 'A')";
                    $query2 = mysqli_query($connect,$sqlupd); 

                    if($query2){
                        echo '<script language="javascript">';
                        echo 'alert("Insert");';
                        echo '</script>';
                    }else{
                        echo '<script language="javascript">';
                        echo 'alert("Fail to Insert");';
                        echo '</script>';
                    }
                    //product_batch_code
                    //stock_in_person_in
                }
            }
        }
    }
}