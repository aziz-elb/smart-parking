<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ./deconnecter.php');
    exit;
}

$user_id = $_SESSION['user_id'];
include '../include/conncet.php';
$sql = "SELECT * FROM utilisateur WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$matricule = $row['matricule'];

$_SESSION['methode_reservation'] = 'Matricule';
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
            <h2 class="text-center flex-grow-1">Reservation Par Matricule</h2>
            <span class="close-btn" onclick="window.history.back();"><i class="fa-solid fa-xmark fs-3"></i></span>
        </div>
        <form method="post" id="reservationForm">
            <section class="d-flex flex-column">
                <h3 class="text-center py-2 mt-3"></h3>
                <div  class="mb-3">
                    <label for="MatriculeId" class="form-label pt-3">Votre Matricule :</label>
                    <label for="matricule" class="form-label">Matricule</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" id="matriculeNumber" name="matriculeNumber" value="<?php echo $matriculeNumber ?>" placeholder="1-99999" required pattern="[1-9]\d{0,4}">
                        </div>
                        <div class="col">
                            <select name="matriculeLetter" class="js-example-basic-single" style="width: 100%;" aria-placeholder="أ-ي" required>
                                <?php
                                $arabicAlphabet = ['','أ', 'ب', 'ت', 'ث', 'ج', 'ح', 'خ', 'د', 'ذ', 'ر', 'ز', 'س', 'ش', 'ص', 'ض', 'ط', 'ظ', 'ع', 'غ', 'ف', 'ق', 'ك', 'ل', 'م', 'ن', 'ه', 'و', 'ي'];
                                foreach ($arabicAlphabet as $letter) {
                                    $selected = ($matriculeLetter === $letter) ? 'selected' : '';
                                    echo "<option value='$letter' $selected>$letter</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="matriculeRegion" name="matriculeRegion" value="<?php echo $matriculeRegion ?>" placeholder="1-89" required pattern="(8[0-9]|[1-7][0-9]|[1-9])">
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary py-3 mt-3 " type="submit" id="nextButton">Suivant <i class="fa-solid fa-arrow-right"></i></button>
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
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
</body>

</html>