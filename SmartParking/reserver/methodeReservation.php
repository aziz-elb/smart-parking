<?php

session_start();
// if (!isset($_SESSION['user_id'])) {
//     header('Location: ./deconnecter.php');
//     exit;
// }

$user_id = $_SESSION['user_id'];
include '../include/conncet.php';
$sql = "SELECT * FROM utilisateur WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$_SESSION['fidelite_id'] = $_SESSION['jawaz_id'] = $_SESSION['reservation_matricule'] = null;


$jawaz = $row['jawaz_id'];
$fidelite = $row['fidelite_id'];
$matricule = $row['matricule'];
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $matriculeNumber = $_POST['matriculeNumber'];
    $matriculeLetter = $_POST['matriculeLetter'];
    $matriculeRegion = $_POST['matriculeRegion'];
    if (!empty($matriculeLetter) && !empty($matriculeNumber) && !empty($matriculeRegion)) {
        $matricule = sprintf("%d - %s - %d", $matriculeNumber, $matriculeLetter, $matriculeRegion);
    }

    $_SESSION['reservation_matricule']  = $matricule;

    header('location: ./calculConfimation.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- -- Select2 -- -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

        .hidden {
            display: none;
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

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #009688;
            color: white;
            font-size: 24px;
            text-align: center;
            font-family: cairo;
        }

        .select2-results__option--selectable {
            cursor: pointer;
            font-size: 22px;
            text-align: center;
            font-family: cairo;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #212529;
            margin-top: 2px;
            line-height: 28px;
            font-size: 20px;

        }

        .select2-container .select2-selection--single {
            border: 1px solid #dee2e6;
            height: 38px;
            text-align: center;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div class="container box">
        <div class="header">
            <h2 class="text-center flex-grow-1">Choisir Methode De Reservation </h2>
            <span class="close-btn" onclick="window.history.back();"><i class="fa-solid fa-xmark fs-3"></i></span>
        </div>
        <form method="post" id="reservationForm">
            <section class="d-flex flex-column">
                <h3 class="text-center py-2 mt-3"></h3>

                <!-- Action buttons -->
                <button type="button" onclick="toggleVisibility('CartefideliteGroup', this)" class="btn btn-primary py-3 mt-3 toggle-button">Par Carte De Fidélité</button>
                <div id="CartefideliteGroup" class="mb-3 hidden">
                    <label for="Cartefidelite" class="form-label pt-3">Votre identifiant de Carte de fidélité :</label>
                    <input type="text" class="form-control" name="Cartefidelite" id="Cartefidelite" value="<?php echo $fidelite ?>">
                </div>

                <button type="button" onclick="toggleVisibility('JawazIdGroup', this)" class="btn btn-primary py-3 mt-3 toggle-button">Par Jawaz</button>
                <div id="JawazIdGroup" class="mb-3 hidden">
                    <label for="JawazId" class="form-label pt-3">Votre identifiant de Jawaz :</label>
                    <input type="text" class="form-control" name="JawazId" id="JawazId" value="<?php echo $jawaz ?>">
                </div>

                <a href="./methode_matricule.php" class="btn btn-primary py-3 mt-3 toggle-button">Par Matricule</a>

            </section>

        </form>
    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <!-- ---- select2 --- -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="../js/all.min.js"></script>
    <script src="../js/script.js"></script>
    <script>
        function toggleVisibility(groupId, triggerButton) {
            const group = document.getElementById(groupId);
            const isHidden = group.classList.contains('hidden');
            document.querySelectorAll('.mb-3').forEach(div => div.classList.add('hidden')); // Masquer tous les groupes d'entrée

            // Masquer ou afficher les boutons
            document.querySelectorAll('.toggle-button').forEach(button => {
                if (button !== triggerButton) {
                    button.style.display = isHidden ? 'none' : 'block';
                }
            });

            if (isHidden) {
                group.classList.remove('hidden'); // Afficher le groupe spécifique
                document.getElementById('nextButton').style.display = 'block';
            } else {
                resetView(); // Réinitialiser la vue si le groupe est masqué
            }
        }

        function resetView() {
            document.querySelectorAll('.mb-3').forEach(div => div.classList.add('hidden'));
            document.querySelectorAll('.toggle-button').forEach(button => button.style.display = 'block');
            document.getElementById('nextButton').style.display = 'none';
        }

        // Listen for input changes to enable the 'Next' button
        document.querySelectorAll('#reservationForm input[type="text"]').forEach(input => {
            input.addEventListener('input', () => {
                const nextButton = document.getElementById('nextButton');
                if (input.value.trim() !== '') {
                    nextButton.classList.remove('disabled');
                } else {
                    nextButton.classList.add('disabled');
                }
            });
        });

        // Initial state setup
        window.onload = function() {
            resetView(); // Initialiser l'état de la vue

            // Vérifier si les champs de texte sont déjà remplis au chargement de la page
            document.querySelectorAll('#reservationForm input[type="text"]').forEach(input => {
                if (input.value.trim() !== '') {
                    document.getElementById('nextButton').classList.remove('disabled');
                }
            });
        };
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
</body>

</html>