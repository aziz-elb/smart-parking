<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['est_admin'] != '1') {
    header('Location: ../deconnecter.php');
    exit;
}



include '../include/conncet.php';// Assurez-vous que le nom du fichier est correct

$alert_message = '';
$id_utilisateur = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ancien_mot_de_passe = $_POST['ancien_mot_de_passe'];
    $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];
    $confirmation_mot_de_passe = $_POST['confirmation_mot_de_passe'];

    // Récupération du mot de passe actuel dans la base de données
    $sql_select = "SELECT `password` FROM utilisateur WHERE user_id = $id_utilisateur";
    $result = $conn->query($sql_select);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $mot_de_passe_actuel = $row['password'];

        if (password_verify($ancien_mot_de_passe, $mot_de_passe_actuel)) {
            if ($nouveau_mot_de_passe !== $ancien_mot_de_passe) {
                if ($nouveau_mot_de_passe === $confirmation_mot_de_passe) {
                    if (strlen($nouveau_mot_de_passe) >= 8 && preg_match('/[A-Za-z]/', $nouveau_mot_de_passe) && preg_match('/\d/', $nouveau_mot_de_passe)) {
                        $hash_password = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);
                        $sql_update = "UPDATE utilisateur SET password = '$hash_password' WHERE user_id = $id_utilisateur";

                        if ($conn->query($sql_update)) {
                            $alert_message = "<div class='alert alert-success' role='alert'>Mot de passe mis à jour avec succès.</div>";
                        } else {
                            $alert_message = "<div class='alert alert-danger' role='alert'>Erreur lors de la mise à jour du mot de passe: " . $conn->error . "</div>";
                        }
                    } else {
                        $alert_message = "<div class='alert alert-warning' role='alert'>Le nouveau mot de passe doit comporter au moins 8 caractères et inclure à la fois des lettres et des chiffres.</div>";
                    }
                } else {
                    $alert_message = "<div class='alert alert-warning' role='alert'>Les nouveaux mots de passe ne correspondent pas.</div>";
                }
            } else {
                $alert_message = "<div class='alert alert-warning' role='alert'>Le nouveau mot de passe doit être différent de l'ancien mot de passe.</div>";
            }
        } else {
            $alert_message = "<div class='alert alert-warning' role='alert'>L'ancien mot de passe est incorrect.</div>";
        }
    } else {
        $alert_message = "<div class='alert alert-danger' role='alert'>Erreur lors de la récupération des informations de l'utilisateur.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php include './include/header.php'; ?>

<div class="container w-75 py-5 mb-5">
    <h2 class="py-4 text-center">Modifier mot de passe</h2>
    <?php echo $alert_message; ?>
    <form method="post">
        <div class="mb-3">
            <label for="ancien_mot_de_passe" class="form-label">Ancien Mot de passe</label>
            <input type="password" class="form-control" id="ancien_mot_de_passe" name="ancien_mot_de_passe" placeholder="Entrez votre ancien mot de passe" required>
        </div>
        <div class="mb-3">
            <label for="nouveau_mot_de_passe" class="form-label">Nouveau Mot de passe</label>
            <input type="password" class="form-control" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe" placeholder="Entrez votre nouveau mot de passe" required>
        </div>
        <div class="mb-3">
            <label for="confirmation_mot_de_passe" class="form-label">Confirmer le Nouveau Mot de passe</label>
            <input type="password" class="form-control" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe" placeholder="Confirmez votre nouveau mot de passe" required>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary py-3">Modifier</button>
            <a class="btn btn-dark" href="./dashbord.php">Retour</a>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="../js/all.min.js"></script>
<script src="./js/script.js"></script>
</body>

</html>
