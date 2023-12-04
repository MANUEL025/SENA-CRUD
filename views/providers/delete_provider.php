<?php
function connection()
{
    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $db = "proyecto1";
    // Crea una nueva instancia de PDO
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    // Configura PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Devuelve la instancia de PDO
    return $pdo;
}

// Validamos y sanitizamos el valor de ID
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    // manejo del error
    echo "SE HA PRODUCIDO UN ERROR EN EL ID DEL USUARIO QUE SE QUIERE BORRAR";
    die();
}

try {
    
    $con = connection();

    $sql = "DELETE FROM proveedores WHERE id = ?";
    $stmt = $con->prepare($sql);
    // Nos aseguramos de que $id es un entero
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();

    
    header("refresh:1; url=http://localhost/SENA_pruebas/?c=providers&m=index");
    exit; 
    
} catch (PDOException $e) {
    
    echo "SE HA PRODUCIDO UN ERROR AL ELIMINAR EL USUARIO";
    die();
    
} finally {
    
    $con = null; // Cerrar la conexión
    
}
