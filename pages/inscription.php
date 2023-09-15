<?php
ob_start();

session_start();

include "../classes/User.php";

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

<div class="flex min-h-full flex-col justify-center px-12 py-13 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Tailwind">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Inscrivez vous</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="" method="POST">
            <div>
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Nom d'utilisateur*</label>
                <div class="mt-2">
                    <input id="username" name="username" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">Prénom*</label>
                <div class="mt-2">
                    <input id="firstname" name="firstname" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="lastname" class="block text-sm font-medium leading-6 text-gray-900">Nom*</label>
                <div class="mt-2">
                    <input id="lastname" name="lastname" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe*</label>
                </div>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="confirmpassword" class="block text-sm font-medium leading-6 text-gray-900">Confirmation*</label>
                <div class="mt-2">
                    <input id="confirmpassword" name="confirmpassword" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <button type="submit" name="signup" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">S'inscrire</button>
            </div>

            <?php
            // Register the User
            if (isset($_POST['signup'])) {
                $emptyForm = empty($_POST['username']) && empty($_POST['firstname']) && empty($_POST['lastname']) && empty($_POST['password']) && empty($_POST['confirmpassword']);

                // If the Form is not empty
                if (!$emptyForm) {

                    $username = $_POST['username'];
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $password = $_POST['password'];
                    $confirmPassword = $_POST['confirmpassword'];

                    // Checks if the Password and the Confirm Password are identical
                    if ($password === $confirmPassword) {
                        $user = new User();
                        // $verifyUsername = $user->verifyUsername($login);
                        // $verifyPassword = $user->verifyPassword($password);
                        $register = $user->register($username, $firstname, $lastname, $password);
                        if ($register) {
                            header("location: connexion.php");

                        }
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
    </div>
</div>
</body>
</html>
<?php
ob_end_flush();
?>