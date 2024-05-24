<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./lib/bootstrap@5.3.0.min.css" rel="stylesheet">
    <title>Inserisci nuova piscina</title>
</head>

<body>
    <?php
include 'db_conf.php';

$editingId = $_POST['editpiscinaid'];
$isEditing = isset($editingId);

if ($isEditing) {
    $query = "SELECT piscina.*, 
                     reperibilita.*,
                     (piscina.indirizzo).via as via,
                     (piscina.indirizzo).numerocivico as civico
              FROM piscina 
                    left join reperibilita on piscina.reperibilita=reperibilita.idreperibilita
              where idpiscina='$editingId'";
    $result = pg_query($conn, $query);
    if (!$result) { // la query ha generato errori
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }

    $editingPiscina = pg_fetch_array($result);
}
?>
    <form method="post" action=" 
    <?php
if ($isEditing)
    echo 'editPiscina.php';
else
    echo 'addPiscina.php';
?>">
        <?php
if ($isEditing)
    echo '<input type="hidden" id="idpiscina" name="idpiscina" value="' . $editingId . '">';
?>
        <div class="container m-5 d-flex justify-content-center">
            <div class="card w-50">
                <div class="card-header">
                    <h5 class="card-title">Inserisci nuova struttura</h5>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <label for="nome" class="form-label">Inserisci nome della piscina:</label>
                        <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingPiscina['nome'] . '" ';
?>class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="row mt-2">
                        <label class="form-label">Indirizzo:</label>
                        <div class="col">
                            <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingPiscina['via'] . '" ';
?>class="form-control" placeholder="Via" aria-label="Via" id="via" name="via" required>
                        </div>
                        <div class="col">
                            <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingPiscina['civico'] . '" ';
?>class="form-control" placeholder="Numero civico" id="nCiv" name="nCiv" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label class="form-label">Periodo apertura</label>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="apertura">Apertura</label>
                                <input type="date" <?php
if ($isEditing)
    echo ' value="' . $editingPiscina['apertura'] . '" ';
?>class="form-control" id="apertura" name="aperturaDate" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="chiusura">Chiusura</label>
                                <input type="date" <?php
if ($isEditing)
    echo ' value="' . $editingPiscina['chiusura'] . '" ';
?>class="form-control" id="chiusura" name="chiusuraDate" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="form-label">Inserisci il responsabile della struttura:</label>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Responsabile</label>
                                <select class="form-select" id="responsabile" name="responsabile">
                                    <option value="NULL">Da definire</option>
                                    <?php
if ($isEditing)
    $responsabile = $editingPiscina['responsabile'];
else
    $responsabile = '';

