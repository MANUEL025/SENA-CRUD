<?php
session_start();

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
$error = ''; // Variable para almacenar el mensaje de error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['uname']) && isset($_POST['pass'])) {
        $username = $_POST['uname'];
        $password = $_POST['pass'];

        $pdo = connection();

        // Consulta para obtener el hash de la contraseña almacenada en la base de datos
        $query = "SELECT password FROM usuarios WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $stored_password = $stmt->fetchColumn();

        if ($stored_password && password_verify($password, $stored_password)) {
            // Contraseña válida
            $_SESSION['username'] = $username;
            header("Location: http://localhost/SENA_pruebas/?c=dashboard&m=dashboard");
            exit();
        } else {
            // Usuario o contraseña incorrectos
            echo "<script>alert('Nombre de usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.');</script>";
            header("refresh:0; url=http://localhost/SENA_pruebas");
            $error = "Nombre de usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.";
        }
    } else {
        $error = "Nombre de usuario o contraseña no se han enviado correctamente.";
    }
}
?>
