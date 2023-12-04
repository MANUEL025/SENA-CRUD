<?php
// Establecer conexión con la base de datos utilizando mysqli
$conexion = mysqli_connect("127.0.0.1", "root", "", "proyecto1");

// Verificar la conexión
if (!$conexion) {
    die("Problemas con la conexión: " . mysqli_connect_error());
}

// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $nombre = $_POST['productnombre'];
    $descripcion = $_POST['productdescripcion'];
    $precio = $_POST['productprecio'];
    $cantidad = $_POST['productcantidad'];
    $imagen = $_POST['productimagen'];


    // Realizar la actualización utilizando sentencias preparadas de mysqli
    $stmt = mysqli_prepare($conexion, "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, cantidad = ?, imagen = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssssi", $nombre, $descripcion, $precio, $cantidad, $imagen, $userId);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo 
        
        header("refresh:1; url=http://localhost/SENA_pruebas/?c=products&m=index");
        exit;  
    } else {
        // Manejar el caso en que no haya habido ninguna actualización
        echo "No se pudo actualizar el registro";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
} else {
    echo "No se recibieron datos válidos para la actualización.";
    // Manejar errores o redirigir según sea necesario
}
?>