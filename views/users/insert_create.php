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
$password = mysqli_real_escape_string($conexion, $_REQUEST['password']); // Contraseña sin encriptar
$email = mysqli_real_escape_string($conexion, $_REQUEST['email']);
$direccion = mysqli_real_escape_string($conexion, $_REQUEST['direccion']);
$telefono = mysqli_real_escape_string($conexion, $_REQUEST['telefono']);

// Encriptar la contraseña utilizando la función de hash password_hash()
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Consulta SQL con valores escapados y contraseña encriptada
$query = "INSERT INTO usuarios (nombres, username, password, email, direccion, telefono) VALUES ('$nombres', '$username', '$hashed_password', '$email', '$direccion', '$telefono')";

// Ejecutar la consulta
if (mysqli_query($conexion, $query)) {
    // Mostrar mensaje de alerta
    echo "<script>alert('El usuario fue ingresado con éxito');</script>";

    // Redireccionar a una página específica después de 1 segundo
    header("refresh:1; url=http://localhost/SENAcopia/?c=users&m=index");
    exit; // Asegura que se detenga la ejecución después de la redirección
} else {
    echo "Problemas en el insert: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>