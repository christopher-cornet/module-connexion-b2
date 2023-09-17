<?php

include "Database.php";

class User {

    private $pdo;

    function __construct() {
        $this->pdo = new Database();
    }

    // Verify if the username already exists in the Database
    public function verifyUsername($login) {

        $query = $this->pdo->db->prepare( "SELECT * FROM user WHERE login = ?" );
        $query->execute( [$login] );
        $usernameExists = $query->fetch();

        // If the username does not exist in the Database, return True
        if (empty($usernameExists)) {
            return true;
        }
        else {
            return false;
        }

    }

    /* Check if there are uppercase letters, lowercase letters, numbers,
    special characters and the password length should be minimum 8 characters */
    public function verifyPassword($password) {
        
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $numbers = preg_match('@[0-9]@', $password);
        $special_chars = preg_match('@[^\w]@', $password);
        
        // If the password passes the security test, return True
        if ($uppercase && $lowercase && $numbers && $special_chars && strlen($password) >= 8) {
            return true;
        }
        else {
            return false;
        }

    }

    // Register the User
    public function register($login, $firstname, $lastname, $password) {
        
        $verifyUsername = $this->verifyUsername($login);
        $verifyPassword = $this->verifyPassword($password);
        
        // If the password passes the security test
        if ($verifyPassword) {
            
            // If the username doesn't exists, add the User to the Database
            if ($verifyUsername) {

                $query = $this->pdo->db->prepare( "INSERT INTO user (login, firstname, lastname, password) VALUES (?,?,?,?)" );
                $query->execute( [$login, $firstname, $lastname, hash("sha256", $password)] );
                return true;

            }
            else {
                // If the Username already exists, don't register and return false
                echo "Ce nom d'utilisateur existe déjà dans la base de données.";
                return false;
            }
        }
        else {
            // If the Password is not safe enough display an Error Message and return false
            echo "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
            return false;
        }

    }

    // Log In the User
    public function login($login, $password) {

        /* Connect the user with a condition because in the subject it is requested to create the user adminN1337$
        with the phpmyadmin interface, so it is not hashed. So my code is not optimized but it respects the rules of the subject. */
        if ($login == "admiN1337$") {
            $query = $this->pdo->db->prepare( "SELECT * FROM user WHERE login = ? AND password = ?" );
            $query->execute( [$login, $password] );
            $user = $query->fetch();
        }
        else {
            // Authenticate the User based on the username and password
            $query = $this->pdo->db->prepare( "SELECT * FROM user WHERE login = ? AND password = ?" );
            $query->execute( [$login, hash("sha256", $password)] );
            $user = $query->fetch();
        }
        
        // If $user contains a value, define session values
        if ($user) {

            $_SESSION["login"] = $user["login"];
            $_SESSION["firstname"] = $user["firstname"];
            $_SESSION["lastname"] = $user["lastname"];
            
            return true;

        }
        
        // Else if $user is not true, (not connected, do not contains any value) : Reset session values
        $_SESSION["login"] = "";
        $_SESSION["firstname"] = "";
        $_SESSION["lastname"] = "";

        return false;

    }

    // Change and update the User's informations
    public function editProfile($username, $firstname, $lastname, $password) {

        // Hash the new password
        $hashedPassword = hash("sha256", $password);
            
        $query = $this->pdo->db->prepare( "UPDATE user SET login = ?, firstname = ?, lastname = ?, password = ? WHERE login = ?" );
        $query->execute( [$username, $firstname, $lastname, $hashedPassword, $_SESSION['login']] );

        // Check if the query affected any row
        if ($query->rowCount() > 0) {

            // Update the session values
            $_SESSION["login"] = $username;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;

            return true;
        }
        else {
            return false;
        }
    
    }

    // Delete the User's Account
    public function deleteAccount() {

        $query = $this->pdo->db->prepare( "UPDATE user SET login = ?, firstname = ?, lastname = ?, password = ? WHERE login = ?" );
        $query->execute( [$username, $firstname, $lastname, $hashedPassword, $_SESSION['login']] );

        if ($query->rowCount() > 0) {

            // Update the session values
            $_SESSION["login"] = $username;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;

            return true;
        }
        else {
            return false;
        }

    }

}

?>