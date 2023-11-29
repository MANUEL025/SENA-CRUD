<?php
require_once "models/connection.php";

try {
    $pdo = connection();

    $sql = "SELECT * FROM productos";
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
            border: 5px solid #1e90ff;
            /* Borde azul oscuro */
            background-color: whitesmoke;
            /* Fondo agradable */
            padding: 20px;
            /* Espaciado interno para mejorar la visualización */
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
                            <a href="?c=products&m=create" class="btn btn-primary">Administrar Productos</a>
                            <div class="table-responsive mt-4">
                                <table class="table table-border table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>DESCRIPCION</th>
                                            <th>PRECIO</th>
                                            <th>CANTIDAD</th>

                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $row) : ?>
                                            <tr>
                                                <td data-column='id'><?= $row['id'] ?></td>
                                                <td data-column='nombre'><?= $row['nombre'] ?></td>
                                                <td data-column='descripcion'><?= $row['descripcion'] ?></td>
                                                <td data-column='precio'><?= $row['precio'] ?></td>
                                                <td data-column='cantidad'><?= $row['cantidad'] ?></td>
                                                <td data-column='Opción #1'>
                                                    <!-- Botón para abrir el modal -->
                                                    <button onclick="openEditModal(<?= $row['id'] ?>)" class="btn btn-primary">Editar</button>
                                                </td>
                                                <!--<td>
                                                    <button onclick="openDetailsModal(<?= $row['id'] ?>)" class="btn btn-info">Detalles</button>
                                                </td> -->
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
                    <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar usuarios -->
                    <form id="editUserForm" method="post" action="views/products/update_product.php">
                        <input type="hidden" id="userId" name="userId">
                        <div class="form-group">
                            <label for="productnombre">Nombre</label>
                            <input type="text" class="form-control" id="productnombre" name="productnombre">
                        </div>
                        <div class="form-group">
                            <label for="productdescripcion">Descripcion</label>
                            <input type="text" class="form-control" id="productdescripcion" name="productdescripcion">
                        </div>
                        <div class="form-group">
                            <label for="productprecio">Precio</label>
                            <input type="text" class="form-control" id="productprecio" name="productprecio">
                        </div>
                        <div class="form-group">
                            <label for="productcantidad">Cantidad</label>
                            <input type="text" class="form-control" id="productcantidad" name="productcantidad">
                        </div>
                        <div class="form-group">
                            <label for="productimagen">Imagen</label>
                            <input type="file" class="form-control-file" id="productimagen" name="productimagen">
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
                window.location.href = "views/products/delete_product.php?id=" + userId;

            }
        }

        function openEditModal(userId) {
            var userToEdit = usersData.find(user => user['id'] === userId);

            // Rellenar los campos del formulario dentro del modal con los datos del usuario
            document.getElementById("userId").value = userToEdit['id'];
            document.getElementById("productnombre").value = userToEdit['nombre'];
            document.getElementById("productdescripcion").value = userToEdit['descripcion'];
            document.getElementById("productprecio").value = userToEdit['precio'];
            document.getElementById("productcantidad").value = userToEdit['cantidad'];


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
            document.getElementById("productnombre").value = "";
            document.getElementById("productdescripcion").value = "";
            document.getElementById("productprecio").value = "";
            document.getElementById("productcantidad").value = "";
            document.getElementById("productimagen").value = "";

        });
    </script>

    <!-- Tus scripts adicionales, enlaces a librerías, etc. -->

</body>

</html>