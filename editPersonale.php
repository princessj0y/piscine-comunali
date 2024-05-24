<?php
include 'db_conf.php';

$id = $_POST['idpersonale'];
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$codfis = $_POST['codfis'];
$datanascita = $_POST['datanascita'];
$ruolo = $_POST['ruolo'];
$arrayTell = $_POST['numeri'];

$query = "UPDATE Personale 
          SET nome='$nome',
              cognome='$cognome',
              codfis='$codfis',
              datanascita='$datanascita' 
          WHERE idpersona='$id'";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}

// Elimina eventuali numeri di telefono che erano presenti ma non ci sono più
$query = "SELECT telefono from TelefonoPersonale where Personale='$id'";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}

while ($row = pg_fetch_array($result)) {
    if (!array_search($row['telefono'], $arrayTell)) {
        $query = "DELETE FROM TelefonoPersonale
                  WHERE Personale='$id' AND telefono='" . $row['telefono'] . "'";
        $innerResult = pg_query($conn, $query);
        if (!$innerResult) {
            echo "Si è verificato un errore .<br/>";
            echo pg_last_error($conn);
            pg_close($conn);
            exit();
        }
    }
}

// Inserisci numeri di telefono nuovi
foreach ($arrayTell as $num) {
    if (!empty($num)) {
        // Prova a fare un inserimento, ignorando se c'è già
        $query = "INSERT INTO TelefonoPersonale (Telefono, Personale) 
                  VALUES ($num, $id)
                  ON CONFLICT DO NOTHING";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Si è verificato un errore .<br/>";
            echo pg_last_error($conn);
            pg_close($conn);
            exit();
        }
    }
}

header("location: ./indexPersonale.php");

// Close the database connection
pg_close($conn);
?>