<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../deconnecter.php');
    exit;
}

include '../include/conncet.php';

$placeId = null;
$message = null;
$numPlaceDispo = null;

$sql = "SELECT COUNT(*) AS placedispo FROM `place` WHERE `est_disponible` = 1;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$numPlaceDispo = $row['placedispo'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $placeEmplacement = $_POST['place'];
    
    $_SESSION['reservation_place'] = $placeEmplacement;
    header('Location: ./methodeReservation.php');
    

}


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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
    .box {
            /* margin: auto; */
            /* margin-top: 20px; */
            background-color: #fff;
            /* padding: 30px;
            padding-left: 50px;
            padding-right: 50px; */
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

    .dispo_occup {
        font-weight: 200;
        font-size: 18px;
        margin-left: 4px;
        margin-right: 4px;
    }

    


    .vertical {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 60px;
        /* largeur du carré */
        height: 120px;
        /* hauteur du carré */
        /* border: 1px solid #D9D9D9; */
        border-radius: 8px;
        /* bordure du carré */
        display: inline-block;
        position: relative;
        background-color: #D9D9D9;
        /* couleur de fond par défaut des carrés */
        vertical-align: middle;
        margin: 4px;
        /* espace entre les carrés */
        cursor: pointer;

    }

   

    .vertical:checked {
        background-color: #222222;
        /* couleur de fond lorsqu'il est sélectionné */
        border: 1px solid #222222;        /* bordure lorsqu'il est sélectionné */
    }

    .vertical:disabled {
        background-color: #009688;

    }
    .horizontal {
    margin-top: 3.7px;
    margin-bottom: 3.7px;

    width: 120px;  /* wider for horizontal display */
    height: 60px;  /* shorter height compared to the default */

    }

   

    .label_rangee {
        text-align: center;
        margin: 5px;
        align-items: center;
    }

    .custom-radio-tooltip {
        position: relative;
        display: inline-block;
    }

    .custom-radio-tooltip .tooltip-text {
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -60px;
        /* Use half of the width (120px/2 = 60px) */
        opacity: 0;
        transition: opacity 0.3s;
    }

    .custom-radio-tooltip .tooltip-text::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: black transparent transparent transparent;
    }

    .custom-radio-tooltip:hover .tooltip-text {
        visibility: visible;
        opacity: 1;
    }
</style>
</head>

<body>
    <div class="container my-4 ">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 box">
            <div class="header p-4">
            <h2 class="text-center flex-grow-1">Choisir la place</h2>
            <span class="close-btn" onclick="window.history.back();"><i class="fa-solid fa-xmark fs-3"></i></span>
        </div>
        <form method="post">
            <section class="d-flex flex-column">
                <h3 class="text-center py-2 mt-3"></h3>
                <div>
                    <div class="d-flex shadow-none p-3 mb-5 mt-2 bg-light rounded justify-content-between align-items-center">
                        <div class="p-2">
                            <h4 style="font-weight: 300;">Place disponible</h4> <!-- Dark green text -->
                        </div>
                        <div class="bg-white text-center p-2 rounded d-flex justify-content-center align-items-center" style="color: #009688; width: 50px; height: 50px;font-size:22px;">
                            <span><?php echo $numPlaceDispo ?></span> <!-- Light green box with number -->
                        </div>
                    </div>
                    <div class="d-flex justify-content-end ">
                        <h3 class="dispo_occup">
                            Disponible <i class="fa-solid fa-square align-middle" style="color: #D9D9D9;"></i>
                        </h3>
                        <h3 class="dispo_occup">
                            Occupée <i class="fa-solid fa-square align-middle" style="color: #009688;"></i>
                        </h3>
                    </div>
                    <div>

                        <div class="d-flex flex-row justify-content-between align-items-start">
                            <div class="row_A shadow-none p-1 m-3 bg-body-tertiary rounded d-flex flex-column ">
                                <!-- <span class="label_rangee">A01</span> -->
                                <?php
                                $sqlB = "SELECT * FROM `place` WHERE `emplacement` LIKE 'A%' ";
                                $resultB = mysqli_query($conn, $sqlB);
                                while ($rowB = mysqli_fetch_array($resultB)) {
                                    $disabled = $rowB['est_disponible'] == '0' ? 'disabled' : '';
                                    echo "
                                        <label class='custom-radio-tooltip'>
                                            <input class='vertical' type='radio' name='place' id='' value='{$rowB['emplacement']}' $disabled style\"input[type='radio']{height: 105px;}\">
                                            <span class='tooltip-text'>{$rowB['emplacement']}<br>" . ($disabled ? "Occupée" : "Disponible") . "</span>
                                        </label>
                                        ";
                                }
                                ?>
                            </div>
                            <div class="row_C shadow-none p-1 m-3  bg-body-tertiary rounded d-flex flex-row">
                                <div class="d-flex flex-column">
                                    <!-- <span class="label_rangee">C01</span> -->
                                    <?php
                                    $sqlB = "SELECT * FROM `place` WHERE `emplacement` LIKE 'C%' ";
                                    $resultB = mysqli_query($conn, $sqlB);
                                    while ($rowB = mysqli_fetch_array($resultB)) {
                                        $disabled = $rowB['est_disponible'] == '0' ? 'disabled' : '';
                                        echo "
                                        <label class='custom-radio-tooltip'>
                                            <input class='vertical horizontal' type='radio' name='place' id='' value='{$rowB['emplacement']}' $disabled>
                                            <span class='tooltip-text'>{$rowB['emplacement']}<br>" . ($disabled ? "Occupée" : "Disponible") . "</span>
                                        </label>
                                        ";
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="row_D shadow-none p-1 m-3  bg-body-tertiary rounded d-flex flex-row">
                                <div class="d-flex flex-column">
                                    <!-- <span class="label_rangee">D01</span> -->
                                    <?php
                                    $sqlB = "SELECT * FROM `place` WHERE `emplacement` LIKE 'D%' ";
                                    $resultB = mysqli_query($conn, $sqlB);
                                    while ($rowB = mysqli_fetch_array($resultB)) {
                                        $disabled = $rowB['est_disponible'] == '0' ? 'disabled' : '';
                                        echo "
                                        <label class='custom-radio-tooltip'>
                                            <input class='vertical horizontal' type='radio' name='place' id='' value='{$rowB['emplacement']}' $disabled>
                                            <span class='tooltip-text'>{$rowB['emplacement']}<br>" . ($disabled ? "Occupée" : "Disponible") . "</span>
                                        </label>
                                        ";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row_B shadow-none p-1 m-3  bg-body-tertiary rounded d-flex justify-content-start">
                            <!-- <span class="label_rangee" style="margin-top: 16px; margin-right :10px;">B01</span> -->
                            <?php
                            $sqlB = "SELECT * FROM `place` WHERE `emplacement` LIKE 'B%' ";
                            $resultB = mysqli_query($conn, $sqlB);
                            while ($rowB = mysqli_fetch_array($resultB)) {
                                $disabled = $rowB['est_disponible'] == '0' ? 'disabled' : '';
                                echo "
                               <label class='custom-radio-tooltip'>
                               <input class='vertical' type='radio' name='place' id='' value='{$rowB['emplacement']}' $disabled>
                               <span class='tooltip-text'>{$rowB['emplacement']}<br>" . ($disabled ? "Occupée" : "Disponible") . "</span>
                               </label>
                               ";
                            }
                            ?>

                        </div>

                    </div>
                </div>

                <button class="btn btn-primary py-3 mt-3" type="submit">Suivant <i class="fa-solid fa-arrow-right"></i></button>
            </section>
        </form>
            </div>
        </div>
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

