<?php
session_start();

error_reporting(0);

if (!empty($_SESSION['username'])) {
    $name = $_SESSION['username']; 
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Accueil</title>
</head>
<body>
    <?php include "includes/home-header.php"; ?>
        
    <!-- <h2><?php if ($_SESSION['username'] == true) {echo $name;} else {echo "Anonyme";} ?></h2> -->
    <h1>Bienvenue <?php if ($_SESSION['username'] == false) {echo "utilisateur Anonyme"; } else {echo $name;}?> !</h1>
</body>
</html>