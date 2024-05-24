<?php
include 'db_conf.php';

$id = $_POST['idcorso'];
$piscina = $_POST['piscina'];
$vasca = $_POST['vasca'];
$edizione = $_POST['edizione'];
$istruttore = $_POST['istruttore'];
$corsia = $_POST['corsia'];
$min = $_POST['min'];
$max = $_POST['max'];
$costo = $_POST['costo'];
$inizio = $_POST['inizio'];
$durata = $_POST['durata'];
$tipocorso = $_POST['tipocorso'];
$comunale = $_POST['comunale'];

$query = "UPDATE corso 
          SET comunale='$comunale',
              tipocorso='$tipocorso',
              edizione='$edizione',
              piscina='$piscina',
              vasca='$vasca',
              corsia='$corsia',
              istruttoretitolare='$istruttore',
              costo='$costo',
              minpartecipanti='$min',
              maxpartecipanti='$max',
              orainizio='$inizio',
              durata='$durata minutes'
          WHERE idcorso='$id'";
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