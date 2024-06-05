<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['est_admin'] != '1') {
    header('Location: ../deconnecter.php');
    exit;
}

include '../include/conncet.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- --- bootstrap ---- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <!--  Datatables things -->
     <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <!-- ---- fontawsome ---- -->
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include './include/header.php'; ?>
    <div class="container my-4">
        <h2 class="text-center">Utilisateurs</h2>
        <div class="d-flex justify-content-end">
            <!-- <div class="col-auto">
                <a class="btn btn-dark" href="compte_add.php" role="button">Ajouter <i class="fa-solid fa-user-plus"></i></a>
            </div> -->
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM utilisateur ";
                $result  = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $nom = strtoupper($row['nom']);
                        $prenom = $row['prenom'];
                        $email = $row['email'];


                        echo "<tr>
                        <td>$prenom</td>
                        <td>$nom</td>
                        <td>$email</td>

                    </tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                </tr>
            </tfoot>
        </table>

    </div>
    <!-- --- js -- -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="./js/script.js"></script>
    <script>

    </script>
</body>