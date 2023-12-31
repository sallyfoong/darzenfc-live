<?php 
$host = "127.0.0.1:3306";
$username = "darzenfc_shorten_url";
$password = "Sallyfoong1997@";
$databasename = "darzenfc_shorten_url";
$connect = @mysqli_connect($host, $username, $password, $databasename);
?>

<html>

<head>    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: black;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width:50%
    }

    input[type="text"],
    input[type="submit"] {
        margin-bottom: 10px;
    }

    #shortURL, .urlInput{
        width: 100%;
        height:40px;
    }
    </style>
</head>

<body>
    <form method="post" action="">
        <input type="text" name="url_value" placeholder="Enter URL" class="urlInput">
        <input type="submit" name="original_url" class="btn btn-primary btn-lg">
    
    <?php 
    if(isset($_POST['url_value'])){
        $url = $_POST["url_value"];
        $short_url = substr(md5($url.mt_rand()), 0, 16);
        $qrsql = "INSERT INTO short_urls (long_url, short_url) VALUES ('$url', '$short_url')";  
        $rsqrsql = @mysqli_query($connect, $qrsql);  
        $shorturl_fill = "https://darzenfc.xyz/cms/redirect.php?param=" . $short_url;
        echo "<br><br><br><input type='text' id='shortURL' value='$shorturl_fill' readonly>";
        echo "<br><br><button onclick='copyToClipboard()' class=\"btn btn-primary btn-lg\">Copy URL</button>";
    }
    ?>
    </form>
    <script>
    function copyToClipboard() {
        /* Get the text field */
        var copyText = document.getElementById("shortURL");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        alert("URL copied to clipboard!");
    }
    </script>
</body>

</html>