<?php

?>
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
        <h1>Elenco Vasche</h1>
        <div class="row">
            <div class="col-4">

            </div>
            <div class="col-4"></div>
            <div class="col-4">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <!--ADD BUTTON / aggiungi nuova struttura al db-->
                    <button class="btn btn-primary" type="button" onclick="goToAddVascaPage()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-database-add" viewBox="0 0 16 16">
                            <path
                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Z" />
                            <path
                                d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777ZM3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <table class="table able-dark table-striped">
            <thead>
                <tr>
                    <th>Piscina</th>
                    <th>IdVasca</th>
                    <th>Numero corsie</th>
                    <th>Tipologia</th>
                    <th>Apertura</th>
                    <th>Chiusura</th>
                    <th>Modifica</th>
                </tr>

            </thead>
            <tbody>

                <?php
include 'db_conf.php';
include 'visualizzaVasche.php';
?>

            </tbody>
        </table>
    </div>

    <script src="./lib/bootstrap@5.3.0.bundle.min.js">
    </script>
    <script>
    function goToAddVascaPage() {
        window.location.href = "./addVascaPage.php";
    }
    </script>
</body>

</html>