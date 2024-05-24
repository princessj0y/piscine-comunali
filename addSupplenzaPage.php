<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./lib/bootstrap@5.3.0.min.css" rel="stylesheet">
    <title>Inserisci supplenza</title>
</head>

<body>
    <form method="post" action="addSupplenza.php">
        <div class="container m-5 d-flex justify-content-center">
            <div class="card w-50">
                <div class="card-header">
                    <h5 class="card-title">Inserisci supplenza</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <label class="form-label">Seleziona il corso:</label>
                        <div class="col">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Corso</label>
                                <select class="form-select" id="corso" name="corso" onchange="setCorso()"
                                    required>
                                    <option value="">Seleziona</option>
                                    <?php
include 'db_conf.php';

if (isset($_POST['corso']))
    $corso = $_POST['corso'];
else
    $corso = '';

$query = "SELECT c.*,
    			 v.tipologia as tipovasca,
    			 concat(t.nome, ' - ', t.livello) as tipocorso
			from corso c
				left join tipologiacorsonuoto t on c.tipocorso=t.tipocorsoid
				join vasca v on v.idvasca=c.vasca";
$result = pg_query($conn, $query);
if (!$result) { // la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

while ($row = pg_fetch_array($result)) {
    if ($corso == $row['idcorso']) {
        echo '<option value="' . $row['idcorso'] . '" selected>' . $row['tipocorso'] . ', vasca ' . $row['tipovasca'] . ", corsia " . $row['corsia'] . ", edizione " . $row['edizione'] . ' </option>';
    }
    else {
        echo '<option value="' . $row['idcorso'] . '">' . $row['tipocorso'] . ', vasca ' . $row['tipovasca'] . ", corsia " . $row['corsia'] . ", edizione " . $row['edizione'] . ' </option>';
    }
}
?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label class="form-label">Seleziona il supplente:</label>
                        <div class="input-group col">
                            <label class="input-group-text" for="inputGroupSelect01">Istruttore</label>
                            <select class="form-select" id="supplente" name="supplente" required>
                                <option value="">Seleziona</option>
                                <?php
$query = "SELECT distinct i.idistruttore, p.nome, p.cognome 
          FROM personale p
                join istruttore i on p.idpersona = i.personaleid
                join contratto c on c.istruttore = i.idistruttore
          where c.piscina IN (
            SELECT c0.piscina FROM corso c0 where c0.idcorso='$corso'
          )";
$result = pg_query($conn, $query);
while ($row = pg_fetch_array($result)) {
    echo '<option value="' . $row['idistruttore'] . '">' . $row['nome'] . ' ' . $row['cognome'] . ' </option>';
}
?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label class="form-label">Seleziona la data:</label>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Data</label>
                                <input type="date" class="form-control" id="data" name="data" required>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <button class="btn btn-secondary" type="button" onclick="goToIndex()">Annulla</button>
                        <button class="btn btn-primary" type="submit">Inserisci</button>
                    </div>
                </div>

            </div>
    </form>
</body>
<script>
const corsoInput = document.getElementById('corso');

function setCorso() {
    const form = document.createElement('form');
    form.action = './addSupplenzaPage.php';
    form.method = 'POST';
    form.style = "display: hidden";

    const corsoNewInput = document.createElement('input');
    corsoNewInput.type = 'hidden';
    corsoNewInput.name = 'corso';
    corsoNewInput.value = corsoInput.value;
    form.appendChild(corsoNewInput);

    document.body.appendChild(form);
    form.submit();
}

function goToIndex() {
    window.location.href = "./indexSupplenze.php";
}
</script>

</html>