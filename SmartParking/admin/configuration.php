<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['est_admin'] != '1') {
    header('Location: ../deconnecter.php');
    exit;
}


include '../include/conncet.php';






$message = '';
$id_utilisateur = $_SESSION['user_id'];
$Sql_affiche = "SELECT * FROM utilisateur WHERE user_id = $id_utilisateur";
$result_affiche = mysqli_query($conn, $Sql_affiche);
$row = mysqli_fetch_array($result_affiche);

$prenom = $row['prenom'];
$nom = $row['nom'];
$email = $row['email'];
$password_old  = $row['password'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = strtolower(trim($_POST['prenom']));
    $nom = strtolower(trim($_POST['nom']));
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];

    if (empty($prenom) || empty($nom) || empty($email) || empty($password)) {
        $message = '<div class="alert alert-warning">Tous les champs doivent être remplis.</div>';
    } elseif (!password_verify($password, $password_old)) {
        $message = '<div class="alert alert-warning">Le mot de passe est incorrect.</div>';
    } else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `utilisateur` SET `prenom`='$prenom', `nom`='$nom', `email`='$email', `password`='$passwordHash' WHERE `user_id` = '$id_utilisateur'";
        if (mysqli_query($conn, $sql)) {
            $message = '<div class="alert alert-success">Compte mis à jour avec succès.</div>';
        } else {
            $message = '<div class="alert alert-danger">Erreur lors de la mise à jour : ' . mysqli_error($conn) . '</div>';
        }
    }
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration</title>
    <!-- --- bootstrap ---- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- -- Select2 -- -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- ---- fontawsome ---- -->
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
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

    <!-- --- header --- -->
    <?php include './include/header.php' ?>

    <div class="container  w-75 py-5 mb-5" >
        <h2 class="text-center py-3">Configuration</h2>
        <?php if (!empty($message)) echo $message; ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom <i class="fa-solid fa-asterisk text-danger" style="font-size: 10px; position: relative; top: -6px;"></i></label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $prenom ?>" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom <i class="fa-solid fa-asterisk text-danger" style="font-size: 10px; position: relative; top: -6px;"></i></label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email <i class="fa-solid fa-asterisk text-danger" style="font-size: 10px; position: relative; top: -6px;"></i></label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe <i class="fa-solid fa-asterisk text-danger" style="font-size: 10px; position: relative; top: -6px;"></i></label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Confirmer par mot de passe">
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary py-3">Modifier</button>
                <a class="btn btn-dark" href="./dashbord.php" role="button">Retour</a>
            </div>
        </form>
    </div>


    <!-- --- js -- -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <!-- ---- select2 --- -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="../js/all.min.js"></script>
    <script src="./js/script.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
</body>

</html>