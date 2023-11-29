<?php

require_once "models/connection.php";

try {

    $pdo = connection();

    $sql = "SELECT * FROM proveedores";
    $stmt = $pdo->query($sql);

    // Obtenemos los resultados de la consulta
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cerramos la conexión
    $pdo = null;
} catch (PDOException $e) {

    // Manejo de errores
    echo "Error: " . $e->getMessage();
    die();
}
?>


<div class="content">
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="?c=providers&m=create" class="btn btn-primary">Administrar Proveedores</a>
                        <div class="table-responsive mt-4">
                            <table class="table table-border table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRES</th>
                                        <th>NIT</th>
                                        <th>DIRECCION</th>
                                        <th>TELEFONO</th>
                                        <th>EMAIL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $row) : ?>
                                        <tr>
                                            <td data-column='Id'><?= $row['id'] ?></td>
                                            <td data-column='nombres'><?= $row['nombres'] ?></td>
                                            <td data-column='nit '><?= $row['nit'] ?></td>
                                            <td data-column='direccion'><?= $row['direccion'] ?></td>
                                            <td data-column='telefono'><?= $row['telefono'] ?></td>
                                            <td data-column='email'><?= $row['email'] ?></td>
                                            <td data-column='Opción #1'>
                                                <a href="views/providers/update_provider.phpid=<?= $row['id'] ?>" class="btn btn-primary">Editar</a>
                                            </td>
                                            <td data-column='Eliminar'>
                                                <a href="#" onclick="confirmDelete(<?= $row['id'] ?>)" class="btn btn-danger">Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para eliminar el usuario
    function confirmDelete(userId) {
        if (confirm("¿Está seguro de que desea eliminar este usuario?")) {
            window.location.href = "views/providers/delete_provider.php?id=" + userId;
        }
    }

    function openEditModal(userId) {
        var userToEdit = usersData.find(user => user['id'] === userId);

        // Rellenar los campos del formulario dentro del modal con los datos del usuario
        document.getElementById("userId").value = userToEdit['id'];
        document.getElementById("userNombres").value = userToEdit['nombres'];
        document.getElementById("userUsername").value = userToEdit['username'];
        document.getElementById("userEmail").value = userToEdit['email'];
        document.getElementById("userDireccion").value = userToEdit['direccion'];
        document.getElementById("userTelefono").value = userToEdit['telefono'];

        // Mostrar el modal de edición utilizando Bootstrap
        $('#editModal').modal('show');
    }

    // Función para cerrar el modal de edición
    function closeEditModal() {
        $('#editModal').modal('close');
    }

    // Restablecer el estado del modal cuando se cierra
    $('#editModal').on('hidden.bs.modal', function (e) {
        document.getElementById("userId").value = "";
        document.getElementById("userNombres").value = "";
        document.getElementById("userUsername").value = "";
        document.getElementById("userEmail").value = "";
        document.getElementById("userDireccion").value = "";
        document.getElementById("userTelefono").value = "";
    });

    
</script>

<!--content -->
<div class="content">
    <div class="container-fluid">
        <br>    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="?c=providers&m=index" class="btn btn-link">Cancelar o volver</a>
                        <div class="row">
                            <div class="col-md-3 ">
                                <img width="100px"   class="float-end" src="assets/images/logosproveedor/logoalfa.jpg" alt="">
                            </div>
                            <div class="col-md-5">
                                 <h2>Tienda ALFA Santa Lucia</h2>
                                 <p>Somos líderes en la fabricación y comercialización de revestimientos cerámicos, pisos en gres, baldosas y gramas sintéticas. Producimos y comercializamos pinturas, productos de mantenimiento, soluciones para cocinas, baños para todo tipo de ambientes.
</p>
                            </div>
                            <div class="col-md-4">
                                <p class="mt-2">Av. Caracas #45 - 03 sur</p>
                                <p>318 8007990</p>  
                                <p>Nit. 860032550</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end content -->