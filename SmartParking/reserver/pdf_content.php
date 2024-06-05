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


///////

// Include necessary files and retrieve session data

// Check if the parameter for PDF generation is present
if (isset($_GET['generate_pdf']) && $_GET['generate_pdf'] === 'true') {
    // Output PDF generation script directly to the browser
    echo '<script>
            document.addEventListener(\'DOMContentLoaded\', () => {
                const content = document.querySelector(\'.content-container\');
        
                html2pdf()
                    .from(content)
                    .set({
                        margin: 1,
                        filename: \'receipt.pdf\',
                        image: {
                            type: \'jpeg\',
                            quality: 1
                        },
                        html2canvas: {
                            scale: 2
                        },
                        jsPDF: {
                            unit: \'in\',
                            format: \'letter\',
                            orientation: \'portrait\'
                        }
                    })
                    .save();
            });
        </script>';
} else {
    // Redirect to the page with the parameter indicating PDF generation
    header('Location: Reçu.php');
    exit;
}

///////



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
            background-color: #f2f2f2;
        }

        .content-container {
            background-color: #ffffff;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 95%;
            /* Réduire la largeur maximale pour mieux s'adapter au PDF */
        }

        table {
            width: 100%;
            margin-bottom: 10px;
            /* Ajouter un peu d'espacement en bas de la table */
        }

        table tr td {
            padding: 8px 12px;
            /* Réduire légèrement le padding pour optimiser l'espace */
            border-bottom: 1px solid #eee;
        }

        .span-primary {
            font-weight: bold;
            font-size: 12px;
            /* Réduire la taille de la police */
        }

        .span-secondary {
            font-weight: 300;
            font-size: 12px;
            /* Réduire la taille de la police */
        }

        .img-fluid {
            max-width: 100%;
            /* Ajuster la taille maximale des images */
            height: auto;
        }

        .img-container {
            text-align: center;
            margin-bottom: 10px;
            /* Ajouter un peu d'espacement en bas de l'image */
        }

        .header {
    position: relative; /* Ajouter une position relative au conteneur du header */
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.header img {
    max-width: 200px;
    margin-bottom: 10px;
}

.close-btn {
    display: none;
    position: absolute; /* Positionner le bouton de fermeture de façon absolue */
    top: 5px; /* Ajuster la position verticale par rapport au haut */
    right: 10px; /* Ajuster la position horizontale par rapport à droite */
    cursor: pointer;
    color: #666;
}

.close-btn:hover {
    color: #333;
}

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center align-items-center">
                <div class="content-container ">
                    <div class="header">
                        <span class="text-center"><img class="p-1" src="../images/SmartParking.png" alt="" width="100px"></span>
                        <span class="close-btn" onclick="window.history.back();"><i class="fa-solid fa-xmark fs-3"></i></span>
                    </div>
                    <table>
                        <tr>
                            <td></td>
                        </tr>
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
                    <div class="img-container">
                        <?php echo "<img src='$img' class='img-fluid'>"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="../js/all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const closeButton = document.querySelector('.close-btn');
                if (closeButton) {
                    closeButton.style.display = 'block';
                }
            }, 2000); // 2000 milliseconds = 2 seconds
        });
    </script>
</body>


</html>