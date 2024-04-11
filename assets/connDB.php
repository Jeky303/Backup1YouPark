<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "youpark";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
?>