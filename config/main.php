<?php
$server = "localhost"; //nama server
$username = "root"; // username
$password = ""; //  standarnya kosong
$database = "jabetto-schedule"; // buat nama database harus sama

// Koneksi dan memilih database di server
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	
?>
