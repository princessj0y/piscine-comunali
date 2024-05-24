<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./lib/bootstrap@5.3.0.min.css" rel="stylesheet">
    <title>Inserisci corso</title>
</head>

<body>
    <?php
include 'db_conf.php';

$editingId = $_POST['editcorsoid'];
$isEditing = isset($editingId);

if ($isEditing) {
    // durata è un interval, quindi estraggo i secondi (ovvero epoch) e poi divido per 60 e casto a int
    $query = "SELECT *, 
                    (EXTRACT(epoch FROM durata)/60)::int as duratainmin 
              FROM corso 
              where idcorso='$editingId'";
    $result = pg_query($conn, $query);
    if (!$result) { // la query ha generato errori
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }

    $editingCorso = pg_fetch_array($result);
}
?>
    <form method="post" action=" 
    <?php
if ($isEditing)
    echo 'editCorso.php';
else
    echo 'addCorso.php';
?>">
        <?php
if ($isEditing)
    echo '<input type="hidden" id="idcorso" name="idcorso" value="' . $editingId . '">';
?>
        <div class="container m-5 d-flex justify-content-center">
            <div class="card w-50">
                <div class="card-header">
                    <h5 class="card-title">Inserisci corso</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <label class="form-label">Seleziona la piscina:</label>
                        <div class="col">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Piscina</label>
                                <select class="form-select" id="piscina" name="piscina" onchange="setPiscinaAndVasca()"
                                    required>
                                    <option value="">Seleziona</option>
                                    <?php
if (isset($_POST['piscina']))
    $piscina = $_POST['piscina'];
else if ($isEditing)
    $piscina = $editingCorso['piscina'];
else
    $piscina = '';

