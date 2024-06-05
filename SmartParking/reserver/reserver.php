<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../connecter.php');
    exit;
}

include '../include/conncet.php';

$dateD = $dateF = null;
$message = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$dateD = $_POST['datedebut'];
$dateF = $_POST['datefin'];

$_SESSION['reservation_dateD'] = $dateD; 
$_SESSION['reservation_dateF'] = $dateF;

header('Location: ./choisir_place.php');
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
        
        
    </style>
</head>

<body>
    <div class="container box">
        <div class="header">
            <h2 class="text-center flex-grow-1">Choisir la durée</h2>
            <span class="close-btn" onclick="window.history.back();"><i class="fa-solid fa-xmark fs-3"></i></span>
        </div>
        <form method="post">
            <section class="d-flex flex-column">
                <h3 class="text-center py-2 mt-3"> </h3>
                <div class="d-flex flex-column">
                    <div class="mb-3">
                        <label  for="datedebut" class="form-label">Date Debut :</label>
                        <input  class="form-control" type="datetime-local" name="datedebut" id="datedebut" placeholder="Date Debut">
                    </div>
                    <div class="mb-3">
                        <label  for="datefin" class="form-label">Date Fin :</label>
                        <input class="form-control" type="datetime-local" name="datefin" id="datefin" placeholder="Date fin">
                    </div>

                </div>
                <button class="btn btn-primary py-3 mt-3" type="submit">Suivant <i class="fa-solid fa-arrow-right"></i></button>
            </section>
           
        </form>
    </div>
    <!-- ----  Footer --- -->

    <!-- --- js -- -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <!-- flatpikr js -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- fontawsoome  -->
    <script src="../js/all.min.js"></script>
    <script src="../js/script.js"></script>


    <script>
        config1 = {
            defaultDate: "2024-05-07 13:45",
            minDate: "2024-05-07 12:00",
            minTime: "12:00",
            enableTime: true,
            altInput: true,
            altFormat: "H:i   j F Y",
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            
        }
        config2 = {
            defaultDate: "2024-05-07 14:45",
            minDate: "2024-05-07 12:00",
            minTime: "12:00",
            enableTime: true,
            altInput: true,
            altFormat: "H:i   j F Y",
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            
        }
        flatpickr("#datedebut", config1);
        flatpickr("#datefin",config2);
    </script>


</body>

</html>