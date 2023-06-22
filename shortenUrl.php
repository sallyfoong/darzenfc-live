<!DOCTYPE html>
<html>

<head>
    <title>Shorten URL</title>
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
</head>

<body>
    <h1>Shorten URL</h1>
    <form action="" method="POST">
        <label for="longURL">Enter URL:</label>
        <input type="text" id="longURL" name="longURL" placeholder="Enter a long URL" required>
        <input type="submit" value="Shorten">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $longURL = $_POST['longURL'];
        echo $longURL;
        $shortURL = generateGoogleDynamicLink($longURL);
        echo $shortURL;
        echo "<br><input type='text' id='shortURL' value='$shortURL' readonly>";
        echo "<button onclick='copyToClipboard()'>Copy URL</button>";
    }

    function generateGoogleDynamicLink($link) {
        $apiEndpoint = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyDfc6efTLP-OEkPmSBikxSd-av2YVH4aPU'; // Replace with your API endpoint and API key
    
        $postData = array(
            'dynamicLinkInfo' => array(
                'domainUriPrefix' => 'https://beyourdi.page.link', // Replace with your dynamic links domain
                'link' => $link,
                'fallbackLink' => "https://www.beyourdiary.co/",
            ),
            'suffix' => array(
                'option' => 'SHORT',
            ),
        );
    
       
        $postData['dynamicLinkInfo']['parameters'] = strtotime(date("Y-m-d h:i:sa"));
        
    
        $ch = curl_init($apiEndpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        curl_close($ch);
    
        if ($httpCode == 200) {
            $responseData = json_decode($response, true);
            var_dump($responseData);
            return $responseData['shortLink'];
        } else {
            // Handle the error case
            return null;
        }
    }
    
    ?>
</body>

</html>