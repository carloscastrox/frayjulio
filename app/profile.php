<?php
if (isset($_POST['btn-update'])) {
    $nuevoCorreo = $_POST['email'];
    $correoActual = $_POST['emailcurrent'];
    $userId = $_SESSION['id'];

    // Verificar si el correo ha cambiado y si ya existe en otro usuario
    if ($nuevoCorreo !== $correoActual) {
        $check = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = ? AND iduser != ?");
        $check->bindParam(1, $nuevoCorreo);
        $check->bindParam(2, $userId);
        $check->execute();
        $existe = $check->fetchColumn();

        if ($existe > 0) {
            $msg = array("El correo ingresado ya está en uso por otro usuario.", "danger");
        } else {
            actualizarPerfil();
        }
    } else {
        actualizarPerfil(); // correo no cambió, actualizar sin validación
    }
}

// Función para actualizar el perfil
function actualizarPerfil()
{
    global $conn, $msg;

    $updperfil = $conn->prepare("UPDATE user SET fname = ?, lname = ?, email = ?, borndate = ?, picture = ?, aboutme = ? WHERE iduser = ?");
    $updperfil->bindParam(1, $_POST['fname']);
    $updperfil->bindParam(2, $_POST['lname']);
    $updperfil->bindParam(3, $_POST['email']);
    $updperfil->bindParam(4, $_POST['borndate']);

    // Imagen
    $name = $_FILES['picture']['name'];
    $file = $_FILES['picture']['tmp_name'];
    $way = "profile/" . $name;
    if (!empty($name)) {
        move_uploaded_file($file, $way);
    } else {
        // Si no se sube una nueva imagen, mantener la anterior
        global $data;
        $way = $data['picture'];
    }

    $updperfil->bindParam(5, $way);
    $updperfil->bindParam(6, $_POST['aboutme']);
    $updperfil->bindParam(7, $_SESSION['id']);

    if ($updperfil->execute()) {
        // Guardar un mensaje en sesión para mostrarlo después
        $_SESSION['update_success'] = "Perfil actualizado correctamente";
        header("Location: home?page=profile");
        exit;
    }
}
?>

<!--Alerts-->
<?php
if (isset($_SESSION['update_success'])) {
    $msg = array($_SESSION['update_success'], "success");
    unset($_SESSION['update_success']);
}
?>
<?php if (isset($msg)) { ?>
    <div class="alert alert-<?php echo $msg[1]; ?> alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Alerta !</strong> <?php echo $msg[0]; ?>
    </div>
<?php } ?>
<!--Alerts-->

<div class="card mb-3" style="border-radius: .5rem;">
    <div class="row g-0">
        <div class="col-md-4 gradient-custom text-center"
            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
            <img src="<?php echo $result['picture']; ?>"
                alt="picture" class="img-fluid my-5" style="width: 150px;" />
            <h5><?php echo $result['fname'] . " " . $result['lname']; ?></h5>
            <p><?php echo $result['rol']; ?></p>
            <i class="far fa-edit mb-5"></i>
        </div>
        <div class="col-md-8">
            <div class="card-body p-4">
                <h6>Perfil de Usuario</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                    <div class="col-6 mb-3">
                        <h6>Correo</h6>
                        <p class="text-muted"><?php echo $result['email']; ?></p>
                    </div>
                    <div class="col-6 mb-3">
                        <h6>Registro de Inicio</h6>
                        <p class="text-muted"><?php echo $result['regdate']; ?></p>
                    </div>
                    <div class="col-6 mb-3">
                        <h6>Fecha de Nacimiento</h6>
                        <p class="text-muted"><?php echo $result['borndate']; ?></p>
                    </div>
                </div>
                <h6>Sobre mí</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                    <div class="col-12 mb-3">
                        <p class="text-muted"><?php echo $result['aboutme']; ?></p>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#profileupdate">
                        Editar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal profile update-->
<div class="modal fade" id="profileupdate">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Perfil de Usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="fname" class="form-label">Nombres:</label>
                        <input type="text" class="form-control" id="fname" placeholder="Ingrese sus nombres" value="<?php echo $result['fname']; ?>"
                            name="fname" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="lname" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="lname" placeholder="Ingrese sus apellidos" value="<?php echo $result['lname']; ?>"
                            name="lname" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Correo:</label>
                        <input type="hidden" value="<?php echo $result['email']; ?>" name="emailcurrent">
                        <input type="email" class="form-control" id="email" placeholder="Ingrese su email" name="email" value="<?php echo $result['email']; ?>"
                            required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="borndate" class="form-label">Fecha de nacimiento:</label>
                        <input type="date" class="form-control" id="borndate" name="borndate" value="<?php echo $result['borndate']; ?>"
                            required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="picture" class="form-label">Imagen de perfíl:</label>
                        <input type="file" class="form-control" id="picture" name="picture">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="aboutme" class="form-label">Sobre mí:</label>
                        <textarea class="form-control" name="aboutme" id="aboutme"><?php echo $result['aboutme']; ?></textarea>
                    </div>
                    <div class="my-3 d-grid">
                        <button class="btn btn-success" type="submit" name="btn-update">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- The Modal profile -->