<?php
include 'db_conf.php';

$id = $_POST['idpiscina'];
$nome = $_POST['nome'];
$via = $_POST['via'];
$numerocivico = $_POST['nCiv'];
$apertura = $_POST['aperturaDate'];
$chiusura = $_POST['chiusuraDate'];
$responsabile = $_POST['responsabile'];
$arrayTell = $_POST['numeri'];

$giorniArr = $_POST['giorni'];
$inizioArr = $_POST['inizio'];
$fineArr = $_POST['fine'];

// Aggiorna la piscina
$query = "UPDATE Piscina 
          SET Nome = '$nome', 
              Indirizzo = row ('$via','$numerocivico')::Indirizzo,
              Apertura = '$apertura',
              Chiusura = '$chiusura'
          WHERE idpiscina='$id'";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}

// Prendi l'id della reperibilità
$query = "SELECT Reperibilita from piscina where idpiscina='$id'";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}
$reperibilita = pg_fetch_row($result)[0];
$hasReperibilita = $reperibilita != null;

// Aveva un responsabile ma viene tolto, cancellare tutto
if ($hasReperibilita && $responsabile == 'NULL') {
    $query = "UPDATE Piscina 
              SET reperibilita = null
              WHERE idpiscina='$id'";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore .<br/>";
        echo pg_last_error($conn);
        pg_close($conn);
        exit();
    }

    $query = "DELETE FROM GiornoReperibilita where idreperibilita='$reperibilita'";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore .<br/>";
        echo pg_last_error($conn);
        pg_close($conn);
        exit();
    }

    $query = "DELETE FROM Reperibilita where idreperibilita='$reperibilita'";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore .<br/>";
        echo pg_last_error($conn);
        pg_close($conn);
        exit();
    }

    $reperibilita = 'null';
}
// Aveva un responsabile e viene cambiato
else if ($hasReperibilita && $responsabile != 'NULL') {
    $query = "UPDATE Reperibilita 
              SET Responsabile='$responsabile' 
              where idreperibilita='$reperibilita'";
    $result = pg_query($conn, $query);

    if (!$result) {
        echo "Si è verificato un errore .<br/>";
        echo pg_last_error($conn);
        pg_close($conn);
        exit();
    }
}
// Non aveva un responsabile e continua a non averlo
else if (!$hasReperibilita && $responsabile == 'NULL') {
    $reperibilita = 'null';
}
// Non aveva un responsabile e adesso lo ha
else if (!$hasReperibilita && $responsabile != 'NULL') {
    $query = "INSERT INTO Reperibilita (Responsabile)  VALUES ('$responsabile') returning lastval()";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore .<br/>";
        echo pg_last_error($conn);
        pg_close($conn);
        exit();
    }
    $reperibilita = pg_fetch_row($result)[0];

    $query = "UPDATE Piscina 
              SET reperibilita = '$reperibilita'
              WHERE idpiscina='$id'";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore .<br/>";
        echo pg_last_error($conn);
        pg_close($conn);
        exit();
    }
}

if ($reperibilita != 'null') {
    // Elimina eventuali giorni che erano presenti ma non ci sono più
    $query = "SELECT giorno from giornoreperibilita where idreperibilita='$reperibilita'";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore .<br/>";
        echo pg_last_error($conn);
        pg_close($conn);
        exit();
    }

    while ($row = pg_fetch_array($result)) {
        $numGiorno = array_search($row['giorno'], array(
            'Lunedi', 'Martedi', 'Mercoledi',
            'Giovedi', 'Venerdi', 'Sabato', 'Domenica'));

        if (!array_search($numGiorno, $giorniArr)) {
            $query = "DELETE FROM giornoreperibilita
                      WHERE idreperibilita='$reperibilita' AND giorno='" . $row['giorno'] . "'";
            $innerResult = pg_query($conn, $query);
            if (!$innerResult) {
                echo "Si è verificato un errore .<br/>";
                echo pg_last_error($conn);
                pg_close($conn);
                exit();
            }
        }
    }

    // Aggiorna giorni già presenti e inseriscine di nuovi
    for ($i = 0; $i < count($giorniArr); $i++) {
        if (!empty($inizioArr[$i])) {
            $giorno = array(
                'Lunedi', 'Martedi', 'Mercoledi',
                'Giovedi', 'Venerdi', 'Sabato', 'Domenica')[$giorniArr[$i]];
            $inizio = $inizioArr[$i];
            $fine = $fineArr[$i];

            // Prova a fare un inserimento, se esiste già viene violato il vincolo di unicità
            // (ovvero ON CONFLICT) e allora esegue un update
            $query = "INSERT INTO giornoreperibilita(idreperibilita, giorno, orainizio, orafine)
                      VALUES ('$reperibilita', '$giorno', '$inizio', '$fine')
                      ON CONFLICT (idreperibilita, giorno) DO
                      UPDATE SET orainizio = '$inizio', orafine = '$fine'";
            $result = pg_query($conn, $query);
            if (!$result) {
                echo "Si è verificato un errore .<br/>";
                echo pg_last_error($conn);
                pg_close($conn);
                exit();
            }
        }
    }
}

// Elimina eventuali numeri di telefono che erano presenti ma non ci sono più
$query = "SELECT telefono from telefono where piscina='$id'";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}

while ($row = pg_fetch_array($result)) {
    if (!array_search($row['telefono'], $arrayTell)) {
        $query = "DELETE FROM telefono
                  WHERE piscina='$id' AND telefono='" . $row['telefono'] . "'";
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
        $query = "INSERT INTO Telefono (Telefono, Piscina) 
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

header("location: ./index.php");

// Close the database connection
pg_close($conn);
?>