<?php
$query = "SELECT v.*, p.nome as nomePiscina 
from vasca v left join piscina p on piscina=idpiscina
order by idpiscina";

$result = pg_query($conn, $query);

if (!$result) { //la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

/*Inizio ricerca DI TUTTE LE PISCINE*/
while ($row = pg_fetch_array($result)) {
    /*select concat(nome,' ',cognome) as personale from personale left join responsabile on idpersona=personale where idresponsabile='2'*/
    echo '<tr>
<td>' . $row['nomepiscina'] . '</td>  
<td>' . $row['idvasca'] . '</td>
<td>' . $row['corsie'] . '</td>       
<td>' . $row['tipologia'] . '</td>   
</td><td>' . $row['apertura'] . '</td>    
<td>' . $row['chiusura'] . '</td>';
?>

    <td> 
        <button type="submit" class="btn btn-secondary btn-sm" onclick="editVasca(<?php echo $row['idvasca']; ?>)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
            </svg>
        </button>
    </td>
<tr>
<?php
}
?>

<script>
    function editVasca(id) {
        const form = document.createElement('form');
        form.action = './addVascaPage.php';
        form.method = 'POST';
        form.style = "display: hidden";

        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'editvascaid';
        idInput.value = id;
        form.appendChild(idInput);

        document.body.appendChild(form);
        form.submit();
    }
</script>
