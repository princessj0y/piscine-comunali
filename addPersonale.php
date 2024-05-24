<?php
include 'db_conf.php';

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$codfis = $_POST['codfis'];
$datanascita = $_POST['datanascita'];
$ruolo = $_POST['ruolo'];
$arrayTell = $_POST['numeri'];

$query = "INSERT INTO Personale (nome,cognome,codfis,datanascita) 
         VALUES ('$nome','$cognome','$codfis','$datanascita') 
         returning lastval()";
/*$result = pg_insert($conn, 'piscina', array('nome' => $nome, 'indirizzo' => "row('$via','$numerocivico')::Indirizzo", 'apertura' => $apertura, 'chiusura' => $chiusura, 'responsabile' => $responsabile));*/
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}

$idpersonale = pg_fetch_row($result)[0];
if ($ruolo == 1) {
    $query = "INSERT INTO Responsabile(personale) 
    VALUES ('$idpersonale')";
}
else {
    $query = "INSERT INTO Istruttore(personaleid) 
    VALUES ('$idpersonale')";
}

$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}

foreach ($arrayTell as $num) {
    if (!empty($num)) {
        $query = "INSERT INTO TelefonoPersonale (Telefono, Personale) VALUES ($num, $idpersonale)";
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