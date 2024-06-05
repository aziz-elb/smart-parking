<?php

$serverC = "localhost";
$userC = "root";
$passwd = "";
$database = "db_smartparking";


try {
$conn= mysqli_connect($serverC,$userC,$passwd,$database);

}
catch (Exception) {
    echo "Error de connexion a la base de donnes";
}



?>