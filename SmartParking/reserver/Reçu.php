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
$matricule = $matriculeNumber . ' - <span style="direction: rtl; display: inline-block;">' . $matriculeLetter . '</span> - ' . $matriculeRegion;

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
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .box {
            background-color: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 100%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .close-btn {
            cursor: pointer;
            color: #666;
        }

        .close-btn:hover {
            color: #333;
        }

        p {
            text-align: center;
            margin: 5px 0;
        }

        h4 {
            margin-top: 10px;
        }

        .qr-code img {
            display: block;
            margin: 0 auto;

        }

        .content-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
        }

        table tr td {
            padding: 5px 10px;
        }

        .span-primary {
            /* Adjust styling for the secondary spans */
            font-weight: bold;
            /* Example */
        }

        .span-secondary {
            font-weight: 300;
            /* Adjust styling for the primary spans */
        }
    </style>
</head>

<body>
    <div class="container box">
        <div class="header">
            <h2 class="text-center flex-grow-1">le Reçu</h2>
            <span class="close-btn" onclick="window.history.back();"><i class="fa-solid fa-xmark fs-3"></i></span>
        </div>
        <div class="row" id="receipt-content">
            <div class="col-sm-8 col-md-8 col-lg-8">
                <div class="content-container">
                    <table>
                        <tr>
                            <td class="span-secondary">Utilisateur :</td>
                            <td class="span-primary"><?php echo "$nom $prenom"; ?></td>
                        </tr>
                        <?php if ($methodeReservation == 'Matricule') { ?>
                            <tr>
                                <td class="span-secondary"><?php echo "$methodeReservation :"; ?></td>
                                <td class="span-primary"><?php echo "$matricule"; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="span-secondary">Place :</td>
                            <td class="span-primary"><?php echo "$place"; ?></td>
                        </tr>
                        <tr>
                            <td class="span-secondary">De :</td>
                            <td class="span-primary"><?php echo "$dateDebut "; ?></td>
                        </tr>
                        <tr>
                            <td class="span-secondary">A :</td>
                            <td class="span-primary"><?php echo "$dateFin"; ?></td>
                        </tr>
                        <tr>
                            <td class="span-secondary">Paiment :</td>
                            <td class="span-primary"><?php echo "$money MAD"; ?></td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 d-flex justify-content-center align-items-center">
                <?php echo "<img src='$img' class='img-fluid' style='max-width: 75%;'>"; ?>
            </div>

        </div>
        <div>
            <div class="d-grid gap-2 px-3">
                <a href="pdf_content.php?generate_pdf=true" class="btn btn-primary py-3">Télécharger le Reçu <i class="fa-solid fa-download"></i></a>
            </div>

        </div>
    </div>

    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="../js/script.js"></script>

    <script>
        document.getElementById('download-pdf').addEventListener('click', () => {
            html2pdf().from('pdf_content.php').set({
                margin: 0,
                filename: 'receipt.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 10
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            }).save();
        });
    </script>
</body>

</html>