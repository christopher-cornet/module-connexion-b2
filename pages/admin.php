<?php
session_start();

// error_reporting(0);

if ($_SESSION['login'] == 'admiN1337$') {
    $name = $_SESSION['login']; 
}
else {
    header("location: index.php");
}

include "../classes/User.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin</title>
</head>
<body>
    <?php include "../includes/header.php"; ?>
        <div class="flex justify-center overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 max-w-screen-xl">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">ID</th>
                        <th scope="col" class="px-6 py-3 text-center">Login</th>
                        <th scope="col" class="px-6 py-3 text-center">Firstname</th>
                        <th scope="col" class="px-6 py-3 text-center">Lastname</th>
                        <th scope="col" class="px-6 py-3 text-center">Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user = new User();
                    $res = $user->showDatabase();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>