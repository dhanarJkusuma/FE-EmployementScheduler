<?php
$BASE_URL = "http://localhost/ta";
$SSL = false;
$server = "localhost:3306"; //nama server
$username = "root"; // username
$password = ""; //  standarnya kosong
$database = "jabetto-scheduler"; // buat nama database harus sama

// Koneksi dan memilih database di server
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//require "filter_auth.php";
require "filter_role.php";
?>
