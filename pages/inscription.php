<?php
session_start();

include "../classes/User.php";

error_reporting(0);

if ($_SESSION['user'] !== "") {
    $name = $_SESSION['user']; 
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/signup.css" type=text/css>
    <title>Inscription</title>
</head>
<body>
    <?php include "../includes/header.php"; ?>
    <main>
        <form action="signup.php" method="post">
            <input type="text" placeholder="Nom d'utilisateur*" name="username" required>
            <input type="text" placeholder="Email*" name="email" required>
            <input type="text" placeholder="Prenom*" name="firstname" required>
            <input type="text" placeholder="Nom*" name="lastname" required>
            <input type="password" placeholder="Mot de passe*" name="password" required>
            <input type="password" placeholder="Confirmation mot de passe*" name="confirmpassword" required>
            <input class="register" type="submit" name="submit" value="S'inscrire">
            <?php
            // Register the User
            if (isset($_POST['submit'])) {
                $emptyForm = empty($_POST['username']) && empty($_POST['email']) && empty($_POST['firstname']) && empty($_POST['lastname']) && empty($_POST['password']) && empty($_POST['confirmpassword']);

                // If the Form is not empty
                if (!$emptyForm) {

                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $password = $_POST['password'];
                    $confirmPassword = $_POST['confirmpassword'];

                    // Checks if the Password and the Confirm Password are the same
                    if ($password === $confirmPassword) {
                        $user = new User();
                        $user->register($username, $email, $firstname, $lastname, $password);
                        header("location: connexion.php");
                    }
                    else {
                        echo 'Le mot de passe et le mot de passe de confirmation doivent être identiques.';
                    }
                }
                else {
                    echo 'Informations manquantes. Veuillez remplir le formulaire.';
                }
            }
            ?>
        </form>
    </main>
</body>
</html>