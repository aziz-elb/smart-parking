<header>
    <nav class="navbar navbar-expand-md ">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">
                <img src="./images/SmartParking.png" alt="Smart Parking logo" style="width: 120px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : ''; ?>" aria-current="page" href="./index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'about_us.php' ? 'active' : ''; ?>" href="about_us.php">Qui sommes nous?</a>
                    </li>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '
                            <li class="nav-item dropdown btn-group d-flex flex-column">
                                <button class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">' .
                                                    strtoupper($_SESSION['nom']) . ' ' . $_SESSION['prenom'] .
                                                    '</button>
                                <ul class="dropdown-menu dropdown-menu-sm-start dropdown-menu-end dropdown-menu-lg-end monul">
                                    <li class="nav-item">
                                        <a class="nav-link ' . (basename($_SERVER['PHP_SELF']) === 'config.php' ? 'active' : '') . '" href="config.php"><i class="fa-solid fa-gear"></i>&nbsp;&nbsp;Configuration</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ' . (basename($_SERVER['PHP_SELF']) === 'config_passwd.php' ? 'active' : '') . '" href="config_passwd.php"><i class="fa-solid fa-lock"></i>&nbsp;&nbsp;Modifier mot de passe</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ' . (basename($_SERVER['PHP_SELF']) === 'deconnecter.php' ? 'active' : '') . '" href="deconnecter.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;&nbsp;Deconnecter</a>
                                    </li>
                                </ul>
                            </li>';
                    } else {
                        echo "<li class='nav-item btn-group '><a class='btn btn-outline-dark nav-link " . (basename($_SERVER['PHP_SELF']) === 'connecter.php' ? 'active' : '') . "' href='connecter.php'>Connecter</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<style>
    .btn-outline-dark.nav-link {
    color: #343a40; /* Couleur de texte */
    border: 1px solid #343a40;
    border-color: #343a40; /* Couleur de la bordure */
}

.btn-outline-dark.nav-link:hover {
    color: #fff; /* Couleur de texte au survol */
    background-color: #343a40; /* Remplissage au survol */
}

.btn-outline-dark.nav-link.active {
    color: #fff; /* Couleur de texte */
    background-color: #343a40; /* Couleur de fond */
}
    .navbar-toggler:focus {
        text-decoration: none;
        outline: 0;
        box-shadow: 0 0 8px #009688;
    }

.navbar-nav .nav-item {
        margin-right: 16px;

    }

    .monul {
        width: 300px;
    }

    @media only screen and (max-width: 768px) {

        /* Styles spécifiques pour les tablettes */
        .monul {
            width: 100%;
            padding: 4px;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {

        /* Styles spécifiques pour les tablettes */
        .monul {
            width: 300px;
            padding: 4px;
            margin-left: -50px;
        }
    }
</style>

