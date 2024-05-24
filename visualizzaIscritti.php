<table class="table able-dark table-striped mb-3">
    <thead>
        <tr>
            <th>Tessera</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Codice Fiscale</th>
            <th>Data di Nascita</th>
            <th>Iscrizione</th>
            <th>Genitori (se minorenne)</th>
            <th>Storico</th>
            <th>Certificati</th>
            <th>Modifica</th>

        </tr>
    </thead>
    <tbody>
        <?php
$query = "SELECT 
    m.*,
    m.nome as nomeiscritto,
    m.cognome as cognomeiscritto,
    m.codfis as codfisiscritto,
    g.*,
    concat(g.nome,' ',g.cognome) as infogenitore, 
    g.contatto as tellgenitore,
    p.nome as nomepiscina 
from membro m
left join piscina p on m.piscina=p.idpiscina
left join genitore g on m.tessera=g.minorenne";
$result = pg_query($conn, $query);
if (!$result) { // la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}


while ($row = pg_fetch_array($result)) {
    echo '<tr>
<td>' . $row['tessera'] . '</td>  
<td>' . $row['nomeiscritto'] . '</td>  
<td>' . $row['cognomeiscritto'] . '</td>
<td>' . $row['codfisiscritto'] . '</td>       
<td>' . $row['datanascita'] . '</td>
<td>' . $row['nomepiscina'] . '</td>
<td>' . $row['infogenitore'] . ' <br> ' . $row['tellgenitore'] . '</td>';
?>

        <td>
            <button type="button" class="btn btn-primary btn-sm"
                onclick="gotoStoricoIscritto(<?php echo $row['tessera']; ?>)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-clock-history" viewBox="0 0 16 16">
                    <path
                        d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                    <path
                        d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                </svg>
            </button>
        </td>

        <td>
            <button type="button" class="btn btn-primary btn-sm"
                onclick="gotoCertificatiIscritto('<?php echo $row['tessera']; ?>')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-prescription2" viewBox="0 0 16 16">
                    <path d="M7 6h2v2h2v2H9v2H7v-2H5V8h2V6Z" />
                    <path
                        d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v10.5a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 14.5V4a1 1 0 0 1-1-1V1Zm2 3v10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V4H4ZM3 3h10V1H3v2Z" />
                </svg>
            </button>
        </td>

        <td>
            <button type="button" class="btn btn-secondary btn-sm"
                onclick="editIscritto('<?php echo $row['tessera']; ?>')">
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
        </tr>
        <?php
}
?>
    </tbody>
</table>

<script>
function gotoStoricoIscritto(id) {
    const form = document.createElement('form');
    form.action = './indexStorico.php';
    form.method = 'POST';
    form.style = "display: hidden";

    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'iscrittoid';
    idInput.value = id;
    form.appendChild(idInput);

    document.body.appendChild(form);
    form.submit();
}

function gotoCertificatiIscritto(id) {
    const form = document.createElement('form');
    form.action = './indexCertificati.php';
    form.method = 'POST';
    form.style = "display: hidden";

    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'iscrittoid';
    idInput.value = id;
    form.appendChild(idInput);

    document.body.appendChild(form);
    form.submit();
}

function editIscritto(id) {
    const form = document.createElement('form');
    form.action = './addMembroPage.php';
    form.method = 'POST';
    form.style = "display: hidden";

    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'editiscrittoid';
    idInput.value = id;
    form.appendChild(idInput);

    document.body.appendChild(form);
    form.submit();
}
</script>