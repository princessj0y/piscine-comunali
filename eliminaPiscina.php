<?php
include 'db_conf.php';
$array = $_POST['delete'];

foreach ($array as $delete) {


    $query = "SELECT reperibilita from piscina where idpiscina='$delete'";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }
    $reperibilita = pg_fetch_row($result)[0];

    $query = "DELETE FROM piscina WHERE idpiscina=$delete";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }



    $query = "DELETE FROM reperibilita WHERE idreperibilita='$reperibilita'";
    $result = pg_query($conn, $query);

    header("location: ./index.php");


}
exit;
?>