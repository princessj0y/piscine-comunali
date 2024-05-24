<?php
include 'db_conf.php';

$tessera = $_POST['idmembro'];
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$codfis = $_POST['codfis'];
$datanascita = $_POST['datanascita'];
$piscina = $_POST['piscina'];

$nomegenitore = $_POST['nomegenitore'];
$cognomegenitore = $_POST['cognomegenitore'];
$codfisgenitore = $_POST['codfisgenitore'];
$numerogenitore = $_POST['numerogenitore'];

$query = "UPDATE membro 
          SET nome='$nome',
              cognome='$cognome',
              codfis='$codfis',
              datanascita='$datanascita',
              piscina='$piscina'
          WHERE tessera='$tessera'";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

$query = "SELECT idgenitore
          FROM genitore
          WHERE minorenne='$tessera'";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

$genitore = pg_fetch_row($result)[0];
$hasGenitore = $genitore != null;
$hasNewGenitore = $nomegenitore != "" && $cognomegenitore != "";

// Aveva un responsabile ma viene tolto, cancellare tutto
if ($hasGenitore && !$hasNewGenitore) {
    $query = "DELETE FROM genitore where idgenitore='$genitore'";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore .<br/>";
        echo pg_last_error($conn);
        pg_close($conn);
        exit();
    }

    $genitore = 'null';
}
// Aveva un genitore e viene cambiato
else if ($hasGenitore && $hasNewGenitore) {
    $query = "UPDATE Genitore 
              SET nome='$nomegenitore',
                  cognome='$cognomegenitore',
                  codfis='$codfisgenitore',
                  contatto='$numerogenitore'
              where idgenitore='$genitore'";
    $result = pg_query($conn, $query);

    if (!$result) {
        echo "Si è verificato un errore .<br/>";
        echo pg_last_error($conn);
        pg_close($conn);
        exit();
    }
}
// Non aveva un genitore e continua a non averlo
else if (!$hasGenitore && !$hasNewGenitore) {
    $genitore = 'null';
}
// Non aveva un responsabile e adesso lo ha
else if (!$hasGenitore && $hasNewGenitore) {
    $query = "INSERT INTO genitore (nome,cognome,codfis,contatto,minorenne)
              VALUES ('$nomegenitore','$cognomegenitore','$codfisgenitore','$numerogenitore','$tessera')";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore .<br/>";
        echo pg_last_error($conn);
        pg_close($conn);
        exit();
    }
}

header("location: ./indexIscritti.php");

// Close the database connection
pg_close($conn);


?>