$query = "SELECT idpiscina,nome FROM piscina";
$result = pg_query($conn, $query);
if (!$result) { //la query ha generato errori
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
                        <label class="form-label">Seleziona il tipo di corso:</label>
                        <div class="input-group col">
                            <label class="input-group-text" for="inputGroupSelect01">Comunale</label>
                            <select class="form-select" id="comunale" name="comunale" required>
                                <option value="">Seleziona</option>
                                <?php
if (isset($_POST['comunale']))
    $comunale = $_POST['comunale'];
else if ($isEditing)
    $comunale = $editingCorso['comunale'];
else
    $comunale = '';

if ($comunale == 'true' || $comunale == 't')
    echo '<option value="true" selected>Sì</option>';
else
    echo '<option value="true">Sì</option>';

if ($comunale == 'false' || $comunale == 'f')
    echo '<option value="false" selected>No</option>';
else
    echo '<option value="false">No</option>';
?>
                            </select>
                        </div>
                        <div class="input-group col">
                            <label class="input-group-text" for="inputGroupSelect01">Tipo</label> <select
                                class="form-select" id="tipocorso" name="tipocorso" onchange="setPiscinaAndVasca()"
                                required>
                                <option value="">Seleziona</option>
                                <?php
if (isset($_POST['tipocorso']))
    $tipoCorso = $_POST['tipocorso'];
else if ($isEditing)
    $tipoCorso = $editingCorso['tipocorso'];
else
    $tipoCorso = '';

$query = "SELECT tipocorsoid,nome,livello FROM TipologiaCorsoNuoto";
$result = pg_query($conn, $query);
if (!$result) { //la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

while ($row = pg_fetch_array($result)) {
    if ($tipoCorso == $row['tipocorsoid']) {
        echo '<option value="' . $row['tipocorsoid'] . '" selected>' . $row['nome'] . ' - ' . $row['livello'] . ' </option>';
    }
    else {
        echo '<option value="' . $row['tipocorsoid'] . '">' . $row['nome'] . ' - ' . $row['livello'] . ' </option>';
    }
}
?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label class="form-label">Seleziona la vasca:</label>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Vasca</label>
                                <select class="form-select" id="vasca" name="vasca" onchange="setPiscinaAndVasca()"
                                    required>
                                    <option value="">Seleziona</option>
                                    <?php
if (isset($_POST['vasca']))
    $vasca = $_POST['vasca'];
else if ($isEditing)
    $vasca = $editingCorso['vasca'];
else
    $vasca = '';

$query = "SELECT v.idvasca,v.tipologia,v.corsie,t.*
        from vasca v 
	        join tipologiacorsonuoto t on v.tipologia=t.tipologia
        where v.piscina='$piscina' and t.tipocorsoid='$tipoCorso'";
$result = pg_query($conn, $query);

while ($row = pg_fetch_array($result)) {
    if ($vasca == $row['idvasca']) {
        echo '<option value="' . $row['idvasca'] . '" selected>' . $row['tipologia'] . ' - ' . $row['corsie'] . ' corsie</option>';
    }
    else {
        echo '<option value="' . $row['idvasca'] . '">' . $row['tipologia'] . ' - ' . $row['corsie'] . ' corsie</option>';
    }
}
?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="form-label">Seleziona la corsia:</label>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Corsia</label>
                                <?php
if ($isEditing)
    $corsia = $editingCorso['corsia'];
else
    $corsia = '';

$query = "SELECT corsie from vasca where idvasca='$vasca'";
$result = pg_query($conn, $query);
$corsie = pg_fetch_array($result)[0];

if (isset($corsie)) {
    echo '<input type="number" 
                 step="1" min="1" max="' . $corsie . '"
                 value="' . $corsia . '" 
                 class="form-control"
                 id="corsia" name="corsia" 
                 required>';
}
else {
    echo '<input type="number" step="1" min="0" max="0" class="form-control" id="corsia" name="corsia" required>';
}
?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <label for="nome" class="form-label">Edizione:</label>
                        <input type="number" step="1" min="1900" <?php
if ($isEditing)
    echo ' value="' . $editingCorso['edizione'] . '" ';
?> class="form-control" id="edizione" name="edizione" required>
                    </div>

                    <div class="row mt-2">
                        <label for="nome" class="form-label">Istruttore:</label>
                        <div class="col">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Istruttore:</label>
                                <select class="form-select" id="istruttore" name="istruttore" required>
                                    <option value="">Seleziona</option>
                                    <?php
if ($isEditing)
    $istruttore = $editingCorso['istruttoretitolare'];
else
    $istruttore = '';

$query = "SELECT personale.*, idistruttore
from istruttore 
	join personale on personaleid=idpersona
	join contratto on idistruttore=istruttore
	join piscina on piscina=idpiscina
where idpiscina='$piscina'";
$result = pg_query($conn, $query);

while ($row = pg_fetch_array($result)) {
    if ($istruttore == $row['idistruttore']) {
        echo '<option value="' . $row['idistruttore'] . '" selected>' . $row['nome'] . ' ' . $row['cognome'] . '</option>';
    }
    else {
        echo '<option value="' . $row['idistruttore'] . '">' . $row['nome'] . ' ' . $row['cognome'] . '</option>';
    }
}?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <label for="costo" class="form-label">Costo:</label>
                        <div class="input-group">
                            <label class="input-group-text" for="inputGroupSelect01">€</label>
                            <input type="number" step="0.01" min="0" <?php
if ($isEditing)
    echo ' value="' . $editingCorso['costo'] . '" ';
?> class="form-control" id="costo" name="costo" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label class="form-label">Partecipanti:</label>
                        <div class="input-group col">
                            <label class="input-group-text" for="inputGroupSelect01">Minimi</label>
                            <input type="number" step="1" min="0" <?php
if ($isEditing)
    echo ' value="' . $editingCorso['minpartecipanti'] . '" ';
?> class="form-control" id="min" name="min" required>
                        </div>
                        <div class="input-group col">
                            <label class="input-group-text" for="inputGroupSelect01">Massimi</label>
                            <input type="number" step="1" min="0" <?php
if ($isEditing)
    echo ' value="' . $editingCorso['maxpartecipanti'] . '" ';
?> class="form-control" id="max" name="max" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label class="form-label">Orario:</label>
                        <div class="input-group col">
                            <label class="input-group-text" for="inputGroupSelect01">Inizio</label>
                            <input type="time" <?php
if ($isEditing)
    echo ' value="' . $editingCorso['orainizio'] . '" ';
?> class="form-control" id="inizio" name="inizio" required>
                        </div>
                        <div class="input-group col">
                            <label class="input-group-text" for="inputGroupSelect01">Durata (minuti)</label>
                            <input type="number" step="1" min="1" <?php
if ($isEditing)
    echo ' value="' . $editingCorso['duratainmin'] . '" ';
?> class="form-control" id="durata" name="durata" required>
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
const piscinaInput = document.getElementById('piscina');
const tipoCorsoInput = document.getElementById('tipocorso');
const vascaInput = document.getElementById('vasca');
const comunaleInput = document.getElementById('comunale');

function setPiscinaAndVasca() {
    const form = document.createElement('form');
    form.action = './addCorsoPage.php';
    form.method = 'POST';
    form.style = "display: hidden";

    <?php
if ($isEditing) {
?>
    const editingIdInput = document.createElement('input');
    editingIdInput.type = 'hidden';
    editingIdInput.name = 'editcorsoid';
    editingIdInput.value = <?php echo $editingId; ?>;
    form.appendChild(editingIdInput);
    <?php
}
?>

    const piscinaNewInput = document.createElement('input');
    piscinaNewInput.type = 'hidden';
    piscinaNewInput.name = 'piscina';
    piscinaNewInput.value = piscinaInput.value;
    form.appendChild(piscinaNewInput);

    const tipoCorsoNewInput = document.createElement('input');
    tipoCorsoNewInput.type = 'hidden';
    tipoCorsoNewInput.name = 'tipocorso';
    tipoCorsoNewInput.value = tipoCorsoInput.value;
    form.appendChild(tipoCorsoNewInput);

    const vascaNewInput = document.createElement('input');
    vascaNewInput.type = 'hidden';
    vascaNewInput.name = 'vasca';
    vascaNewInput.value = vascaInput.value;
    form.appendChild(vascaNewInput);

    const comunaleNewInput = document.createElement('input');
    comunaleNewInput.type = 'hidden';
    comunaleNewInput.name = 'comunale';
    comunaleNewInput.value = comunaleInput.value;
    form.appendChild(comunaleNewInput);

    document.body.appendChild(form);
    form.submit();
}

function goToIndex() {
    window.location.href = "./indexCorsi.php";
}
</script>

</html>