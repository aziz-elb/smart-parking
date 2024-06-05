<header>
    <nav class="navbar navbar-expand-md bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./dashbord.php">
                <img src="../images/SmartParkingwhite.png" alt="Smart Parking logo" style="width: 120px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'dashbord.php' ? 'active' : ''; ?>" aria-current="page" href="./dashbord.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'utilisateurs.php' ? 'active' : ''; ?>" href="./utilisateurs.php">Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'reservations.php' ? 'active' : ''; ?>" href="./reservations.php">Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'places.php' ? 'active' : ''; ?>" href="./places.php">Places</a>
                    </li>
                    <li class="nav-item dropdown btn-group d-flex flex-column">
                        <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo strtoupper($_SESSION['nom']) . ' ' . $_SESSION['prenom']; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-sm-start dropdown-menu-end dropdown-menu-lg-end monul ">
                            <li class="nav-item">
                                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'configuration.php' ? 'active' : ''; ?>" href="./configuration.php"><i class="fa-solid fa-gear"></i>&nbsp;&nbsp;Configuration</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'modifier_password.php' ? 'active' : ''; ?>" href="./modifier_password.php"><i class="fa-solid fa-lock"></i>&nbsp;&nbsp;Modifier mot de passe</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'deconnecter.php' ? 'active' : ''; ?>" href="../deconnecter.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;&nbsp;Déconnecter</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
    .navbar-nav .nav-item {
        margin-right: 16px;
        
    }
    .monul{
        width: 300px;
    }
    @media only screen and (max-width: 768px) {
    /* Styles spécifiques pour les tablettes */
    .monul {
        width: 100%;
        padding: 4px;
    }
}
@media only screen and (min-width: 768px) and (max-width: 1024px){
    /* Styles spécifiques pour les tablettes */
    .monul {
        width: 300px;
        padding: 4px;
        margin-left: -50px; 
    }
}
    
</style>
