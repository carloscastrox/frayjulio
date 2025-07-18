<?php
include 'conn.php';
session_start();

if (isset($_SESSION['user']) && isset($_SESSION['id']) && isset($_SESSION['rol'])) {
    $login = $conn->prepare('SELECT * FROM user WHERE email = ? AND iduser = ? AND rol = ? LIMIT 1');
    $login->bindParam(1, $_SESSION['user']);
    $login->bindParam(2, $_SESSION['id']);
    $login->bindParam(3, $_SESSION['rol']);
    $login->execute();
    $result = $login->fetch(PDO::FETCH_ASSOC);

    if (is_array($result)) {
?>

        <!DOCTYPE html>
        <html lang="es-CO" class="h-100">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Fray Julio</title>

            <!--Favicon-->
            <link rel="shortcut icon" href="../assets/img/logosena.png" type="image/x-icon">

            <!--SEO Tags-->
            <meta name="author" content="Fray Julio">
            <meta name="description" content="Aplicativo web Bootstrap">
            <meta name="keywords" content="SENA, sena, Sena">

            <!--Optimization Tags-->
            <meta name="theme-color" content="#000000">
            <meta name="MobileOptimized" content="width">
            <meta name="HandhledFriendly" content="true">
            <meta name="mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black-traslucent">

            <!--Styles and complements Bootstrap 5.3-->
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="../assets/css/me.styles.css">
        </head>

        <body>
            <header>
                <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="../assets/img/logo.png" alt="Avatar Logo" style="width: 40px" class="" />
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsibleNavbar" aria-label="Boton de menú">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="collapsibleNavbar">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="home">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="?page=pubs">Publicaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#team">Integrantes</a>
                                </li>
                            </ul>
                            <div class="d-flex">
                                <button class="btn btn-primary" type="button"
                                    onclick="location.href='?page=profile'">Perfil</button>
                                <button class="btn btn-primary" type="button"
                                    onclick="location.href='logout.php'">Salir</button>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <main class="container pt-5">
                <?php
                //controlador de modulos o subpáginas
                $page = isset($_GET['page']) ? strtolower($_GET['page']) : 'home';
                require_once './' . $page . '.php';

                if ($page == 'home') {
                    require_once 'init.php';
                }
                ?>
            </main>
    <?php
    }
} else {
    header("Location: ./");
    exit();
}
    ?>
    <!-- Script Bootstrap -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>