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
                        // echo '<script language="javascript">';
                        // echo 'alert("Insert");';
                        // echo '</script>';
                            // Success step 2
                            echo '<script language="javascript">';
                            echo 'let selectedPerson = null;';
                            echo 'let productBatchCode = null;';
                            echo 'function selectPerson(person) {';
                            echo '    selectedPerson = person;';
                            echo '}';
                            echo 'function submitForm() {';
                            echo '    productBatchCode = document.getElementById("batch_code").value;';
                            echo '    if (selectedPerson && productBatchCode) {';
                            echo '        // Update stock_record table with the selected values';
                            echo '        $.ajax({';
                            echo '            type: "POST",';
                            echo '            url: "update_stock_record.php", // Replace with the actual PHP file to handle the update';
                            echo '            data: {';
                            echo '                stock_in_person_in: selectedPerson,';
                            echo '                product_batch_code: productBatchCode,';
                            echo '                barcode: "'.$barcode.'",';
                            echo '                productId: "'.$productId.'",';
                            echo '                warehouseId: "'.$warehouseId.'"';
                            echo '            },';
                            echo '            success: function(response) {';
                            echo '                // Handle the success response';
                            echo '                alert("Stock record updated successfully!");';
                            echo '            },';
                            echo '            error: function(xhr, status, error) {';
                            echo '                // Handle the error response';
                            echo '                alert("Error updating stock record: " + error);';
                            echo '            }';
                            echo '        });';
                            echo '    } else {';
                            echo '        alert("Please select a person and enter the product batch code.");';
                            echo '    }';
                            echo '}';
                            echo '</script>';
                            echo '<div class="modal fade" id="stockInModal" tabindex="-1" role="dialog" aria-labelledby="stockInModalLabel" aria-hidden="true">';
                            echo '    <div class="modal-dialog" role="document">';
                            echo '        <div class="modal-content">';
                            echo '            <div class="modal-header">';
                            echo '                <h5 class="modal-title" id="stockInModalLabel">Stock In Details</h5>';
                            echo '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                            echo '                    <span aria-hidden="true">&times;</span>';
                            echo '                </button>';
                            echo '            </div>';
                            echo '            <div class="modal-body">';
                            echo '                <div class="form-group">';
                            echo '                    <label for="person">Stock In Person:</label>';
                            echo '                    <select class="form-control" id="person" onchange="selectPerson(this.value)">';
                            echo '                        <option value="">Select Person</option>';
                            echo '                        <option value="A PERSON">A PERSON</option>';
                            echo '                        <option value="B PERSON">B PERSON</option>';
                            echo '                        <option value="C PERSON">C PERSON</option>';
                            echo '                    </select>';
                            echo '                </div>';
                            echo '                <div class="form-group">';
                            echo '                    <label for="batch_code">Product Batch Code:</label>';
                            echo '                    <input type="text" class="form-control" id="batch_code" placeholder="Enter Product Batch Code">';
                            echo '                </div>';
                            echo '            </div>';
                            echo '            <div class="modal-footer">';
                            echo '                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                            echo '                <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>';
                            echo '            </div>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                            echo '<script>';
                            echo '    $("#stockInModal").modal("show");';
                            echo '</script>';
                        
                    //product_batch_code
                    //stock_in_person_in
                    }else{
                        echo '<script language="javascript">';
                        echo 'alert("Fail to Insert");';
                        echo '</script>';
                    }
                }
            }
        }
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

</html>