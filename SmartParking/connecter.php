<?php
session_start();
include './include/conncet.php';

$email = $password = "";
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $message = '<div class="alert alert-warning" role="alert">Veuillez remplir tous les champs!</div>';
    } else {
        // Cette méthode est vulnérable aux injections SQL
        $sql = "SELECT * FROM utilisateur WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Vérifie si le mot de passe correspond en utilisant MD5 (obsolète)
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['nom'] = $row['nom'];
                $_SESSION['prenom'] = $row['prenom'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['est_admin'] =  $row['est_admin'];
                if ($row['est_admin'] == '1') {
                    header('location: ./admin/dashbord.php');
                    exit();
                } else {
                    header('Location: ./index.php');
                    exit();
                }
            } else {
                $message = '<div class="alert alert-danger" role="alert">Mot de passe <strong>incorrect</strong>!</div>';
            }
        } else {
            $message = '<div class="alert alert-danger" role="alert">Utilisateur <strong>non trouvé</strong>!</div>';
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
    <title>Connecter</title>
    <!-- --- bootstrap ---- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ---- fontawsome ---- -->
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<!-- --- header --- -->
<?php include './include/header.php' ?>

<div class="container py-3" style="height: 100vh;">
    <h2 class="text-center py-3">Connexion</h2>
    <?php if (!empty($message)) echo $message; ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="abc@gmail.com" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe" required>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary py-3">Se connecter</button>
            <a class="btn btn-dark" href="inscrire.php" role="button">S'inscrire</a>
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