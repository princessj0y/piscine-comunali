<?php
include 'db_conf.php';

do {
    $tessera = rand(1000000000, 9999999999);
    $query = "SELECT tessera FROM membro where tessera='$tessera' ";
    $result = pg_query($conn, $query); /* genera numero tessera 10 digit*/
    if (!$result) {
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }
} while (pg_fetch_row($result)[0] == $tessera);

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$codfis = $_POST['codfis'];
$datanascita = $_POST['datanascita'];
$piscina = $_POST['piscina'];

$query = "INSERT INTO membro (tessera,nome,cognome,codfis,datanascita,piscina)
        VALUES ('$tessera','$nome','$cognome','$codfis','$datanascita','$piscina')";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

$nomegenitore = $_POST['nomegenitore'];
$cognomegenitore = $_POST['cognomegenitore'];
$codfisgenitore = $_POST['codfisgenitore'];
$numerogenitore = $_POST['numerogenitore'];
if ($nomegenitore != "" && $cognomegenitore != "") {
    $query = "INSERT INTO genitore (nome,cognome,codfis,contatto,minorenne)
        VALUES ('$nomegenitore','$cognomegenitore','$codfisgenitore','$numerogenitore','$tessera')";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }
}

header("location: ./indexIscritti.php");

// Close the database connection
pg_close($conn);


?>