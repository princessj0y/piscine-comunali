<?php
$query = "SELECT 
        c.*,
        (p.nome) as nomepiscina, 
        concat(pp.nome,' ',pp.cognome) as istruttore,
        v.tipologia as tipovasca,
        concat(t.nome, ' - ', t.livello) as tipocorso
from corso c 
    left join tipologiacorsonuoto t on c.tipocorso=t.tipocorsoid
    join piscina p on c.piscina=p.idpiscina
    join istruttore i on c.istruttoretitolare=i.idistruttore
    join personale pp on i.personaleid=pp.idpersona 
    join vasca v on v.idvasca=c.vasca";

$result = pg_query($conn, $query);

if (!$result) { //la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}


while ($row = pg_fetch_array($result)) {
    if ($row['comunale'] == 't')
        $comunale = 'Sì';
    else
        $comunale = 'No';

    echo '<tr>
    <td>' . $row['nomepiscina'] . '</td>   
<td>' . $row['tipocorso'] . '</td> 
<td>' . $comunale . '</td> 
<td>' . $row['edizione'] . '</td> 
<td>' . $row['vasca'] . ' - ' . $row['tipovasca'] . '</td>
<td>' . $row['corsia'] . '</td>
<td>' . $row['istruttore'] . '</td>
<td>' . $row['costo'] . '</td>
<td>' . $row['minpartecipanti'] . '-' . $row['maxpartecipanti'] . '</td>
<td>' . $row['orainizio'] . '</td>
<td>' . $row['durata'] . '</td>';
?>
<td>
    <button type="button" class="btn btn-secondary btn-sm" onclick="editCorso(<?php echo $row['idcorso']; ?>)">
        <svg xmlns="http://www.w3.org/2000/svg" width="16"
            height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
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
</tr>
<?php
}
?>
<script>
    function editCorso(id) {
        const form = document.createElement('form');
        form.action = './addCorsoPage.php';
        form.method = 'POST';
        form.style = "display: hidden";

        const corsoIdInput = document.createElement('input');
        corsoIdInput.type = 'hidden';
        corsoIdInput.name = 'editcorsoid';
        corsoIdInput.value = id;
        form.appendChild(corsoIdInput);

        document.body.appendChild(form);
        form.submit();
    }
</script>