<html>
<head>
    <link rel="stylesheet" href="scanQR.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title> Scan Qr Code</title>
</head>
<body>
    <div class="container"> 
        <div class="row">
            <div class="col-md-6">
                <video id="preview" width="100%"></video>
            </div>
            <div class="col-md-6">
                <label>SCAN QR CODE</label> 
                <form action="saveQRDetails.php" method="post"> <!-- Modified action attribute -->
                    <textarea name="text" id="text" readonly placeholder="Scanned QR Data" class="form-control" rows="5" style="min-width: 250px; min-height: 300px;"></textarea> <!-- Added name attribute -->
                    <input type="submit" value="Save QR details" class="btn"> <!-- Submit button -->
                </form>
            </div>
        </div>
        <form action="adminDashboard.php" method="post">
            <input type="submit" value="Back to Dashboard" class="btn">
        </form>   
    </div>
    <script>
        // Initialize Instascan scanner
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No Cameras Found');
            }
        }).catch(function (e) {
            console.error(e);
        });

        // Add event listener for scanning QR code
        scanner.addListener('scan', function (content) {
        // Set the scanned content to the text area
        document.getElementById('text').value = content;
        });
    </script>
</body>
</html>
