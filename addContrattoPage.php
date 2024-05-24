<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./lib/bootstrap@5.3.0.min.css" rel="stylesheet">
    <title>Inserisci nuovo contratto</title>
</head>

<body>
    <?php
include 'db_conf.php';

$editingId = $_POST['editcontrattoid'];
$isEditing = isset($editingId);

if ($isEditing) {
    $query = "SELECT * FROM contratto where idcontratto='$editingId'";
    $result = pg_query($conn, $query);
    if (!$result) { // la query ha generato errori
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }

    $editingContratto = pg_fetch_array($result);
}
?>
    <form method="post" action=" 
    <?php
if ($isEditing)
    echo 'editContratto.php';
else
    echo 'addContratto.php';
?>">

        <?php
if ($isEditing)
    echo '<input type="hidden" id="idcontratto" name="idcontratto" value="' . $editingId . '">';
?>
        <div class="container m-5 d-flex justify-content-center">
            <div class="card w-50">
                <div class="card-header">
                    <h5 class="card-title">Inserisci contratto</h5>
                </div>
                <div class="card-body">

                    <div class="row mt-2">
                        <div class="col mt-2">
                            <label class="form-label">Seleziona istruttore:</label>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Istruttore:</label>
                                <select class="form-select" id="istruttore" name="istruttore" required>
                                    <option value="" selected>Da definire</option>
                                    <?php
if ($isEditing)
    $istruttore = $editingContratto['istruttore'];
else
    $istruttore = '';

$query = "SELECT nome,cognome,idistruttore FROM personale join istruttore on idpersona=personaleid";
$result = pg_query($conn, $query);
if (!$result) { //la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

while ($row = pg_fetch_array($result)) {
    if ($istruttore == $row['idistruttore']) {
        echo '<option value="' . $row['idistruttore'] . '" selected>' . $row['nome'] . ' ' . $row['cognome'] . '</option>';
    }
    else {
        echo '<option value="' . $row['idistruttore'] . '">' . $row['nome'] . ' ' . $row['cognome'] . '</option>';
    }
}
?>
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="form-label">Seleziona la piscina:</label>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Piscina</label>
                                <select class="form-select" id="piscina" name="piscina" required>
                                    <option value="">Seleziona</option>
                                    <?php
if ($isEditing)
    $piscina = $editingContratto['piscina'];
else
    $piscina = '';

$query = "SELECT idpiscina,nome FROM piscina";
$result = pg_query($conn, $query);
if (!$result) { // la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

while ($row = pg_fetch_array($result)) {
    if ($piscina == $row['idpiscina']) {
        echo '<option value="' . $row['idpiscina'] . '" selected>' . $row['nome'] . ' </option>';
    }
    else {
        echo '<option value="' . $row['idpiscina'] . '">' . $row['nome'] . ' </option>';
    }
}
?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mt-2">
                            <label class="form-label">Tipo di contratto:</label>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Contratto:</label>
                                <select class="form-select" id="tipocontratto" name="tipocontratto"
                                    onchange="switchTipoContratto()" required>
                                    <option value="" <?php
if (!$isEditing)
    echo ' selected ';
?>>Da definire</option>
                                    <option value="1" <?php
if ($isEditing && $editingContratto['fine'] == null)
    echo ' selected ';
?>>Indeterminato</option>
                                    <option value="2" <?php
if ($isEditing && $editingContratto['fine'] != null)
    echo ' selected ';
?>>Stagionale</option>
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <label class="form-label">Data di inizio: </label>
                        <input type="date" <?php
if ($isEditing)
    echo ' value="' . $editingContratto['inizio'] . '" ';
?> class="form-control" id="inizio" name="inizio" required>
                    </div>

                    <div id="data-fine-div" class="col-12 mt-2" <?php
if (!$isEditing || $editingContratto['fine'] == null) {
    echo ' style="display: none;" ';
}
?>>
                        <label class="form-label">Data di fine: </label>
                        <input type="date" <?php
if ($isEditing)
    echo ' value="' . $editingContratto['fine'] . '" ';
?> class="form-control" id="fine" name="fine">
                    </div>

                    <div id="ferie-div" class="col-12 mt-2" <?php
if (!$isEditing || $editingContratto['fine'] != null) {
    echo ' style="display: none;" ';
}
?>>
                        <label class="form-label">Giorni di ferie: </label>
                        <input type="number" step="1" <?php
if ($isEditing)
    echo ' value="' . $editingContratto['nferie'] . '" ';
?> class="form-control" id="nferie" name="nferie">
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
const tipoContrattoInput = document.getElementById('tipocontratto');

const dataFineDiv = document.getElementById('data-fine-div');
const dataFineInput = dataFineDiv.querySelector('[name="fine"]')

const ferieDiv = document.getElementById('ferie-div');
const ferieInput = dataFineDiv.querySelector('[name="ferie"]')

function switchTipoContratto() {
    const showDataFine = tipoContrattoInput.value == '2';

    if (showDataFine) {
        dataFineDiv.style = "";
        dataFineInput.required = true;
    } else {
        dataFineDiv.style = "display: none;";
        dataFineInput.required = false;
    }

    const showFerie = tipoContrattoInput.value == '1';
    if (showFerie) {
        ferieDiv.style = "";
        ferieInput.required = true;
    } else {
        ferieDiv.style = "display: none;";
        ferieInput.required = false;
    }
}

function goToIndex() {
    window.location.href = "./indexPersonale.php";
}
</script>

</html>