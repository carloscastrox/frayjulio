<section class="pt-2">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-6 mb-4 mb-lg-0">

                <!--Alerts-->
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
                            <img src="<?php echo $result['picture'];?>"
                                alt="picture" class="img-fluid my-5" style="width: 150px;" />
                            <h5><?php echo $result['fname']." ".$result['lname']; ?></h5>
                            <p><?php echo $result['rol'];?></p>
                            <i class="far fa-edit mb-5"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Perfil de Usuario</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Correo</h6>
                                        <p class="text-muted"><?php echo $result['email'];?></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Registro de Inicio</h6>
                                        <p class="text-muted"><?php echo $result['regdate'];?></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Fecha de Nacimiento</h6>
                                        <p class="text-muted"><?php echo $result['borndate'];?></p>
                                    </div>
                                </div>
                                <h6>Sobre mí</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-12 mb-3">
                                        <p class="text-muted"><?php echo $result['aboutme'];?></p>
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
                    <form action="" method="post" enctype="application/x-www-form-urlencoded">
                        <div class="mb-3 mt-3">
                            <label for="fname" class="form-label">Nombres:</label>
                            <input type="text" class="form-control" id="fname" placeholder="Ingrese sus nombres"
                                name="fname" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="lname" class="form-label">Apellidos:</label>
                            <input type="text" class="form-control" id="lname" placeholder="Ingrese sus apellidos"
                                name="lname" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Correo:</label>
                            <input type="email" class="form-control" id="email" placeholder="Ingrese su email" name="email"
                                required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="borndate" class="form-label">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" id="borndate" name="borndate"
                                required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="picture" class="form-label">Imagen de perfíl:</label>
                            <input type="file" class="form-control" id="picture" name="picture"
                                required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="aboutme" class="form-label">Sobre mí:</label>
                            <textarea class="form-control" name="aboutme" id="aboutme"></textarea>
                        </div>
                        <div class="my-3 d-grid">
                            <button class="btn btn-success" type="submit" name="btn-update">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal profile update-->
</section>