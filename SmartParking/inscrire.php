<?php
session_start();
include './include/conncet.php'; // Assurez-vous que le nom du fichier est correct

$message = '';
$prenom = $nom = $email = $password = $password2 = $jawaz = $fidelite  = null;
$matriculeNumber = $matriculeLetter = $matriculeRegion = null;
$matricule = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = strtolower(trim(mysqli_real_escape_string($conn, $_POST['prenom'])));
    $nom = strtolower(trim(mysqli_real_escape_string($conn, $_POST['nom'])));
    $email = strtolower(trim(mysqli_real_escape_string($conn, $_POST['email'])));
    $password =  $_POST['password'];
    $password2 = $_POST['password2'];
    $jawaz = mysqli_real_escape_string($conn, $_POST['jawaz']);
    $fidelite = mysqli_real_escape_string($conn, $_POST['fidelite']);

    $matriculeNumber = $_POST['matriculeNumber'];
    $matriculeLetter = $_POST['matriculeLetter'];
    $matriculeRegion = $_POST['matriculeRegion'];
    if (!empty($matriculeLetter) && !empty($matriculeNumber) && !empty($matriculeRegion)) {
        $matricule = sprintf("%d - %s - %d", $matriculeNumber, $matriculeLetter, $matriculeRegion);
    }


    // Validation de la force du mot de passe
    $passwordRegex = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';

    // Vérification des entrées pour éviter l'enregistrement de données vides et de la correspondance des mots de passe
    if (empty($prenom) || empty($nom) || empty($email) || empty($password) || empty($password2)) {
        $message = '<div class="alert alert-warning">Tous les champs doivent être remplis.</div>';
    } elseif ($password !== $password2) {
        $message = '<div class="alert alert-warning">Les mots de passe ne correspondent pas.</div>';
    } elseif (!preg_match($passwordRegex, $password)) {
        $message = '<div class="alert alert-warning" role="alert">Le mot de passe doit contenir au moins 8 caractères, y compris des lettres et des chiffres.</div>';
    } else {
        // Vérifier si l'email existe déjà
        $query = "SELECT * FROM utilisateur WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $message = '<div class="alert alert-danger">Cet email est déjà utilisé par un autre compte.</div>';
        } else {


            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO utilisateur (prenom, nom, email, password, jawaz_id, fidelite_id,matricule) VALUES ('$prenom', '$nom', '$email', '$passwordHash', '$jawaz', '$fidelite','$matricule')";
            if (mysqli_query($conn, $sql)) {

                header('Location: ./connecter.php');
                exit();
                // $message = '<div class="alert alert-success">Inscription réussie.</div>';
            } else {
                $message = '<div class="alert alert-danger">Erreur lors de l\'inscription : ' . mysqli_error($conn) . '</div>';
            }
        }
    }
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- --- bootstrap ---- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- -- Select2 -- -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- ---- fontawsome ---- -->
    <link rel="stylesheet" href="./css/all.min.css">
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
<!-- --- header --- -->
<?php include './include/header.php' ?>

<div class="container py-3" >
    <h2 class="text-center py-3">Inscription</h2>
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
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password2" class="form-label">Confirmer Mot de passe <i class="fa-solid fa-asterisk text-danger" style="font-size: 10px; position: relative; top: -6px;"></i></label>
            <input type="password" class="form-control" id="password2" name="password2" required>
        </div>
        <div class="mb-3">
            <label for="jawaz" class="form-label">Jawaz </label>
            <input type="text" class="form-control" id="jawaz" name="jawaz" value="<?php echo $jawaz ?>">
        </div>
        <div class="mb-3">
            <label for="fidelite" class="form-label">fidélité </label>
            <input type="text" class="form-control" id="fidelite" name="fidelite" value="<?php echo $fidelite ?>">
        </div>
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule</label>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" id="matriculeNumber" name="matriculeNumber" value="<?php echo $matriculeNumber ?>" placeholder="1-99999"  pattern="[1-9]\d{0,4}">
                </div>
                <div class="col">
                    <select name="matriculeLetter" class="js-example-basic-single" style="width: 100%;" aria-placeholder="أ-ي">
                        <?php
                        $arabicAlphabet = ['أ', 'ب', 'ت', 'ث', 'ج', 'ح', 'خ', 'د', 'ذ', 'ر', 'ز', 'س', 'ش', 'ص', 'ض', 'ط', 'ظ', 'ع', 'غ', 'ف', 'ق', 'ك', 'ل', 'م', 'ن', 'ه', 'و', 'ي'];
                        foreach ($arabicAlphabet as $letter) {
                            $selected = ($matriculeLetter === $letter) ? 'selected' : '';
                            echo "<option value='$letter' $selected>$letter</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="matriculeRegion" name="matriculeRegion" value="<?php echo $matriculeRegion ?>" placeholder="1-89"  pattern="(8[0-9]|[1-7][0-9]|[1-9])">
                </div>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary py-3">S'inscrire</button>
            <a class="btn btn-dark" href="connecter.php" role="button">Retour</a>
        </div>
    </form>
</div>




<!-- ----  Footer --- -->
<?php include './include/footer.php' ?>
<!-- --- js -- -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<!-- ---- select2 --- -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="./js/all.min.js"></script>
<script src="./js/script.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
</body>

</html>