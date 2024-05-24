<table class="table able-dark table-striped">
    <thead>
        <tr>
            <th>Medico</th>
            <th>Giorno Visita</th>
            <th>Scadenza</th>
        </tr>
    </thead>
    <tbody>
<?php
$tessera = $_POST['iscrittoid'];
$query = "SELECT *
from certificatomedico
where idtessera='$tessera'";

$result = pg_query($conn, $query);

if (!$result) { //la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

while ($row = pg_fetch_array($result)) {
    echo '<tr>
<td>' . $row['medico'] . '</td> 
<td>' . $row['giornovisita'] . '</td> 
<td>' . $row['scadenza'] . '</td>';
?>
        </tr>
<?php
}
?>
    </tbody>
</table>