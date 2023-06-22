<?php 

function googleShortURL($longurl)
{
    $data = array('dynamicLinkInfo' => array('dynamicLinkDomain'=>'beyourdi', 'link' => $longurl));
    $data_string = json_encode($data);

    $ch = curl_init('https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyDfc6efTLP-OEkPmSBikxSd-av2YVH4aPU');
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
        'Content-Length: ' . strlen($data_string))
    );

    $result = curl_exec($ch);

    $decodeResult =  json_decode($result);
    $firebaseShortURL = isset($decodeResult->shortLink) ? $decodeResult->shortLink : '';

    return $firebaseShortURL;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Shorten URL</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Shorten URL</h1>
    <form id="shortenForm">
        <label for="longUrl">Long URL:</label>
        <input type="text" id="longUrl" name="longUrl" required>
        <button type="submit">Shorten</button>
    </form>

    <div id="resultContainer" style="display: none;">
        <label for="shortUrl">Shortened URL:</label>
        <input type="text" id="shortUrl" name="shortUrl" readonly>
        <button id="copyButton" type="button">Copy</button>
    </div>

    <script>
    $(document).ready(function() {
        $('#shortenForm').submit(function(e) {
            e.preventDefault();

            var longUrl = $('#longUrl').val();

            // AJAX request to submit the long URL and get the shortened URL
            $.ajax({
                url: 'shorten.php', // Replace with the actual URL of your PHP file
                method: 'POST',
                data: {
                    longUrl: longUrl
                },
                dataType: 'json',
                success: function(response) {
                    $('#shortUrl').val(response.shortUrl);
                    $('#resultContainer').show();
                }
            });
        });

        $('#copyButton').click(function() {
            var shortUrl = $('#shortUrl');

            // Copy the shortened URL to the clipboard
            shortUrl.select();
            shortUrl[0].setSelectionRange(0, 99999); // For mobile devices

            document.execCommand("copy");

            alert('URL copied to clipboard!');
        });
    });
    </script>
</body>

</html>