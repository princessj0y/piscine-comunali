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
    <form action="addTipologiaCorso.php" method="post">
        <div class="container m-5 d-flex justify-content-center">
            <div class="card w-50">
                <div class="card-header">
                    <h5 class="card-title">Inserisci tipologia corso</h5>
                </div>
                <div class="card-body">

                    <div class="row mt-2">
                        <div class="col-12 mt-2">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <label class="form-label">Seleziona livello del corso:</label>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Livello</label>
                                <select class="form-select" id="livello" name="livello" required>
                                    <option value="">Seleziona</option>
                                    <option value="1">Livello I</option>
                                    <option value="2">Livello II</option>
                                    <option value="3">Livello III</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label class="form-label">Tipo di vasca:</label>
                        <div class="col">
                            <select name="tipovasca" class="form-select" id="tipovasca" required>
                                <option value="">Seleziona</option>
                                <option value="APERTO">APERTO</option>
                                <option value="CHIUSO">CHIUSO</option>
                                <option value="OLIMPIONICA">OLIMPIONICA</option>
                                <option value="BABY">BABY</option>
                                <option value="NEO NATALE">NEO NATALE</option>
                            </select>
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
const vascaInput = document.getElementById('vasca');

function setPiscinaAndVasca() {
    const form = document.createElement('form');
    form.action = './addCorsoPage.php';
    form.method = 'POST';
    form.style = "display: hidden";

    const piscinaNewInput = document.createElement('input');
    piscinaNewInput.type = 'hidden';
    piscinaNewInput.name = 'piscina';
    piscinaNewInput.value = piscinaInput.value;
    form.appendChild(piscinaNewInput);

    const vascaNewInput = document.createElement('input');
    vascaNewInput.type = 'hidden';
    vascaNewInput.name = 'vasca';
    vascaNewInput.value = vascaInput.value;
    form.appendChild(vascaNewInput);

    document.body.appendChild(form);
    form.submit();
}

function goToIndex() {
    window.location.href = "./indexCorsi.php";
}
</script>

</html>