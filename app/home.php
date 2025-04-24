<?php
include 'conn.php';
session_start();

if (isset($_SESSION['user'])) {
    $login = $conn->prepare('SELECT* FROM user WHERE email = ?');
    $login->bindParam(1, $_SESSION['user']);
    $login->execute();
    $result = $login->fetch(PDO::FETCH_ASSOC);

    if (is_array($result)) {
    ?>

        <!DOCTYPE html>
        <html lang="es-CO" class="h-100">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Celia</title>

            <!--Favicon-->
            <link rel="shortcut icon" href="../assets/img/logosena.png" type="image/x-icon">

            <!--SEO Tags-->
            <meta name="author" content="Celia">
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

<a href="logout">Cerrar Sesión</a>


<?php
        }
    }else {
        header("Location: ./");
        exit();
    }
?>
</body>

</html>