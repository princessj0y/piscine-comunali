<?php
$host = "localhost";
$port = "5432";
$dbname = "piscine";
$username = "";
$password = "";
$connectionString = "host=" . $host . " port=" . $port . " dbname=" . $dbname . " user=" . $username . " password=" . $password;
$conn = pg_connect($connectionString);
if (!$conn) { //connessione fallita
    echo 'Connessione al database fallita.';
    exit();
}

?>