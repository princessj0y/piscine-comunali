<table class="table able-dark table-striped">
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Edizione</th>
            <th>Vasca</th>
            <th>Corsia</th>
            <th>Istruttore</th>
        </tr>
    </thead>
    <tbody>
<?php
$tessera = $_POST['iscrittoid'];
$query = "SELECT c.*,
    concat(pp.nome,' ',pp.cognome) as istruttore,
    v.tipologia as tipovasca,
    concat(t.nome, ' - ', t.livello) as tipocorso
from corso c
    join iscrizione ii on c.idcorso=ii.corso
    left join tipologiacorsonuoto t on c.tipocorso=t.tipocorsoid
    join istruttore i on c.istruttoretitolare=i.idistruttore
    join personale pp on i.personaleid=pp.idpersona 
    join vasca v on v.idvasca=c.vasca
where membro='$tessera'";

$result = pg_query($conn, $query);

if (!$result) { //la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

while ($row = pg_fetch_array($result)) {
    echo '<tr>
<td>' . $row['tipocorso'] . '</td> 
<td>' . $row['edizione'] . '</td> 
<td>' . $row['vasca'] . ' - ' . $row['tipovasca'] . '</td>
<td>' . $row['corsia'] . '</td>
<td>' . $row['istruttore'] . '</td>';
?>
        </tr>
<?php
}
?>
    </tbody>
</table>