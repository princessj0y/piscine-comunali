<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./lib/bootstrap@5.3.0.min.css" rel="stylesheet">
    <title>Inserisci nuova vasca</title>
</head>

<body>
    <?php
include 'db_conf.php';

$editingId = $_POST['editvascaid'];
$isEditing = isset($editingId);

if ($isEditing) {
    $query = "SELECT * 
              FROM vasca
              where idvasca='$editingId'";
    $result = pg_query($conn, $query);
    if (!$result) { // la query ha generato errori
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }

    $editingVasca = pg_fetch_array($result);
}
?>
    <form method="post" action=" 
    <?php
if ($isEditing)
    echo 'editVasca.php';
else
    echo 'addVasca.php';
?>">
        <?php
if ($isEditing)
    echo '<input type="hidden" id="idvasca" name="idvasca" value="' . $editingId . '">';
?>
        <div class="container m-5 d-flex justify-content-center">
            <div class="card w-50">
                <div class="card-header">
                    <h5 class="card-title">Inserisci nuova vasca</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="form-label">Seleziona la piscina:</label>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Piscina</label>
                                <select class="form-select" id="piscina" name="piscina" required>
                                    <option value="">Seleziona</option>
                                    <?php
if ($isEditing)
    $piscina = $editingVasca['piscina'];
else
    $piscina = '';

$query = "SELECT idpiscina, nome FROM piscina";
$result = pg_query($conn, $query);
if (!$result) { // la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

while ($row = pg_fetch_array($result)) {
    if ($row['idpiscina'] == $piscina) {
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
                        <div class="col">
                            <input type="number" step="1" min="1" <?php
if ($isEditing)
    echo ' value="' . $editingVasca['corsie'] . '" ';
?> class="form-control" placeholder="Numero corsie" id="ncorsie" name="ncorsie" required>
                        </div>
                        <div class="col">
                            <select name="tipologia" class="form-select" id="tipologia" required>
                                <option value="">Seleziona</option>
                                <?php
foreach (array('APERTO', 'CHIUSO', 'OLIMPIONICA', 'BABY', 'NEO NATALE') as $currTipo) {
    if ($isEditing && $currTipo == $editingVasca['tipologia']) {
        echo "<option value='$currTipo' selected>$currTipo</option>";
    }
    else {
        echo "<option value='$currTipo'>$currTipo</option>";
    }
}
?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label class="form-label">Periodo di fruizione</label>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="apertura">Apertura</label>
                                <input type="date" <?php
if ($isEditing)
    echo ' value="' . $editingVasca['apertura'] . '" ';
?> class="form-control" id="apertura" name="aperturaDate" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="chiusura">Chiusura</label>
                                <input type="date" <?php
if ($isEditing)
    echo ' value="' . $editingVasca['chiusura'] . '" ';
?> class="form-control" id="chiusura" name="chiusuraDate" required>
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
function goToIndex() {
    window.location.href = "./indexVasche.php";
}
</script>

</html>