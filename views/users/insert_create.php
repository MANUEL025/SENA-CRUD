<?php
// Establecer conexión con la base de datos
$conexion = mysqli_connect("127.0.0.1", "root", "", "proyecto1");

// Verificar la conexión
if (!$conexion) {
    die("Problemas con la conexión: " . mysqli_connect_error());
}

// Evitar la inyección SQL usando consultas preparadas
$nombres = mysqli_real_escape_string($conexion, $_REQUEST['nombres']);
$username = mysqli_real_escape_string($conexion, $_REQUEST['username']);
$password = mysqli_real_escape_string($conexion, $_REQUEST['password']);
$email = mysqli_real_escape_string($conexion, $_REQUEST['email']);
$direccion = mysqli_real_escape_string($conexion, $_REQUEST['direccion']);
$telefono = mysqli_real_escape_string($conexion, $_REQUEST['telefono']);

// Consulta SQL con valores escapados
$query = "INSERT INTO usuarios (nombres, username, password, email, direccion, telefono) VALUES ('$nombres', '$username', '$password', '$email', '$direccion', '$telefono')";

// Ejecutar la consulta
if (mysqli_query($conexion, $query)) {
    // Mostrar mensaje de alerta
    echo "<script>alert('El usuario fue ingresado con éxito');</script>";

    // Redireccionar a una página específica después de 1 segundo
    header("refresh:1; url=http://localhost/Nuevo%20crud/crud-usuarios-main/?c=users&m=index");
    exit; // Asegura que se detenga la ejecución después de la redirección
} else {
    echo "Problemas en el insert: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
