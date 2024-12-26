<?php
session_start();
include_once('../constant.php');
if (isset($_SESSION["lang"])) {
    include BASE_URL . "lang/" . $_SESSION["lang"] . '.php';
} else {
    $_SESSION["lang"] = 'en';
    include BASE_URL . "lang/en.php";
}
class connectClass
{
    private $host = 'localhost';
    private $db_name = 'driver_trip';
    private $username = 'root';
    private $password = '';
    private $port = '3306';
    public $conn;

    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
