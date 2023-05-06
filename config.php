<?php
$servername = "localhost";
$username = "sulisweblap02";
$password = "K2ge0OedVvaku*lF";
$dbname = "sulisweblap02";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>