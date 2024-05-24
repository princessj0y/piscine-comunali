<?php
include 'db_conf.php';

$piscina = $_POST['piscina'];
$ncorsie = $_POST['ncorsie'];
$tipologia = $_POST['tipologia'];
$apertura = $_POST['aperturaDate'];
$chiusura = $_POST['chiusuraDate'];

$query = "INSERT INTO Vasca (Corsie,Tipologia,Piscina,Apertura,Chiusura)  
          VALUES ('$ncorsie','$tipologia','$piscina','$apertura','$chiusura')";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}

header("location: ./indexVasche.php");

// Close the database connection
pg_close($conn);
?>