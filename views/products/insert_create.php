
<?php
// Establecer conexión con la base de datos
$conexion = mysqli_connect("127.0.0.1", "root", "", "proyecto1");

// Verificar la conexión
if (!$conexion) {
    die("Problemas con la conexión: " . mysqli_connect_error());
}

// Evitar la inyección SQL usando consultas preparadas
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
$precio = mysqli_real_escape_string($conexion, $_POST['precio']);
$cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);

// Procesamiento de la imagen
$nombre_archivo = $_FILES['imagen']['name'];
$ruta_temporal = $_FILES['imagen']['tmp_name'];
$ruta_destino = 'assets/images/productos' . $nombre_archivo;// Cambiar esto por tu directorio de destino

if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
    // La imagen se ha cargado correctamente
    // Escapar la ruta de la imagen para evitar problemas de seguridad
    $imagen = mysqli_real_escape_string($conexion, $ruta_destino);

    // Consulta SQL con valores escapados
    $query = "INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$cantidad', '$imagen')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $query)) {
        // Mostrar mensaje de alerta
        echo "<script>alert('El producto fue ingresado con éxito');</script>";

        // Redireccionar a una página específica después de 1 segundo
        header("refresh:1; url=http://localhost/prueba/?c=products&m=index");
        exit; // Asegura que se detenga la ejecución después de la redirección
    } else {
        echo "Problemas en el insert: " . mysqli_error($conexion);
    }
} else {
    // Error al cargar la imagen
    echo "Hubo un problema al cargar la imagen.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>