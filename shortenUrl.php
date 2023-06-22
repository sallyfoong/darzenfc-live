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
    <form action="#" method="POST">
        <label for="longURL">Enter URL:</label>
        <input type="text" id="longURL" name="longURL" placeholder="Enter a long URL" required>
        <input type="submit" value="Shorten">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $longURL = $_POST['longURL'];
        $shortURL = googleShortURL($longURL);
        echo "<br><input type='text' id='shortURL' value='$shortURL' readonly>";
        echo "<button onclick='copyToClipboard()'>Copy URL</button>";
    }

    function googleShortURL($longurl)
    {
        $data = array('dynamicLinkInfo' => array('dynamicLinkDomain' => 'beyourdi', 'link' => $longurl));
        $data_string = json_encode($data);

        $ch = curl_init('https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=YOUR_API_KEY');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );

        $result = curl_exec($ch);

        $decodeResult = json_decode($result);
        $firebaseShortURL = isset($decodeResult->shortLink) ? $decodeResult->shortLink : '';
console.log(firebaseShortURL);
        return $firebaseShortURL;
    }
    ?>
</body>

</html>