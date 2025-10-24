<?php
require_once '../autoload.php';

use Libreria\Route;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Formulario Pagos</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbars/">
    <!-- Bootstrap core CSS -->
    <link href="css/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/navbar.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Pagina de LuisferDeveloper</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarsExample09">
                    </div>
                </div>
            </nav>
            <div>
                <?php
                require_once '../routes/web.php';
                ?>
            </div>
        </div>
    </main>
    <script src="css/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>