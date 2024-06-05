<?php
session_start();
include './include/conncet.php';

$token = $password = $password2 =  "";
$message = '';
$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Validation de la force du mot de passe avec une expression régulière
    $passwordRegex = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';

    $sql_token = "SELECT * FROM utilisateur WHERE token = '$token' AND token_date > NOW() AND email = '$email'";
    $result_token = mysqli_query($conn,$sql_token);

    if (empty($token) || empty($password) || empty($password2)) {
        $message = '<div class="alert alert-warning" role="alert">Veuillez remplir tous les champs!</div>';
    } elseif (mysqli_num_rows($result_token) == 0) {
        $message = '<div class="alert alert-warning">Le token est invalide ou a expiré.</div>';
    } elseif ($password !== $password2) {
        $message = '<div class="alert alert-warning">Les mots de passe ne correspondent pas.</div>';
    } elseif (!preg_match($passwordRegex, $password)) {
        $message = '<div class="alert alert-warning" role="alert">Le mot de passe doit contenir au moins 8 caractères, y compris des lettres et des chiffres.</div>';
    }else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql_password_update = "UPDATE utilisateur SET `password` = '$passwordHash' WHERE email = '$email'";
        $result_password = mysqli_query($conn , $sql_password_update);
        if ($result_password) {
            $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['nom'] = $row['nom'];
                $_SESSION['prenom'] = $row['prenom'];

                header('Location: ./index.php');
                exit();
                
            } 
        } else {
            $message = '<div class="alert alert-warning">Erreur lors de la mise à jour du mot de passe.</div>';
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
    <title>new password</title>
    <!-- --- bootstrap ---- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ---- fontawsome ---- -->
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<!-- --- header --- -->
<?php include './include/header.php' ?>

<div class="container py-3" style="height: 100vh;">
    <h2 class="text-center py-3">Nouveau mot de passe</h2>
    <?php if (!empty($message)) echo $message; ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="mb-3">
        <label for="token" class="form-label">Code reçu</label>
        <input type="number" class="form-control" id="token" name="token" placeholder="code reçu ici" value="<?php echo $token ?>" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe :</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="nouveau mot de passe" required>
    </div>
    <div class="mb-3">
        <label for="password2" class="form-label">Confirmer mot de passe :</label>
        <input type="password" class="form-control" id="password2" name="password2" placeholder="confimer mot de passe" required>
    </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary py-3">Se connecter</button>
        <a class="btn btn-dark" href="password_oublier.php" role="button">Retour</a>
    </div>
</form>
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