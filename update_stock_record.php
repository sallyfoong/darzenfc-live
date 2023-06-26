<?php 

$connect = @mysqli_connect("127.0.0.1:3306", "darzenfc_cms", 'Sallyfoong1997@', "darzenfc_cms");

$productId = $_REQUEST['id'];

if($productId){ ?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <?php
//write the code the can choose the person in charges
            $query = "SELECT `id`, `name` FROM user WHERE status = 'A'";
            $result = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div value='" . $row['id'] . "'>".$row['name'] . "</div>";
            }
            // Create an input field for the user to enter the barcode
            echo "<input type='text' name='barcode' placeholder='Enter barcode' />";

            // Create a button for the user to submit
            echo "<button type='submit'>Submit</button>";
        ?>
</body>

</html>


<?php }