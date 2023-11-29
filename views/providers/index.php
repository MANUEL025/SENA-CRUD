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

<style>
    /* Estilos para el modal */
    .modal-body {
        border: 5px solid #1e90ff;
        /* Borde azul oscuro */
        background-color: whitesmoke;
        /* Fondo agradable */
        padding: 20px;
        /* Espaciado interno para mejorar la visualización */
    }
</style>



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


                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $row) : ?>
                                        <tr>
                                            <td data-column='Id'><?= $row['id'] ?></td>
                                            <td data-column='nombres'><?= $row['nombres'] ?></td>
                                            <td data-column='nit'><?= $row['nit'] ?></td>
                                            <td data-column='direccion'><?= $row['direccion'] ?></td>
                                            <td data-column='telefono'><?= $row['telefono'] ?></td>
                                            <td data-column='email'><?= $row['email'] ?></td>

                                            <td data-column='Opción #1'>
                                                <!-- Botón para abrir el modal -->
                                                <button onclick="openEditModal(<?= $row['id'] ?>)" class="btn btn-primary">Editar</button>
                                            </td>
                                            <td>
                                                <button onclick="openDetailsModal(<?= $row['id'] ?>)" class="btn btn-info">Detalles</button>
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
                <h5 class="modal-title" id="editModalLabel">Editar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para editar usuarios -->
                <form id="editUserForm" method="post" action="views/providers/update_provider.php">
                    <input type="hidden" id="userId" name="userId">
                    <div class="form-group">
                        <label for="userNombres">Nombres</label>
                        <input type="text" class="form-control" id="userNombres" name="userNombres">
                    </div>
                    <div class="form-group">
                        <label for="userNit">Nit:</label>
                        <input type="text" class="form-control" id="userNit" name="userNit">
                    </div>

                    <div class="form-group">
                        <label for="userDireccion">Dirección:</label>
                        <input type="text" class="form-control" id="userDireccion" name="userDireccion">
                    </div>
                    <div class="form-group">
                        <label for="userTelefono">Teléfono:</label>
                        <input type="text" class="form-control" id="userTelefono" name="userTelefono">
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email:</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de detalles -->
<div class="modal fade"  id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document"  >
        <div class="modal-content" style="width: 600px; max-height: 300px; ">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Detalles del Proveedor</h5>
                
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailsModalBody">
                
            </div>
        </div>
    </div>
</div>

<!-- fin del modal de detalles   -->
<script>
    var usersData = <?php echo json_encode($users); ?>;

    function openDetailsModal(userId) {
    var userToDisplay = usersData.find(user => user['id'] === userId);

    var detailsModalBody = document.getElementById("detailsModalBody");
    detailsModalBody.innerHTML = `
        <div class="content">
            <div class="container-fluid">
                <br>    
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="?c=providers&m=index" class="btn btn-link">Cancelar o volver</a>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Aquí puedes mostrar la imagen si tienes esa información -->
                                        <!-- <img width="100px" class="float-end" src="${userToDisplay['imagen']}" alt=""> -->
                                    </div>
                                    <div class="col-md-9">
                                        <h2>${userToDisplay['nombres']}</h2>
                                        <p>Dirección: ${userToDisplay['direccion']}</p>
                                        <p>Teléfono: ${userToDisplay['telefono']}</p>
                                        <p>Nit: ${userToDisplay['nit']}</p>
                                        <p>Email: ${userToDisplay['email']}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    $('#detailsModal').modal('show');
}

</script>



<!-- Asignación de datos de usuarios a una variable JavaScript -->
<script>
    var usersData = <?php echo json_encode($users); ?>;

    // Funciones para eliminar el usuario, abrir y cerrar el modal
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
        document.getElementById("userNit").value = userToEdit['nit'];
        document.getElementById("userDireccion").value = userToEdit['direccion'];
        document.getElementById("userTelefono").value = userToEdit['telefono'];
        document.getElementById("userEmail").value = userToEdit['email'];


        // Mostrar el modal de edición utilizando Bootstrap
        $('#editModal').modal('show');
    }

    // Función para cerrar el modal de edición
    function closeEditModal() {
        $('#editModal').modal('close');
    }

    // Restablecer el estado del modal cuando se cierra
    $('#editModal').on('hidden.bs.modal', function(e) {
        document.getElementById("userId").value = "";
        document.getElementById("userNombres").value = "";
        document.getElementById("userNit").value = "";
        document.getElementById("userDireccion").value = "";
        document.getElementById("userTelefono").value = "";
        document.getElementById("userEmail").value = "";

    });
</script>



</body>

</html>