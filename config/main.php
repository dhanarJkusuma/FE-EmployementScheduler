<?php
$server = "localhost:3306"; //nama server
$username = "penjadwalan"; // username
$password = "admindb"; //  standarnya kosong
$database = "penjadwalan"; // buat nama database harus sama

// Koneksi dan memilih database di server
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
