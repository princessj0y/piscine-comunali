<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./lib/bootstrap@5.3.0.min.css" rel="stylesheet">
    <title>Inserisci tipologia corso</title>
</head>

<body>

    <?php
include 'db_conf.php';

$editingId = $_POST['editiscrittoid'];
$isEditing = isset($editingId);

if ($isEditing) {
    $query = "SELECT membro.*, 
                     g.nome as nomegenitore,
                     g.cognome as cognomegenitore,
                     g.codfis as codfisgenitore,
                     g.contatto as telefonogenitore
              FROM membro
                    left join genitore g on membro.tessera = g.minorenne 
              where tessera='$editingId'";
    $result = pg_query($conn, $query);
    if (!$result) { // la query ha generato errori
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }

    $editingIscritto = pg_fetch_array($result);
}
?>
    <form method="post" action=" 
    <?php
if ($isEditing)
    echo 'editMembro.php';
else
    echo 'addMembro.php';
?>">
        <?php
if ($isEditing)
    echo '<input type="hidden" id="idmembro" name="idmembro" value="' . $editingId . '">';
?>
        <div class="container m-5 d-flex justify-content-center">
            <div class="card w-50">
                <div class="card-header">
                    <h5 class="card-title">Inserisci nuovo membro</h5>
                </div>
                <div class="card-body">

                    <div class="row mt-2">
                        <label class="form-label">Nome e cognome:</label>
                        <div class="col">
                            <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingIscritto['nome'] . '" ';
?> class="form-control" placeholder="Nome" id="nome" name="nome" required>
                        </div>
                        <div class="col">
                            <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingIscritto['cognome'] . '" ';
?> class="form-control" placeholder="Cognome" id="cognome" name="cognome" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-6">
                            <label for="nome" class="form-label">Inserisci codice fiscale:</label>
                            <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingIscritto['codfis'] . '" ';
?> class="form-control" id="codfis" name="codfis" required>
                        </div>
                        <div class="col-6">
                            <label for="nome" class="form-label">Inserisci data di nascita:</label>
                            <input type="date" <?php
if ($isEditing)
    echo ' value="' . $editingIscritto['datanascita'] . '" ';
?> class="form-control" id="datanascita" name="datanascita" required>
                        </div>
                    </div>


                    <div class="row mt-2">
                        <label class="form-label">Seleziona la piscina:</label>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Piscina</label>
                                <select class="form-select" id="piscina" name="piscina" required>
                                    <option value="">Seleziona</option>
                                    <?php
if ($isEditing)
    $piscina = $editingIscritto['piscina'];
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

                    <div id="formGenitore">
                        <h3>Compila solo se minorenne</h3>
                        <div class=" row mt-2">
                            <label class="form-label">Nome e cognome:</label>
                            <div class="col">
                                <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingIscritto['nomegenitore'] . '" ';
?> class="form-control" placeholder="Nome" id="nomegenitore" name="nomegenitore">
                            </div>
                            <div class="col">
                                <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingIscritto['cognomegenitore'] . '" ';
?> class="form-control" placeholder="Cognome" id="cognomegenitore" name="cognomegenitore">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="codfisgenitore" class="form-label">Inserisci codice fiscale:</label>
                                <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingIscritto['codfisgenitore'] . '" ';
?> class="form-control" id="codfisgenitore" name="codfisgenitore">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="nome" class="form-label">Inserisci numero di telefono:</label>
                                <input type="tel" <?php
if ($isEditing)
    echo ' value="' . $editingIscritto['telefonogenitore'] . '" ';
?> class="form-control" id="telefonogenitore" name="numerogenitore">
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
    window.location.href = "./indexIscritti.php";
}
</script>

</html>