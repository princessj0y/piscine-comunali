<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./lib/bootstrap@5.3.0.min.css" rel="stylesheet">
    <title>Piscine comunali</title>
</head>

<body>
    <!--NAVBAR-->
    <nav class="navbar bg-light  justify-content-center">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./index.php">Piscine</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./indexVasche.php">Vasche</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./indexCorsi.php">Corsi di nuoto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./indexPersonale.php">Personale</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./indexIscritti.php">Iscritti</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./indexSupplenze.php">Supplenze</a>
            </li>
        </ul>
    </nav>
    <!--END OF NAVBAR-->


    <div class="container">
        <h1>Elenco Personale</h1>
        <form action="./indexPersonale.php" method="post">
            <div class="row mb-3">
                <div class="col-3">
                    <?php
include 'db_conf.php';

$query = "SELECT idpiscina,nome FROM piscina ";
$result = pg_query($conn, $query);
if (!$result) { //la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

echo '<select class="form-select" id="piscina" name="piscina" required>';
echo '<option value="">Seleziona piscina</option>';
$piscina = $_POST['piscina'];

while ($row = pg_fetch_array($result)) {

    if ($row['idpiscina'] == $piscina) {
        echo '<option value="' . $row['idpiscina'] . '" selected>' . $row['nome'] . ' </option>';
    }
    else {
        echo '<option value="' . $row['idpiscina'] . '">' . $row['nome'] . ' </option>';
    }



}
echo ' </select>';
?>
                </div>
                <div class="col-3">
                    <?php

$query = "SELECT min(extract (year from inizio)) as anno from contratto ";
$result = pg_query($conn, $query);
if (!$result) { //la query ha generato errori
    echo "Si è verificato un errore.<br/>";
    echo pg_last_error($conn);
    exit();
}

echo '<select class="form-select" id="anno" name="anno" required>';
echo '<option value="">Seleziona anno </option>';
$annoSelezionato = $_POST['anno'];
$annoIniziale = pg_fetch_array($result)['anno'];
$annoFinale = date("Y");
if ($annoIniziale) {
    for ($anno = $annoIniziale; $anno <= $annoFinale; $anno++) {
        if ($anno == $annoSelezionato) {
            echo '<option value="' . $anno . '" selected>' . $anno . '</option>';
        }
        else {
            echo '<option value="' . $anno . '">' . $anno . '</option>';
        }

    }
}
else {
    if ($annoFinale == $annoSelezionato) {
        echo '<option value="' . $annoFinale . '" selected>' . $annoFinale . '</option>';
    }
    else {
        echo '<option value="' . $annoFinale . '">' . $annoFinale . '</option>';
    }
}


echo ' </select>';
?>
                </div>
                <div class="col-3">
                    <button class="btn btn-primary" type="sumbit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </div>
        </form>
        <div class="col-3">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!--ADD BUTTON PERSONALE / aggiungi nuova personale al db-->
                <button class="btn btn-primary" type="button" onclick="goToAddPersonale()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-plus" viewBox="0 0 16 16">
                        <path
                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        <path fill-rule="evenodd"
                            d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                </button>
                <!--ADD BUTTON CONTRATTO/ aggiungi contratto-->
                <button class="btn btn-primary" type="button" onclick="goToAddContratto()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                        <path
                            d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>



    <?php
$piscina = $_POST['piscina'];
$anno = $_POST['anno'];

if (isset($piscina) && isset($anno)) {
    include 'visualizzaPersonale.php';
}

pg_close($conn);
?>

    </div>

    <script src="./lib/bootstrap@5.3.0.bundle.min.js">
    </script>
    <script>
    function goToAddPersonale() {
        window.location.href = "./addPersonalePage.php";
    }

    function goToAddContratto() {
        window.location.href = "./addContrattoPage.php";
    }
    </script>
</body>

</html>