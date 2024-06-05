<?php

require "vendor/autoload.php";

use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$name = '';
$lastname = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $lastname  = $_POST['lastname'];
    $email = $_POST['email'];

    $monText = "name: $name \nlastname: $lastname \nemail: $email";

    $qr_code = QrCode::create($monText)
    ->setEncoding(new Encoding('ISO-8859-1'));

    $writer = new PngWriter;
    $result = $writer->write($qr_code);

    // Save the QR code image to a file
    $result->saveToFile("mynicephoto.png");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>

<body>

    <form method="post">
        name <input type="text" name="name" id="" value="<?php echo $name ?>"><br>
        lastname <input type="text" name="lastname" id="" value="<?php echo $lastname ?>"><br>
        email <input type="text" name="email" value="<?php echo $email ?>"><br>
        <button type="submit">Generate QR Code</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') : ?>
        <?php if (isset($result)) : ?>
            <hr>
            <h2>QR Code:</h2>
            <img src="mynicephoto.png" alt="QR Code">
            <p><a href="mynicephoto.png" download>Download QR Code</a></p>
        <?php endif; ?>
    <?php endif; ?>

</body>

</html>
