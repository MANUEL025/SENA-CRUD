<?php
// Establecer conexión con la base de datos
$conexion = mysqli_connect("127.0.0.1", "root", "", "proyecto1");

// Verificar la conexión
if (!$conexion) {
    die("Problemas con la conexión: " . mysqli_connect_error());
}

// Evitar la inyección SQL usando consultas preparadas
$nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre']);
$descripcion = mysqli_real_escape_string($conexion, $_REQUEST['descripcion']);
$precio = mysqli_real_escape_string($conexion, $_REQUEST['precio']);
$cantidad = mysqli_real_escape_string($conexion, $_REQUEST['cantidad']);
$imagen = mysqli_real_escape_string($conexion, $_REQUEST['imagen']);


// Consulta SQL con valores escapados
$query = "INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$cantidad', $imagen)";

// Ejecutar la consulta
if (mysqli_query($conexion, $query)) {
    // Mostrar mensaje de alerta
    echo "<script>alert('El producto fue ingresado con éxito');</script>";

    // Redireccionar a una página específica después de 1 segundo
    header("refresh:1; url=http://localhost/SENA_pruebas/?c=products&m=index");
    exit; // Asegura que se detenga la ejecución después de la redirección
} else {
    echo "Problemas en el insert: " . mysqli_error($conexion);
}



// Cerrar la conexión
mysqli_close($conexion);
?>
