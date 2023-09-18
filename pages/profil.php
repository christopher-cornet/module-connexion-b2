<?php
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
    <link rel="stylesheet" href="../css/profile.css">
    <title>Profil</title>
</head>
<body>
    <?php include "../includes/header.php"; ?>
    <main>
        <div class="account">
            <h1 class="text-lime-600">Informations du compte</h1>
            <h3 class="text-lime-600 font-bold"><?php if ($_SESSION['login']) {echo $_SESSION['login'];} else {echo "Anonyme";}?></h3>
        </div>
        <div class="flex min-h-full flex-col justify-center px-12 py-13 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=lime&shade=600" alt="Tailwind">
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6 bg-gray-800" action="" method="POST">
                    <div>
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-100">Nom d'utilisateur</label>
                        <div class="mt-2">
                            <input id="username" name="username" type="text" value="<?php if ($_SESSION['login']) {echo $_SESSION['login'];} else {echo "Nom d'utilisateur";}?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="firstname" class="block text-sm font-medium leading-6 text-gray-100">Prénom</label>
                        <div class="mt-2">
                            <input id="firstname" name="firstname" type="text" value="<?php if ($_SESSION['firstname']) {echo $_SESSION['firstname'];} else {echo "Prénom";}?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="lastname" class="block text-sm font-medium leading-6 text-gray-100">Nom</label>
                        <div class="mt-2">
                            <input id="lastname" name="lastname" type="text" value="<?php if ($_SESSION['lastname']) {echo $_SESSION['lastname'];} else {echo "Nom";}?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-100">Mot de passe*</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <button type="submit" name="modify" class="flex w-full justify-center rounded-md bg-lime-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-600">Modifier</button>
                    </div>

                    <div>
                        <button type="submit" name="delete" class="flex w-full justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-600">Supprimer le compte</button>
                    </div>

                    <?php
                    // Change User's Informations
                    if (isset($_POST['modify'])) {

                        $username = $_POST['username'];
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $password = $_POST['password'];

                        $user = new User();
                        $modifyProfile = $user->editProfile($username, $firstname, $lastname, $password);

                        if ($modifyProfile) {
                            echo "<p class='text-gray-100 font-bold'>Les informations ont bien été modifiées.</p>";
                        }
                        else {
                            echo "<p class='text-gray-100 font-bold'>Les informations n'ont pas pu être modifiées.</p>";
                        }

                    }

                    // Delete User's Account
                    if (isset($_POST['delete'])) {

                        $user = new User();
                        $deleteAccount = $user->deleteAccount($_SESSION['login']);

                        if ($modifyProfile) {
                            echo "<p class='text-gray-100 font-bold'>Le compte a été supprimé.</p>";
                        }
                        else {
                            echo "<p class='text-gray-100 font-bold'>Le compte n'a pas pu être supprimé.</p>";
                        }

                    }
                    ?>
                </form>
            </div>
        </div>
    </main>
</body>
</html>