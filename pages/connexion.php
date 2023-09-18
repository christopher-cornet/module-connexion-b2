<?php
ob_start();

session_start();

error_reporting(0);

include "../classes/User.php";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/login.css">
    <title>Connexion</title>
</head>
<body>
<?php include "../includes/header.php"; ?>

<div class="flex min-h-full flex-col justify-center px-12 py-13 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=lime&shade=500" alt="Tailwind">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Connectez vous à votre compte</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="" method="POST">
            <div>
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Nom d'utilisateur</label>
                <div class="mt-2">
                <input id="username" name="username" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>
                <div class="text-sm">
                    <a href="#" class="font-semibold text-lime-600 hover:text-lime-500">Mot de passe oublié ?</a>
                </div>
                </div>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <button type="submit" name="login" class="flex w-full justify-center rounded-md bg-lime-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-600">Se connecter</button>
            </div>

            <?php
            // Log In
            if (isset($_POST['login'])) {
                $emptyForm = empty($_POST['username']) && empty($_POST['password']);

                // If the Form is not empty
                if (!$emptyForm) {

                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $user = new User();
                    $login = $user->login($username, $password);

                    if (!$login) {
                        echo "Nom d'utilisateur ou mot de passe incorrect.";
                    }
                    else {
                        header("location: ../index.php");
                    }

                }
                else {
                    echo 'Informations manquantes. Veuillez remplir le formulaire.';
                }
            }
            ?>
        </form>
    </div>
</div>
</body>
</html>
<?php  
ob_end_flush();  
?>