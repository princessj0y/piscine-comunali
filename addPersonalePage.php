<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./lib/bootstrap@5.3.0.min.css" rel="stylesheet">
    <title>Inserisci personale</title>
</head>

<body>
    <?php
include 'db_conf.php';

$editingId = $_POST['editpersonaleid'];
$isEditing = isset($editingId);

if ($isEditing) {
    $query = "SELECT *
              FROM personale 
                    left join Responsabile on idpersona=personale
                    left join istruttore on idpersona=personaleid 
              where idpersona='$editingId'";
    $result = pg_query($conn, $query);
    if (!$result) { // la query ha generato errori
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
    }

    $editingPersonale = pg_fetch_array($result);
}
?>
    <form method="post" action=" 
    <?php
if ($isEditing)
    echo 'editPersonale.php';
else
    echo 'addPersonale.php';
?>">
        <?php
if ($isEditing)
    echo '<input type="hidden" id="idpersonale" name="idpersonale" value="' . $editingId . '">';
?>
        <div class="container m-5 d-flex justify-content-center">
            <div class="card w-50">
                <div class="card-header">
                    <h5 class="card-title">Inserisci personale</h5>
                </div>
                <div class="card-body">

                    <div class="row mt-2">
                        <label class="form-label">Nome e cognome:</label>
                        <div class="col">
                            <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingPersonale['nome'] . '" ';
?> class="form-control" placeholder="Nome" id="nome" name="nome" required>
                        </div>
                        <div class="col">
                            <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingPersonale['cognome'] . '" ';
?> class="form-control" placeholder="Cognome" id="cognome" name="cognome" required>
                        </div>
                    </div>


                    <div class="col-12 mt-2">
                        <label for="codfis" class="form-label">Codice fiscale:</label>
                        <input type="text" <?php
if ($isEditing)
    echo ' value="' . $editingPersonale['codfis'] . '" ';
?>class="form-control" id="codfis" name="codfis" required>
                    </div>



                    <div class="col-12 mt-2">
                        <label class="form-label">Data di nascita: </label>
                        <input type="date" <?php
if ($isEditing)
    echo ' value="' . $editingPersonale['datanascita'] . '" ';
?>class="form-control" id="datanascita" name="datanascita" required>
                    </div>

                    <div class="row mt-2">
                        <div class="col mt-2">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Ruolo:</label>
                                <select class="form-select" id="ruolo" name="ruolo" required <?php
if ($isEditing)
    echo "disabled"; ?>>
                                    <option value="" <?php
if (!$isEditing)
    echo ' selected ';
?>>Seleziona</option>
                                    <option value="1" <?php
if ($isEditing && $editingPersonale['idresponsabile'] != null)
    echo ' selected ';
?>>Responsabile</option>
                                    <option value="2" <?php
if ($isEditing && $editingPersonale['idistruttore'] != null)
    echo ' selected ';
?>>Istruttore</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="telefono" class="form-label" required>Inserisci numero di telefono:</label>
                        <div class="col-10" id="addInput">
                            <?php
$numTelefoni = 0;
if ($isEditing) {
    $query = "SELECT Telefono
              FROM telefonopersonale  
              where Personale='$editingId'";
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
                     placeholder="Inserisci numero">';
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
        input.required = true;
        form.appendChild(input);
        console.log(document.querySelectorAll('.telefono'));
        counter++;
    }

}

function goToIndex() {
    window.location.href = "./indexPersonale.php";
}
</script>

</html>