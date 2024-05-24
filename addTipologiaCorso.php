<?php
include 'db_conf.php';
$nome = $_POST['nome'];
$livello = $_POST['livello'];
$tipovasca = $_POST['tipovasca'];

$query = "INSERT INTO Tipologiacorsonuoto(nome,livello,tipologia) 
        VALUES ('$nome','$livello','$tipovasca')";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}

header("location: ./indexCorsi.php");

// Close the database connection
pg_close($conn);

?>