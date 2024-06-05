<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['est_admin'] != '1') {
    header('Location: ../deconnecter.php');
    exit;
}

include '../include/conncet.php';

$sql = "SELECT COUNT(*)AS nbrPlacesDispo FROM place WHERE est_disponible = '1';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


$nbrPlacesDispo = $row['nbrPlacesDispo'] ;



$sql = "SELECT COUNT(*) AS nbrClients FROM utilisateur;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


$nbrClients = $row['nbrClients'] ;



$sql = "SELECT COUNT(*) as nbrReservation FROM reservation ;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


$nbrReservation = $row['nbrReservation'] ;



$sql = "SELECT COALESCE(SUM(paiment), 0) AS profitTotal FROM reservation;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


$profitTotal = $row['profitTotal'] ;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Document</title>
    <!-- --- bootstrap ---- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ---- fontawsome ---- -->
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        body {
            background: #FAFAFA;
        }

        .order-card {
            color: #fff;
        }

        .bg-c-blue {
            background: linear-gradient(45deg, #4099ff, #73b4ff);
        }

        .bg-c-green {
            background: linear-gradient(45deg, #009688, #0E6655);
            /* background: #1D976C; */
            /* fallback for old browsers */
            /* background: -webkit-linear-gradient(to right, #93F9B9, #1D976C); */
            /* Chrome 10-25, Safari 5.1-6 */
            /* background: linear-gradient(to right, #93F9B9, #1D976C); */
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

        .bg-c-yellow {
            background: linear-gradient(45deg, #FFB64D, #ffcb80);
        }

        .bg-c-pink {
            background: linear-gradient(45deg, #FF5370, #ff869a);
        }


        .card {
            padding: 10px;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .card .card-block {
            padding: 25px;
        }

        .order-card i {
            font-size: 26px;
        }

        .f-left {
            float: left;
        }

        .f-right {
            float: right;
        }
    </style>
</head>

<body>
    <?php include './include/header.php'; ?>


    <div class="container py-2">


        <div class="row mt-2">
            <div class="card mb-4">
                <div class="row g-0 p-3">
                    <div class="col-md-4 text-center">
                        <img src="../images/admin.svg" class="img-fluid rounded-start" alt="..." style="width: 300px;">
                    </div>
                    <div class="col-md-8  p-4">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">Bonjour !</h5>
                            <p class="card-text">Bienvenue, <span class="fw-semibold" style="color: #009688;">Administrateur</span>, sur le tableau de bord de Smart Parking.</p>
                            <p class="card-text">Explorez toutes les fonctionnalités disponibles pour administrer votre plateforme de stationnement intelligent.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6 col-md-6 col-xl-3 ">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h4 class="m-b-20 fs-6">Places disponibles </h4>
                        <h5 class="text-right my-4"><i class="fa-solid fa-car-side me-4"></i><span><?php echo  $nbrPlacesDispo ?></span></h5>

                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-xl-3 ">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h4 class="m-b-20 fs-6">Reservations </h4>
                        <h5 class="text-right my-4"><i class="fa-solid fa-credit-card me-4"></i><span><?php echo  $nbrReservation ?></span></h5>

                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-xl-3 ">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h4 class="m-b-20 fs-6">Clients</h4>
                        <h5 class="text-right my-4"><i class="fa-solid fa-user-group me-4"></i><span><?php echo $nbrClients ?></span></h5>

                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h4 class="m-b-20 fs-6">Profit (MAD)</h4>
                        <h5 class="text-right my-4"><i class="fa-solid fa-money-bill-wave me-4"></i><span><?php echo $profitTotal ?> </span></h5>
                    </div>
                </div>
            </div>
        </div>





    </div>

    <!-- --- js -- -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="../js/script.js"></script>
    <script>

    </script>
</body>


</html>