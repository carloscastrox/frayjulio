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

<!-- The Modal -->
<div class="modal fade" id="profileupdate">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
