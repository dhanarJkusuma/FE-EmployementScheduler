<?php
if(!isset($_SESSION)){
  session_start();  
}


$BASE_URL = "http://localhost/ta";
$SSL = false;
$server = "localhost:3306"; //nama server
$username = "jabetto"; // username
$password = "password"; //  standarnya kosong
$database = "jabettos"; // buat nama database harus sama

// Koneksi dan memilih database di server
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//require "filter_auth.php";
require "filter_role.php";
?>
