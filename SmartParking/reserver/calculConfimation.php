<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../deconnecter.php');
    exit;
}


require "vendor/autoload.php";

use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


include '../include/conncet.php';

$dateD = $dateF = null;
$message = null;
$money = null;
$parkingPAY = 10; // 1hour parking ==> 10 MAD

$user_id = $_SESSION['user_id'];
$dateF = strtotime($_SESSION['reservation_dateF']); // Assuming $dateF holds a date string or timestamp
$dateD = strtotime($_SESSION['reservation_dateD']); // Assuming $dateD holds a date string or timestamp


$nom = strtoupper($_SESSION['nom']);
$prenom = $_SESSION['prenom'];
$email =  $_SESSION['email'];
$methodeReservation = $_SESSION['methode_reservation'];
$place = $_SESSION['reservation_place'];

$matricule = $_SESSION['reservation_matricule'];
$jawaz_id = $_SESSION['jawaz_id'];
$fidelite_id = $_SESSION['fidelite_id'];


// Check if both dates are valid
if ($dateF !== false && $dateD !== false) {
    // Perform subtraction
    $difference = $dateF - $dateD;
} else {
    echo "Invalid date format.";
}

$money = ($difference/3600)* $parkingPAY +  ($difference%3600)* $parkingPAY;

$_SESSION['reservation_money'] = $money;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if($methodeReservation == 'Matricule'){
        $monText = "Nom: $nom \nPrenom: $prenom  \nEmail: $email \nMatricule: $matricule \nPlace: $place \nPaiment: $money MAD\nDate debut : {$_SESSION['reservation_dateD']} \nDate fin : {$_SESSION['reservation_dateF']}";
    }elseif($methodeReservation == 'Jawaz'){
        $monText = "Nom: $nom \nPrenom: $prenom  \nEmail: $email \nJawaz: $jawaz_id \nPlace: $place \nPaiment: $money \nDate debut : {$_SESSION['reservation_dateD']} \nDate fin : {$_SESSION['reservation_dateF']}";
    }elseif($methodeReservation == 'Fidelite'){
        $monText = "Nom: $nom \nPrenom: $prenom  \nEmail: $email \nFidelite: $fidelite_id \nPlace: $place \nPaiment: $money \nDate debut : {$_SESSION['reservation_dateD']} \nDate fin : {$_SESSION['reservation_dateF']}";
    }
    $qr_code = QrCode::create($monText);
    // ->setEncoding(new Encoding('ISO-8859-1'));

    $writer = new PngWriter;
    $result = $writer->write($qr_code);

    
    $file_name =  './qrcodes/' . time().'.png';

    $file_name_db = mysqli_real_escape_string($conn,$file_name);
    $_SESSION['reservation_qrcode'] = $file_name;
    // Save the QR code image to a file
    $result->saveToFile($file_name);

$sql = "INSERT INTO `reservation`(`user_id_fk`, `place_emplacement_fk`, `matricule`, `jawaz_id_fk`, `fidelite_id_fk`, `date_debut`, `date_fin`, `paiment` , `qr_code_img`) 
                        VALUES ('$user_id','$place','$matricule','$jawaz_id','$fidelite_id','{$_SESSION['reservation_dateD']}','{$_SESSION['reservation_dateF']}','$money','$file_name_db')";

$result = mysqli_query($conn, $sql);
if($result){
// $sql_place = "UPDATE `place` SET est_disponible = 0 WHERE emplacement = '$place";
header('Location: ./Reçu.php');
}
else{
    echo "Error:les donnees ne sont pas inserer correctement dans la base de donnes";
}


}

// header('Location: ./Reçu.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accueil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .box {
            margin: auto;
            margin-top: 20px;
            background-color: #fff;
            padding-top: 30px;
            padding-bottom: 30px;
            border-radius: 6px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #ccc;
        }

        .close-btn {
            cursor: pointer;
            color: #666;
        }

        .close-btn:hover {
            color: #333;
        }
        .prix{

            padding-top: 100px;
            padding-bottom: 100px;
        }
        
    </style>
</head>

<body>
    <div class="container box">
        <div class="header">
            <h2 class="text-center flex-grow-1">Finaliser La Reservation </h2>
            <span class="close-btn" onclick="window.history.back();"><i class="fa-solid fa-xmark fs-3"></i></span>
        </div>
        <form method="post">
            <section class="d-flex flex-column">
                <h3 class="text-center py-2 mt-3"></h3>
                <div class="text-center prix bg-body-tertiary rounded ">
                    <span class="bg-white p-0 rounded fs-3">
                       <?php echo "$money  MAD";?>
                    </span>

                </div>
                <button class="btn btn-primary py-3 mt-3" type="submit">Confirmer <i class="fa-solid fa-arrow-right"></i></button>
            </section>
           
        </form>
    </div>
    <!-- ----  Footer --- -->

    <!-- --- js -- -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <!-- fontawsoome  -->
    <script src="../js/all.min.js"></script>
    <script src="../js/script.js"></script>


    <script>
    </script>


</body>

</html>