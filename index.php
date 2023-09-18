<?php
session_start();

error_reporting(0);

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
        
    <h1>Bienvenue <?php if ($_SESSION['login']) {echo $_SESSION['login'];} else {echo "utilisateur Anonyme";}?> !</h1>
</body>
</html>