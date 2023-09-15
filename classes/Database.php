<?php

class Database {

    public $db;
    private $localhost = "localhost";
    private $dbname = "moduleconnexionb2";
    private $username = "root";
    private $password = "";

    // Connect to the Database
    public function __construct() {
        try {
            $this->db = new PDO ("mysql:host=" . $this->localhost . "; dbname=" . $this->dbname . ";charset=utf8", $this->username , $this->password);
        }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}

?>