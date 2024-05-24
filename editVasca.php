<?php
include 'db_conf.php';

$id = $_POST['idvasca'];
$piscina = $_POST['piscina'];
$ncorsie = $_POST['ncorsie'];
$tipologia = $_POST['tipologia'];
$apertura = $_POST['aperturaDate'];
$chiusura = $_POST['chiusuraDate'];

$query = "UPDATE Vasca 
          SET Corsie = '$ncorsie',
              Tipologia = '$tipologia',
              Piscina = '$piscina',
              Apertura = '$apertura',
              Chiusura = '$chiusura'  
          WHERE idvasca='$id'";
$result = pg_query($conn, $query);
if (!$result) {
    echo "Si è verificato un errore .<br/>";
    echo pg_last_error($conn);
    pg_close($conn);
    exit();
}

header("location: ./indexVasche.php");

// Close the database connection
pg_close($conn);
?>