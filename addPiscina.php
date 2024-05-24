<?php
include 'db_conf.php';
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

if ($responsabile == 'NULL') {
    $reperibilita = 'null';
}
else {
    $query = "INSERT INTO Reperibilita (Responsabile)  VALUES ('$responsabile') returning lastval()";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore .<br/>";
        echo pg_last_error($conn);
        pg_close($conn);
        exit();
    }
    $reperibilita = pg_fetch_row($result)[0];

    for ($i = 0; $i < count($giorniArr); $i++) {
        if (!empty($inizioArr[$i])) {
            $giorno = array(
                'Lunedi', 'Martedi', 'Mercoledi',
                'Giovedi', 'Venerdi', 'Sabato', 'Domenica')[$giorniArr[$i]];
            $inizio = $inizioArr[$i];
            $fine = $fineArr[$i];

            $query = "INSERT INTO giornoreperibilita(idreperibilita,giorno,orainizio,orafine)
                VALUES ('$reperibilita', '$giorno', '$inizio', '$fine')";
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

$query = "INSERT INTO Piscina (Nome,Indirizzo,Apertura,Chiusura,Reperibilita) 
 VALUES ('$nome', row ('$via','$numerocivico')::Indirizzo,'$apertura','$chiusura', $reperibilita)";
/*$result = pg_insert($conn, 'piscina', array('nome' => $nome, 'indirizzo' => "row('$via','$numerocivico')::Indirizzo", 'apertura' => $apertura, 'chiusura' => $chiusura, 'responsabile' => $responsabile));*/
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}

//$cmdtuples = pg_affected_rows($result);
$query = "SELECT idpiscina from piscina WHERE nome='$nome'";
$result = pg_query($conn, $query);
while ($row = pg_fetch_array($result)) {
    $id = $row['idpiscina'];
    foreach ($arrayTell as $num) {
        if (!empty($num)) {
            $query = "INSERT INTO Telefono (Telefono,Piscina) VALUES ($num,$id)";
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
header("location: ./index.php");

// Close the database connection
pg_close($conn);
?>