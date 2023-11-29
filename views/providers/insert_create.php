<?php
$conexion = mysqli_connect("127.0.0.1", "root", "", "proyecto1");

if (!$conexion) {
    die("Problemas con la conexión: " . mysqli_connect_error());
}

// Verificar si se enviaron datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "INSERT INTO proveedores (nombres, nit, direccion, telefono, email) VALUES (?, ?, ?, ?, ?)";
    
    // Preparar la sentencia
    if ($stmt = mysqli_prepare($conexion, $query)) {
        // Vincular parámetros y asignar valores
        mysqli_stmt_bind_param($stmt, "sssss", $nombres, $nit, $direccion, $telefono, $email);
        
        $nombres = $_POST['nombres'];
        $nit = $_POST['nit'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        
        // Ejecutar la sentencia preparada
        if (mysqli_stmt_execute($stmt)) {
            header("refresh:1; url=http://localhost/crud-usuarios-main/?c=providers&m=index");
            exit;
        } else {
            echo "Problemas en el insert: " . mysqli_stmt_error($stmt);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la sentencia: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
