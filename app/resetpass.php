<?php
session_start();
include 'conn.php';

if (isset($_GET['id']) && isset($_GET['token'])) {
    $id = base64_decode($_GET['id']);
    $token = $_GET['token'];   

    $rpass = $conn->prepare('SELECT * FROM user WHERE iduser=:id AND token = :token');
    $rpass->execute(array(':id'=>$id, ':token'=>$token));
    $row = $rpass->fetch(PDO::FETCH_ASSOC);

    if ($rpass->rowCount() > 0) {
        
        if (isset($_POST['btn-resetpass'])) {
            $pass = $_POST['pass'];
            $cpass = $_POST['cpass'];

            if ($pass != $cpass) {
                $msg = array("Las contraseñas no coinciden", "warning");
            }else{
                $npass = password_hash($pass, PASSWORD_BCRYPT);

                $uppass = $conn->prepare('UPDATE user SET pass = :pass WHERE iduser = :id');
                $uppass->execute(array(':pass'=>$npass, ':id'=>$row['iduser']));

                $msg = array("Contraseña actualizada correctamente, espera te redireccionamos", "success");
                header('refresh:5; ./');                
            }
        }
    }else{
        $msg = array("El enlace es invalido o ha expirado", "danger");
    } 
}
?>

<!DOCTYPE html>
<html lang="es-CO" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pub^Pdf</title>
    <!--Logo Favicon-->
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">

    <!--SEO Tags-->
    <meta name="author" content="Pub Pdf">
    <meta name="description" content="Aplicativo web Bootstrap">
    <meta name="keywords" content="SENA, sena, Sena, Aplicativo, APLICATIVO, aplicativo">

    <!--Optimization Tags-->
    <meta name="theme-color" content="#000000">
    <meta name="MobileOptimized" content="width">
    <meta name="HandlhledFriendly" content="true">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-traslucent">

    <!--Bootstrap 5.3 Styles and complements-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/me.styles.css">
</head>

<body>
    <main class="form-signin m-auto pt-5 mt-4">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <img src="../assets/img/logo.png" alt="Logo" width="72" height="72">
                    <h1 class="display-6">Cambiar Contraseña</h1>
                </div>
                <!--Alerts-->
                <?php
                if (isset($msg)) {
                    ?>
                    <div class="alert alert-<?php echo $msg[1]; ?> alert-dismissible fade show">
                        <strong>Alerta !</strong> <?php echo $msg[0]; ?>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="alert alert-info alert-dismissible fade show">
                        <strong>Hola <?php echo $row['fname']; ?> !</strong> Aquí debes ingresar tu nueva contraseña.
                    </div>
                    <?php
                    }
                ?>
                <!--Alerts-->

                <form action="" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="mb-3 mt-3">
                        <label for="pass" class="form-label">Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="pass" placeholder="Nueva Contraseña" name="pass"
                            required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="cpass" class="form-label">Repita Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="cpass" placeholder="Repita Nueva Contraseña"
                            name="cpass" required>
                    </div>

                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="float-end btn btn-primary" name="btn-resetpass">Cambiar</button>
                    </div>
                    <div class="form-check mb-3 clearfix">
                        <label class="form-check-label float-end">
                            <a href="./">Iniciar Sesión</a>
                        </label>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-dark">
                <p class="text-center text-light pt-1" title="CACJX">Carlos Andres Castro - &copy;Copyright 2025</p>
            </div>
        </div>
    </main>
    <!--Complements JS-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>