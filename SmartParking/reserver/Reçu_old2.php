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
            padding: 30px;
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

        .prix {
            padding: 100px;
        }

        p {
            text-align: center;
        }
    </style>
    
</head>
<body>
<!-- Your PHP code to generate the content goes here -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../deconnecter.php');
    exit;
}

include '../include/conncet.php';
$nom = strtoupper($_SESSION['nom']);
$prenom = $_SESSION['prenom'];
$methodeReservation = $_SESSION['methode_reservation'];

$matricule = $_SESSION['reservation_matricule'];
$dateDebut = $_SESSION['reservation_dateD'];
$dateFin  = $_SESSION['reservation_dateF'];
$place = $_SESSION['reservation_place'];
$money = $_SESSION['reservation_money'];

$img = $_SESSION['reservation_qrcode'];

if (!empty($matricule)) {
    $matricule_parts = explode(' - ', $matricule);
    if (count($matricule_parts) === 3) {
        $matriculeNumber = $matricule_parts[0];
        $matriculeLetter = $matricule_parts[1];
        $matriculeRegion = $matricule_parts[2];
    }
} else {
    $matriculeNumber = $matriculeLetter = $matriculeRegion = null;
}
?>

<div class="container box" id="receipt-content">
    <div class="header">
        <h2 class="text-center flex-grow-1">Télécharger le Reçu</h2>
        <span class="close-btn" onclick="window.history.back();"><i class="fa-solid fa-xmark fs-3"></i></span>
    </div>
    <section class="d-flex flex-column">
        <h4 class="utilisateur mt-4">Utilisateur :</h4>
        <p><?php echo "$nom $prenom"; ?></p>
        <?php if ($methodeReservation === 'Matricule') { ?>
            <h4 class="identifiant"><?php echo $methodeReservation; ?> :</h4>
            <p style="direction: ltr;"><?php echo $matriculeNumber; ?> - <span style="direction: rtl; display: inline-block;"><?php echo $matriculeLetter; ?></span> - <?php echo $matriculeRegion; ?></p>
        <?php } ?>
        <h4 class="Qrcode">Place :</h4>
        <p><?php echo "$place"; ?></p>
        <h4 class="Duree">Durée :</h4>
        <p>Date Debut : <?php echo "$dateDebut"; ?><br>Date Fin : <?php echo "$dateFin"; ?></p>
        <h4 class="Qrcode">Paiement :</h4>
        <p><?php echo "$money MAD"; ?></p>
        <h4 class="Qrcode">Qr-Code :</h4>
        <p><img src="<?php echo $img; ?>" width="150px"></p>
    </section>
    <button class="btn btn-primary py-3 mt-3" id="download-pdf">Télécharger le Reçu <i class="fa-solid fa-download"></i></button>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<!-- Include html2pdf.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" ></script>
<script src="../js/all.min.js"></script>
<script src="../js/script.js"></script>

<script>
document.getElementById('download-pdf').addEventListener('click', () => {
    const element = document.getElementById('receipt-content');
    html2pdf().from(element).save();
});
</script>
</body>
</html>
