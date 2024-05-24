<?php
include 'db_conf.php';
$istruttore = $_POST['istruttore'];
$piscina = $_POST['piscina'];
$tipocontratto = $_POST['tipocontratto'];
$inizio = $_POST['inizio'];
$fine = $_POST['fine'];
$nferie = $_POST['nferie'];

if ($tipocontratto == 1) {
    $query = "INSERT INTO Contratto(istruttore,piscina,inizio,fine,nferie) 
             VALUES ('$istruttore','$piscina','$inizio',NULL,'$nferie')";
}
else {
    $query = "INSERT INTO Contratto(istruttore,piscina,inizio,fine) 
            VALUES ('$istruttore','$piscina','$inizio','$fine')";
}

$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}

header("location: ./indexPersonale.php");

// Close the database connection
pg_close($conn);


?>