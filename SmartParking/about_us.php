<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qui somme nous?</title>
    <!-- --- bootstrap ---- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ---- fontawsome ---- -->
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
       #image-background {
            background-image: url('./images/SmartAbout.png');
            height: 300px;
            background-size: cover;
            background-position: center;
            transition: transform 0.5s ease, background-color 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 1px 1px 8px #000;
            border-radius: 12px;
        }
        #image-background:hover {
            transform: scale(1.05);
            background-color: rgba(0, 0, 0, 1);
        }
    </style>
</head>
<!-- --- header --- -->
<?php include './include/header.php' ?>

<div class="container py-3" >
            <section>
                <div class="mb-5" id="image-background"><h2>Qui Sommes-Nous ?</h2></div>
            </section>
            <section>
            <h2>Qui Sommes-Nous ?</h2>
                <p>Smart Parking Solutions est une entreprise innovante spécialisée dans les solutions de stationnement intelligent, fondée en [année de fondation]. Notre objectif est de faciliter le stationnement en milieu urbain tout en diminuant les impacts environnementaux associés à la recherche d'une place.</p>
            </section>

            <section>
                <h2>Notre Mission</h2>
                <p>Faciliter la vie des conducteurs est au cœur de notre mission. Nous offrons une plateforme qui permet non seulement de visualiser mais aussi de réserver et payer une place de parking à l'avance. Cette solution garantit une arrivée sans encombre et sans stress à votre destination.</p>
            </section>

            <section>
                <h2>Technologie et Innovation</h2>
                <p>Nos solutions intègrent des technologies de pointe telles que la reconnaissance de plaque d'immatriculation et les capteurs IoT pour assurer une expérience utilisateur fluide et efficace. En optimisant l'utilisation des espaces de stationnement, nous contribuons à réduire la congestion urbaine et à rendre les villes plus accessibles.</p>
            </section>

            <section>
                <h2>Notre Engagement</h2>
                <p>Nous collaborons étroitement avec les municipalités, les entreprises et les gestionnaires de parkings pour transformer le stationnement urbain. Notre engagement envers l'innovation et la satisfaction des clients nous motive à continuer de développer des solutions qui répondent aux défis actuels et futurs du stationnement.</p>
            </section>

            <section>
                <h2>Rejoignez Notre Vision</h2>
                <p>Adoptez Smart Parking Solutions pour une expérience de stationnement sans tracas. Votre place vous attend, vous permettant d'atteindre votre destination avec sérénité. Rejoignez-nous dans notre mission de réinvention du stationnement urbain.</p>
            </section>
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