<?php
require_once "models/connection.php";

try {
    $pdo = connection();

    $sql = "SELECT * FROM usuarios";
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

<!DOCTYPE html>
<html lang="es">
<head>
<style>
    /* Estilos para el modal */
    .modal-body {
      border: 5px solid #1e90ff; /* Borde azul oscuro */
      background-color: whitesmoke; /* Fondo agradable */
      padding: 20px; /* Espaciado interno para mejorar la visualización */
    }

    
  </style>
</head>
<body>

<div class="content">
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="?c=users&m=create" class="btn btn-primary">Administrar Usuarios</a>
                        <div class="table-responsive mt-4">
                            <table class="table table-border table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRES</th>
                                        <th>USERNAME</th>
                                        <th>EMAIL</th>
                                        <th>DIRECCION</th>
                                        <th>TELEFONO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $row) : ?>
                                        <tr>
                                            <td data-column='Id'><?= $row['id'] ?></td>
                                            <td data-column='nombres'><?= $row['nombres'] ?></td>
                                            <td data-column='username'><?= $row['username'] ?></td>
                                            <td data-column='email'><?= $row['email'] ?></td>
                                            <td data-column='direccion'><?= $row['direccion'] ?></td>
                                            <td data-column='telefono'><?= $row['telefono'] ?></td>
                                            <td data-column='Opción #1'>
                                                <!-- Botón para abrir el modal -->
                                                <button onclick="openEditModal(<?= $row['id'] ?>)" class="btn btn-primary">Editar</button>
                                            </td>
                                            <td data-column='Eliminar'>
                                                <!-- Botón de eliminar con confirmación -->
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

<!-- Modal de edición -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para editar usuarios -->
                <form id="editUserForm" method="post" action="views/users/update_user.php">
                    <input type="hidden" id="userId" name="userId">
                    <div class="form-group">
                        <label for="userNombres">Nombres:</label>
                        <input type="text" class="form-control" id="userNombres" name="userNombres">
                    </div>
                    <div class="form-group">
                        <label for="userUsername">Username:</label>
                        <input type="text" class="form-control" id="userUsername" name="userUsername">
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email:</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail">
                    </div>
                    <div class="form-group">
                        <label for="userDireccion">Dirección:</label>
                        <input type="text" class="form-control" id="userDireccion" name="userDireccion">
                    </div>
                    <div class="form-group">
                        <label for="userTelefono">Teléfono:</label>
                        <input type="text" class="form-control" id="userTelefono" name="userTelefono">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Asignación de datos de usuarios a una variable JavaScript -->
<script>
    var usersData = <?php echo json_encode($users); ?>;

    // Funciones para eliminar el usuario, abrir y cerrar el modal
    function confirmDelete(userId) {
        if (confirm("¿Está seguro de que desea eliminar este usuario?")) {
            window.location.href = "views/users/delete_user.php?id=" + userId;
            
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

<!-- Tus scripts adicionales, enlaces a librerías, etc. -->

</body>
</html>