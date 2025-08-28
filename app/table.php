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
        <?php 
        $data = $conn->prepare('SELECT fname,lname,email,rol,regdate FROM user');
        $data->execute();
        //while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        foreach ($data as $row) {
        ?>
        <tr>
            <td><?php echo $row['fname'];?></td>
            <td><?php echo $row['lname'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['rol'];?></td>
            <td><?php echo $row['regdate'];?></td>
            <td>Botones Editar y Eliminar</td>
        </tr>
        <?php } ?>
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