<?php
include 'db_conf.php';

$corso = $_POST['corso'];
$supplente = $_POST['supplente'];
$data = $_POST['data'];

$query = "INSERT 
          INTO Sostituzione(Corso, Data, IstruttoreSostituto) 
          VALUES('$corso','$data','$supplente')";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}
header("location: ./indexSupplenze.php");

// Close the database connection
pg_close($conn);

?>