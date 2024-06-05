<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accueil</title>
    <!-- --- bootstrap ---- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ---- fontawsome ---- -->
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        h1 {
            font-weight: 700;
            font-size: 100px;
           

        }
         @keyframes floatAnimation {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    .float {
        animation: floatAnimation 3s ease-in-out infinite;
    }
    .moncont1{
        margin-top: 30px;
    }

    </style>
</head>
<!-- --- header --- -->
<?php include './include/header.php' ?>
<div class="container py-2 d-flex align-items-center justify-content-center" >
    <div class="row moncont1 g-5"> <!-- Ajout de g-5 pour un espacement général entre les colonnes -->
        <!-- Contenu Textuel -->
        <div class="col-12 col-lg-6 order-2 order-lg-1 text-center text-lg-start">
            <h1><span style="color: #009688;">Smart</span> Parking</h1>
            <h4 class="mt-3 mytext2" style="font-weight: 300; font-size: 20px;">Park smart, save time</h4>
            <div class="row"> <!-- Ajustement de l'espacement avant le bouton -->
                <div class="col-sm-12 col-md-6 col-lg-7  me-1 mt-3 p-0 "><a class="btn btn-primary  py-4 w-100 " href="./reserver/reserver.php" role="button" >Réserver une place &nbsp;&nbsp;<i class="fa-regular fa-credit-card"></i></a></div>
                <div class="col-sm-12  col-md-5 col-lg-4  mt-3 p-0 "><a class=" btn btn-outline-primary py-4  w-100" href="./reserver/reserver.php" role="button" >Telecharger&nbsp;&nbsp;<i class="fa-solid fa-download"></i></a></div>
            </div>
        </div>
        <!-- Image -->
        <div class="col-12 col-lg-6 order-1 order-lg-2">
            <img class="float" src="./images/car4.png" alt="image de home page" style="width: 100%;  max-width: 500px;; margin: 0 auto; display: block;">
        </div>
    </div>
</div>



<!-- ----  Footer --- -->
<?php include './include/footer.php' ?>
<!-- --- js -- -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="./js/all.min.js"></script>
<script src="./js/script.js"></script>
</body>

</html>