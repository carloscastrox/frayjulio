<div class="pb-5">
    <h2>Tabla de datos de usuarios</h2>
</div>
<table class="table table-striped table-bordered table-hover" id="tuser">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Fecha Registro</th>
            <th>Operaciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

<script src="../assets/datatables/datatables.min.js"></script>
<script>
    let table = new DataTable('#tuser',{
        responsive: true,
        language:{
            //url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json' // via CDN
            url: '../assets/datatables/es-ES.json' // via local
        },
        sDom: 'BflrtiTp'
    });
</script>