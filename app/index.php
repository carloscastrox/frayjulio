<?php
/* 
SESIONES
 * Validación de sesión de usuarios ok
 * Seguridad de la aplicación en el home ok
 
  RECUPERAR CONTRASEÑA
 * PHPMailer OK
 * Config Mailer (cuenta de Gmail) OK
 * Formulario forgotpass.php OK
 * Formulario resetpass.php OK
 
 MENU MODULAR
 * Menú modular para el home OK
 * Validar si el usuario ya ha iniciado sesión OK
 * Si la sesión existe, redirigir a la página de INDEX OK

ROLES
* Validar a los usuarios por roles OK 
* Direccionar a los usuarios a la página de home según su rol (homea, homec, homev, etc) OK
* crear en la base de datos el campo rol y asignar el rol a cada usuario OK

PERFIL 
* Crear perfil de usuarios de acuerdo a su rol (Incluyendo imagen de perfil)
* Formatear campo date en php
* Actualizar los datos del perfil de usuario


CRUD 
* Crear tabla Utilizando librerias datatables.net(inicializar, Responsive, language)
* Activar Botones de exportación a Excel y PDF
* Imprimir datos en una tabla dinamica
* Insertar datos a la tabla dinamica
* Eliminar datos de la tabla dinamica
* Editar datos de la tabla dinamica

 */
include_once 'conn.php';
session_start();

if (isset($_SESSION['user'])) {
    header("Location: home");
    exit();
}

if (isset($_POST['btnlogin'])) {
    $login = $conn->prepare('SELECT * FROM user WHERE email = ? LIMIT 1');
    $login->bindParam(1, $_POST['email']);
    $login->execute();
    $result = $login->fetch(PDO::FETCH_ASSOC);

    if (is_array($result)) {
        if (password_verify($_POST['pass'], $result['pass'])) {
            // Validar el rol del usuario
            switch ($result['rol']) {
                case 'admin':
                    $_SESSION['user'] = $result['email'];
                    $_SESSION['id'] = $result['iduser'];
                    $_SESSION['rol'] = $result['rol'];
                    header("Location: home");
                    break;

                case 'user':
                    $_SESSION['user'] = $result['email'];
                    $_SESSION['id'] = $result['iduser'];
                    $_SESSION['rol'] = $result['rol'];
                    header("Location: homeu");
                    break;

                default:
                    header("Location: ./");
                    break;
            }
        } else {
            $msg = array("Contraseña incorrecta", "warning");
        }
    } else {
        $msg = array("El correo no existe", "danger");
    }
}
?>

<!DOCTYPE html>
<html lang="es-CO" data-bs-theme="dark" class="h-100">

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
    <meta name="HandlhledFriendly" content="true">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-traslucent">

    <!--Styles and complements Bootstrap 5.3-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/me.styles.css">
    <!--styles Icons Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <main class="form-signin m-auto pt-5 mt-4">
        <div class="card">
            <div class="card-body">
                <!--Section Alerts-->
                <?php if (isset($msg)) { ?>
                    <div class="alert alert-<?php echo $msg[1]; ?> alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Alerta!</strong> <?php echo $msg[0]; ?>.
                    </div>
                <?php } ?>
                <!--Section Alerts-->
                <div class="text-center">
                    <img src="../assets/img/logo.png" alt="Logo" width="72" height="72">
                    <h1 class="display-6">Inicio de Sesión</h1>
                </div>
                <form action="" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingrese su email" name="email"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña:</label>

                        <div class="input-group">
                            <input class="form-control" type="password" name="pass" id="password"
                                placeholder="Ingrese su contraseña" required>
                            <span class="input-group-text" onclick="pass_show_hide();">
                                <i class="bi bi-eye-fill d-none" id="showeye"></i>
                                <i class="bi bi-eye-slash-fill" id="hideeye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-block" name="btnlogin">Ingresar</button>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <a href="reguser">Registráte</a>
                        </div>
                        <div class="col-sm-8 text-end">
                            <a href="forgotpass">¿Olvidaste la contraseña?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!--Complements JS-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--Script visualización password-->
    <script src="../assets/js/password.viewer.js"></script>
</body>

</html>