$query = "SELECT nome,cognome,idresponsabile FROM personale join responsabile on idpersona=personale";
$result = pg_query($conn, $query);
if (!$result) { // la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

while ($row = pg_fetch_array($result)) {
    if ($responsabile == $row['idresponsabile']) {
        echo '<option value="' . $row['idresponsabile'] . '" selected>' . $row['nome'] . ' ' . $row['cognome'] . '</option>';
    }
    else {
        echo '<option value="' . $row['idresponsabile'] . '">' . $row['nome'] . ' ' . $row['cognome'] . '</option>';
    }
}
?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <label for="reperibilita" class="form-label">Inserisci la reperibilità:</label>

                        <div id="giorno-reperibilita-template" class="col-12 row" style="display: none;">
                            <input type="hidden" name="giorni[]">
                            <div class="label-giorno-reperibilita col-2">
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="apertura">Inizio</label>
                                    <input type="time" class="form-control" name="inizio[]">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="chiusura">Fine</label>
                                    <input type="time" class="form-control" name="fine[]">
                                </div>
                            </div>
                        </div>

                        <div class="col-9">
                        </div>
                        <div class="col-3">
                            <select class="form-select" id="giornoreperibilita" onchange="addGiornoReperibilita()">
                                <option value="">----</option>
                                <option value="0">Lunedì</option>
                                <option value="1">Martedì</option>
                                <option value="2">Mercoledì</option>
                                <option value="3">Giovedì</option>
                                <option value="4">Venerdì</option>
                                <option value="5">Sabato</option>
                                <option value="6">Domenica</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <label for="telefono" class="form-label">Inserisci numero di telefono:</label>
                        <div class="col-10" id="addInput">
                            <?php
$numTelefoni = 0;
if ($isEditing) {
    $query = "SELECT Telefono
              FROM telefono  
              where Piscina='$editingId'";
    $result = pg_query($conn, $query);
    if (!$result) { // la query ha generato errori
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }

    while ($row = pg_fetch_array($result)) {
        if ($numTelefoni == 0) {
            echo '<input type="tel" class="form-control"
                     value="' . $row['telefono'] . '" 
                     id="telefono" name="numeri[]"
                     placeholder="Inserisci numero">';
        }
        else {
            echo '<input type="tel" class="form-control mt-2"
                     value="' . $row['telefono'] . '" 
                     id="telefono" name="numeri[]"
                     placeholder="Inserisci numero"">';
        }
        $numTelefoni++;
    }
}

if ($numTelefoni == 0) {
    $numTelefoni++;
    echo '<input type="tel" class="form-control" id="telefono" name="numeri[]"
                  placeholder="Inserisci numero">';
}
?>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-primary" id="addNumber">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <?php
if ($isEditing) {
    echo '<button class="btn btn-danger" type="button" onclick="eliminaPiscina(\'' . $editingId . '\')">Elimina</button>';
}
?>
                        <button class="btn btn-secondary" type="button" onclick="goToIndex()">Annulla</button>
                        <button class="btn btn-primary" type="submit">Inserisci</button>
                    </div>
                </div>

            </div>
    </form>
</body>
<script>
var counter = <?php echo $numTelefoni - 1; ?>;
var addNumber = document.getElementById('addNumber');

//add click function
addNumber.addEventListener('click', function(event) {
    addField();
});

//it's more efficient to get the form reference outside of the function, rather than getting it each time
var form = document.getElementById('addInput');

function addField() {
    if (counter < 2) {
        var input = document.createElement('input');
        input.type = "tel";
        input.className = 'form-control mt-2';
        input.classList.add('telefono');
        input.placeholder = 'Inserisci numero';
        input.name = "numeri[]";
        form.appendChild(input);
        console.log(document.querySelectorAll('.telefono'));
        counter++;
    }
}

function eliminaPiscina(id) {
    const form = document.createElement('form');
    form.action = './eliminaPiscina.php';
    form.method = 'POST';
    form.style = "display: hidden";

    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'delete[]';
    idInput.value = id;
    form.appendChild(idInput);

    document.body.appendChild(form);
    form.submit();
}

const templateGiornoReperibilita = document.getElementById('giorno-reperibilita-template');
const giornoReperibilitaInput = document.getElementById('giornoreperibilita');

function addGiornoReperibilita() {
    const giornoSelezionato = giornoReperibilitaInput.value;
    if (!giornoSelezionato)
        return;

    doAddGiornoReperibilita(giornoSelezionato);
}

function doAddGiornoReperibilita(giornoSelezionato) {
    const optionGiornoSelezionato = giornoReperibilitaInput.querySelector('[value="' + giornoSelezionato + '"]');
    if (!optionGiornoSelezionato)
        return;

    giornoReperibilitaInput.removeChild(optionGiornoSelezionato);

    const giornoReperibilitaDiv = templateGiornoReperibilita.cloneNode(true);
    giornoReperibilitaDiv.id = "giorno-reperibilita-" + giornoSelezionato;
    giornoReperibilitaDiv.style = "";
    giornoReperibilitaDiv.querySelector(".label-giorno-reperibilita").textContent = optionGiornoSelezionato.textContent;
    giornoReperibilitaDiv.querySelector("[name='giorni[]']").value = giornoSelezionato;
    giornoReperibilitaDiv.querySelector("[name='inizio[]']").required = true;
    giornoReperibilitaDiv.querySelector("[name='fine[]']").required = true;

    let inserted = false;
    let currNode = templateGiornoReperibilita.previousSibling;
    let firstNode = templateGiornoReperibilita;
    while (currNode) {
        if (currNode.id && currNode.id.startsWith('giorno-reperibilita-')) {
            const num = Number(currNode.id.substring('giorno-reperibilita-'.length));
            if (giornoSelezionato > num) {
                currNode.parentElement.insertBefore(giornoReperibilitaDiv, currNode.nextSibling);
                inserted = true;
                break;
            }
            firstNode = currNode;
        }

        currNode = currNode.previousSibling;
    }

    if (!inserted)
        firstNode.parentElement.insertBefore(giornoReperibilitaDiv, firstNode);
    return giornoReperibilitaDiv;
}

<?php
if ($isEditing) {
    $query = "SELECT * FROM giornoreperibilita
              where idreperibilita='" . $editingPiscina['idreperibilita'] . "'";
    $result = pg_query($conn, $query);

    // giorno,orainizio,orafine
    while ($row = pg_fetch_array($result)) {
?> {
    const giornoReperibilitaDiv = doAddGiornoReperibilita(<?php
        echo array_search($row['giorno'], array(
            'Lunedi', 'Martedi', 'Mercoledi',
            'Giovedi', 'Venerdi', 'Sabato', 'Domenica'));
?>);
    giornoReperibilitaDiv.querySelector("[name='inizio[]']").value = '<?php echo $row['orainizio']; ?>';
    giornoReperibilitaDiv.querySelector("[name='fine[]']").value = '<?php echo $row['orafine']; ?>';
}
<?php
    }
}
?>

function goToIndex() {
    window.location.href = "./index.php";
}
</script>

</html>