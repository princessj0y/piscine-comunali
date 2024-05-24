<h3>Responsabile:</h3>
<table class="table able-dark table-striped mb-3">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Codice Fiscale</th>
            <th>Data di Nascita</th>
            <th>Telefono</th>
            <th>Modifica</th>
        </tr>
    </thead>
    <tbody>
        <?php
$piscina = $_POST['piscina'];
$anno = $_POST['anno'];

$query = "SELECT p.*, r.* from personale p
    join responsabile r on p.idpersona=r.personale
    join reperibilita on r.idresponsabile=responsabile
    join piscina on reperibilita=idreperibilita
where idpiscina='$piscina'";

$result = pg_query($conn, $query);

if (!$result) { // la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

/*Inizio ricerca DI TUTTE LE PISCINE*/
while ($row = pg_fetch_array($result)) {
    $personale = $row['idpersona'];

    echo '<tr>
<td>' . $row['nome'] . '</td>  
<td>' . $row['cognome'] . '</td>
<td>' . $row['codfis'] . '</td>       
<td>' . $row['datanascita'] . '</td>';

    echo '<td>';
    $query = "SELECT telefono from telefonopersonale where personale='$personale'";
    $result = pg_query($conn, $query);
    while ($n = pg_fetch_array($result)) {
        echo $n['telefono'] . '<br>';
    }
    echo '</td>';

?>
        <td>
            <button type="button" class="btn btn-secondary btn-sm" onclick="editPersonale(<?php echo $personale; ?>)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-info-square" viewBox="0 0 16 16">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </svg>
            </button>
        </td>
        <tr>
            <?php
}
?>
    </tbody>
</table>

<h3>Istruttori:</h3>
<table class="table able-dark table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Codice Fiscale</th>
            <th>Data di Nascita</th>
            <th>Telefono</th>
            <th>Contratto</th>
            <th>Numero Ferie</th>
            <th>Qualifiche</th>
            <th>Modifica</th>
        </tr>
    </thead>
    <tbody>
        <?php
$piscina = $_POST['piscina'];
$anno = $_POST['anno'];

$query = "SELECT * from personale 
    join istruttore on idpersona=PersonaleID 
    join contratto on idistruttore=istruttore
where 
    (EXTRACT(year FROM inizio)='$anno' 
        or (fine is null and EXTRACT(year FROM inizio)<='$anno'))
    and piscina='$piscina'";

$result = pg_query($conn, $query);

if (!$result) { // la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

/*Inizio ricerca DI TUTTE LE PISCINE*/
while ($row = pg_fetch_array($result)) {
    /*select concat(nome,' ',cognome) as personale from personale left join responsabile on idpersona=personale where idresponsabile='2'*/
    $istruttore = $row['idistruttore'];
    $personale = $row['personaleid'];

    $contratto = "Stagionale";
    if ($row['fine'] == null) {
        $contratto = "Indeterminato";
    }

    echo '<tr>
<td>' . $row['nome'] . '</td>  
<td>' . $row['cognome'] . '</td>
<td>' . $row['codfis'] . '</td>
<td>' . $row['datanascita'] . '</td>';

    echo '<td>';
    $query = "SELECT telefono from telefonopersonale where personale='$personale'";
    $innerResult = pg_query($conn, $query);
    if (!$innerResult) { // la query ha generato errori
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }

    while ($n = pg_fetch_array($innerResult)) {
        echo $n['telefono'] . '<br>';
    }
    echo '</td>';

    echo '<td>' . $contratto . '</td>    
<td>' . $row['nferie'] . '</td>';

    echo '<td>';
    $query = "SELECT * from qualifiche where istruttore='$istruttore'";
    $innerResult = pg_query($conn, $query);
    if (!$innerResult) { // la query ha generato errori
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }
    while ($n = pg_fetch_array($innerResult)) {
        echo $n['tipo'] . '<br>';
    }
    echo '</td>';
?>
        <td>
            <button type="button" class="btn btn-secondary btn-sm" onclick="editPersonale(<?php echo $personale; ?>)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-plus" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                </svg>
            </button>
            <!--
            <button type="button" class="btn btn-secondary btn-sm"
                onclick="editContratto(<?php echo $row['idcontratto']; ?>)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                    <path
                        d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                    <path
                        d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                </svg>
            </button>
            -->
        </td>
        <tr>
            <?php
}
?>
    </tbody>
</table>

<script>
function editContratto(id) {
    const form = document.createElement('form');
    form.action = './addContrattoPage.php';
    form.method = 'POST';
    form.style = "display: hidden";

    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'editcontrattoid';
    idInput.value = id;
    form.appendChild(idInput);

    document.body.appendChild(form);
    form.submit();
}

function editPersonale(id) {
    const form = document.createElement('form');
    form.action = './addPersonalePage.php';
    form.method = 'POST';
    form.style = "display: hidden";

    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'editpersonaleid';
    idInput.value = id;
    form.appendChild(idInput);

    document.body.appendChild(form);
    form.submit();
}
</script>